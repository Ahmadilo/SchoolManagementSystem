<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeacherController;
use App\Models\Person;

Route::get('/hello', function () {
    return 'Hello World';
});

Route::get('/increment/{number}', function ($number) {
    if (!is_numeric($number)) {
        return response()->json(['error' => 'Invalid number'], 400);
    }

    return response()->json([
        'result' => $number + 1
    ]);
});

// User Routes

Route::post('/users', [UserController::class, 'store']);

Route::get('/users', [UserController::class, 'index']);

Route::put('/users/{id}', [UserController::class, 'update']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Person Routes

Route::post('/person', [PersonController::class, 'store'])->name('person.store');

Route::get('/person', [PersonController::class, 'index']);

Route::put('/person/{id}', [PersonController::class, 'update'])->name('person.update', ['id' => '[0-9]+']);

Route::get('/person/{id}', [PersonController::class, 'show']);

Route::delete('/person/{id}', [PersonController::class, 'destroy']);

// Student Routes

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::post('students', [StudentController::class, 'store']);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class, 'destroy']);

// Staff Routes


Route::get('staffs', [StaffController::class, 'index']);
Route::get('staffs/{id}', [StaffController::class, 'show']);
Route::post('staffs', [StaffController::class, 'store']);
Route::put('staffs/{id}', [StaffController::class, 'update']);
Route::delete('staffs/{id}', [StaffController::class, 'destroy']);

// Teacher Routes

Route::get('teachers', [TeacherController::class, 'index']);
Route::get('teachers/{id}', [TeacherController::class, 'show']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::put('teachers/{id}', [TeacherController::class, 'update']);
Route::delete('teachers/{id}', [TeacherController::class, 'destroy']);
