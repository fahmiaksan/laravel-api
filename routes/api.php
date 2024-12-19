<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\authorizeMiddleware;
use App\Http\Middleware\isAdminMiddleware;
use App\Http\Middleware\isUserMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware(authorizeMiddleware::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware(isAdminMiddleware::class)->group(function () {
            Route::get('/detail', [UserController::class, 'getUser']);
            Route::delete('/logout', [UserController::class, 'logout']);
            Route::put('/user/{id}/update', [UserController::class, 'update'])->where('id', '[0-9]+');
            Route::post('/category', [CategoryController::class, 'store']);
            Route::get('/category/list', [CategoryController::class, 'index']);
            Route::get('/category/{id}/detail', [CategoryController::class, 'show'])->where('id', '[0-9]+');
            Route::put('/category/{id}/update', [CategoryController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/category/{id}/delete', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
            Route::post('/product', [ProductController::class, 'store']);
            Route::get('/product/list', [ProductController::class, 'index']);
            Route::get('/product/{id}/detail', [ProductController::class, 'show'])->where('id', '[0-9]+');
            Route::put('/product/{id}/update', [ProductController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->where('id', '[0-9]+');
        });
        Route::middleware(isUserMiddleware::class)->group(function () {
            Route::post('/checkout', [CheckoutController::class, 'store']);
            Route::get('/checkout/list', [CheckoutController::class, 'index']);
            Route::get('/checkout/{id}/detail', [CheckoutController::class, 'show']);
            Route::put('/checkout/{id}/update', [CheckoutController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/checkout/{id}/delete', [CheckoutController::class, 'destroy'])->where('id', '[0-9]+');
        });
    });
});
