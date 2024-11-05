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
     * Register user method
     * @return response()
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

        $user = User::create([
            "name" => $validator->validated()['name'],
            "email" => $validator->validated()['email'],
            "password" => Hash::make($validator->validated()['password']),
        ]);

        $response['user'] = $user->name;
        $response['email'] = $user->email;
        $response['token'] = $user->createToken(env('APP_NAME'))->accessToken;

        return response()->json([
            "message" => "The user {$validator->validated()['name']} was created.",
            "data" => $response,
        ], 201);
    }

    /**
     * Login user method
     * @return response()
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
                "message" => "The user {$user->name} was logged in.",
                "data" => $response,
            ], 201);
        }

        return response()->json([
            "message" => "User unauthenticated."
        ], 401);
    }
}
