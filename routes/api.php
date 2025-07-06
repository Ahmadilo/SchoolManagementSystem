<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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

Route::post('/users', [UserController::class, 'store']);

Route::get('/users', [UserController::class, 'index']);

Route::put('/users/{id}', [UserController::class, 'update']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::delete('/users/{id}', [UserController::class, 'destroy']);