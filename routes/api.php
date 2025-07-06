<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
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

Route::put('/person/{id}', [PersonController::class, 'update']);

Route::get('/person/{id}', [PersonController::class, 'show']);

Route::delete('/person/{id}', [PersonController::class, 'destroy']);