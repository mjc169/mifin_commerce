<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ForceJsonAccept;

Route::get('/', function () {
    return "Welcome to our API. Please check the `openapi.yaml` for the list of endpoints you can use. ";
});


//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(ForceJsonAccept::class)->group(function () {
    Route::apiResource('/user', UserController::class);
});
