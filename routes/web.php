<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/cek-login',[AuthController::class, 'cekLogin'])->name('cek-login');

//admin
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/get-products/{id}', [ProductController::class,'getProduct']);
Route::post('/update_stok', [ProductController::class,'update_stok']);

