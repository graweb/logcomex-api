<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "confirm_password" => "required|same:password",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all(),
            ], 422);
        }

        User::create([
            "name" => $validator->validated()['name'],
            "email" => $validator->validated()['email'],
            "password" => Hash::make($validator->validated()['password']),
        ]);

        return response()->json([
            "message" => "O usuário {$validator->validated()['name']} foi criado com sucesso.",
        ], 201);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all(),
            ], 422);
        }

        if(Auth::attempt(
            [
                "email" => $validator->validated()['email'],
                "password" => $validator->validated()['password']
            ]
        )) {

            $user = Auth::user();

            $response['user'] = $user->name;
            $response['email'] = $user->email;
            $response['token'] = $user->createToken(env('APP_NAME'))->accessToken;

            return response()->json([
                "message" => "O usuário {$user->name} está logado.",
                "data" => $response,
            ], 201);
        }

        return response()->json([
            "message" => "Usuário ou senha inválido, tente novamente."
        ], 401);
    }

    /**
     * Check User logged
     */
    public function checkUser()
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Logout realizado com sucesso!'
        ], 200);
    }
}
