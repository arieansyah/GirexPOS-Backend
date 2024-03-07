<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// middleware auth
Route::group(['middleware' => 'auth:sanctum'], function () {
    // logout route
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    // products route
    Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);

    // masters route
    Route::apiResource('categories', App\Http\Controllers\Api\CategoryController::class);

    // orders route
    Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'store']);

    // discounts route
    Route::apiResource('discounts', App\Http\Controllers\Api\DiscountController::class);
});
// product api resource