<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * LOGIN
 * REGISTER
 */
Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'guest',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

/**
 * PRODUCTS
 */
Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth:api',
], function () {
    Route::apiResource('products', ProductController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
