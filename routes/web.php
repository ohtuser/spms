<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission_check')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::name('admin.')->prefix('admin')->group(function(){
        Route::get('/', [UserController::class, 'admin'])->name('index');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit', [UserController::class, 'edit'])->name('edit');
    });

    Route::name('teacher.')->prefix('teacher')->group(function(){
        Route::get('/', [TeacherController::class, 'teacher'])->name('index');
        Route::post('store', [TeacherController::class, 'store'])->name('store');
        Route::get('edit', [TeacherController::class, 'edit'])->name('edit');
    });

    Route::name('subject.')->prefix('subject')->group(function(){
        Route::get('/', [SubjectController::class, 'subject'])->name('index');
        Route::post('store', [SubjectController::class, 'store'])->name('store');
        Route::get('edit', [SubjectController::class, 'edit'])->name('edit');
    });
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login-attempt', [AuthController::class, 'login_attempt'])->name('login_attempt');

// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register-attempt', [AuthController::class, 'register_attempt'])->name('register_attempt');
