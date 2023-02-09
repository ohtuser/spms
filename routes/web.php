<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission_check')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::name('admin.')->prefix('admin')->group(function(){
        Route::get('/', [UserController::class, 'admin'])->name('index');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit', [UserController::class, 'edit'])->name('edit');
    });

    Route::name('teacher.')->prefix('teacher')->group(function(){
        Route::get('/', [TeacherController::class, 'teacher'])->name('index');
        Route::post('store', [TeacherController::class, 'store'])->name('store');
        Route::get('edit', [TeacherController::class, 'edit'])->name('edit');
        Route::get('subject-assign', [TeacherController::class, 'subjectAssign'])->name('subject_assign');
        Route::get('assigned-subject', [TeacherController::class, 'assignedSubjet'])->name('assigned_subject');
        Route::post('subject-assign-store', [TeacherController::class, 'subjectAssignStore'])->name('subject_assign_store');
    });

    Route::name('student.')->prefix('student')->group(function(){
        Route::get('/', [StudentController::class, 'student'])->name('index');
        Route::post('store', [StudentController::class, 'store'])->name('store');
        Route::get('edit', [StudentController::class, 'edit'])->name('edit');
        Route::get('subject-assign', [StudentController::class, 'subjectAssign'])->name('subject_assign');
        Route::get('assigned-subject', [StudentController::class, 'assignedSubjet'])->name('assigned_subject');
        Route::post('subject-assign-store', [StudentController::class, 'subjectAssignStore'])->name('subject_assign_store');
    });

    Route::name('subject.')->prefix('subject')->group(function(){
        Route::get('/', [SubjectController::class, 'subject'])->name('index');
        Route::post('store', [SubjectController::class, 'store'])->name('store');
        Route::get('edit', [SubjectController::class, 'edit'])->name('edit');
    });

    Route::name('trimester.')->prefix('trimester')->group(function(){
        Route::get('/', [CommonTaskController::class, 'trimester'])->name('index');
    });

    Route::name('batch.')->prefix('batch')->group(function(){
        Route::get('/', [CommonTaskController::class, 'batch'])->name('index');
    });
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login-attempt', [AuthController::class, 'login_attempt'])->name('login_attempt');

// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register-attempt', [AuthController::class, 'register_attempt'])->name('register_attempt');
