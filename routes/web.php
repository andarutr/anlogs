<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
});