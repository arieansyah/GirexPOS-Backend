<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('users')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.index');
        });
        Route::get('role/mass-destroy', [\App\Http\Controllers\Backend\RoleController::class, 'massDestroy'])->name('roles.mass.destroy');
        Route::get('users/mass-destroy', [\App\Http\Controllers\Backend\UserController::class, 'massDestroy'])->name('users.mass.destroy');
        Route::resource('user', \App\Http\Controllers\Backend\UserController::class);
        Route::resource('role', \App\Http\Controllers\Backend\RoleController::class);

        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });

    Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);

    Route::prefix('masters')->group(function () {
        Route::resource('discounts', \App\Http\Controllers\Backend\Master\DiscountController::class);
        Route::resource('categories', \App\Http\Controllers\Backend\Master\CategoryController::class);
    });
});