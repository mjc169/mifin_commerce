<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return "Welcome to our API. Please check the `openapi.yaml` for the list of endpoints you can use. ";
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/userInformation', [UserController::class, 'getUserInformation']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
});
