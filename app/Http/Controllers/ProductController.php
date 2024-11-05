<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new Product;

        if($request->has('code')) {
            $data = $data->where('code', 'like', '%'.$request->code.'%');
        }

        if($request->has('name')) {
            $data = $data->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->has('description')) {
            $data = $data->where('description', 'like', '%'.$request->description.'%');
        }

        if($request->has('quantity')) {
            $data = $data->where('quantity', $request->quantity);
        }

        return response()->json([
            "data" => $data->paginate()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "code" => "required",
            "name" => "required",
            "description" => "required",
            "quantity" => "required|int",
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->all(),
            ], 422);
        }

        Product::create([
            "code" => $validator->validated()['code'],
            "name" => $validator->validated()['name'],
            "description" => $validator->validated()['description'],
            "quantity" => $validator->validated()['quantity'],
        ]);

        return response()->json([
            "message" => "The product {$validator->validated()['name']} was created.",
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
