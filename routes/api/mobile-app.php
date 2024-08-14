<?php

use App\Http\Controllers\MobileApp\Auth\LoginController;
use App\Http\Controllers\MobileApp\Auth\RegistrationController;
use App\Http\Controllers\MobileApp\Auth\UserController;
use App\Http\Controllers\MobileApp\Customer\CustomerController;
use App\Http\Controllers\MobileApp\Product\ProductController;
use App\Http\Controllers\MobileApp\ProductType\ProductTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegistrationController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('user', [UserController::class, 'getCurrentUser']);
        Route::post('logout', [LoginController::class, 'logout']);
    });

    Route::middleware('access-outlet')->group(function () {
        Route::apiResource('customers', CustomerController::class);

        Route::apiResource('product-types', ProductTypeController::class);

        Route::apiResource('products', ProductController::class);
    });
});
