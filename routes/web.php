<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/cek-login',[AuthController::class, 'cekLogin'])->name('cek-login');

//admin
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/user-data',[UserController::class, 'index'])->name('user.index');
