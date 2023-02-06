<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission_check')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login-attempt', [AuthController::class, 'login_attempt'])->name('login_attempt');

// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register-attempt', [AuthController::class, 'register_attempt'])->name('register_attempt');
