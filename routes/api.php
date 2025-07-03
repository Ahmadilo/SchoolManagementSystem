<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/person/{id}', function ($id) {
    // بيانات مزيفة للأشخاص
    $people = [
        1 => ['id' => 1, 'name' => 'أحمد', 'age' => 30, 'email' => 'ahmad@example.com'],
        2 => ['id' => 2, 'name' => 'سارة', 'age' => 25, 'email' => 'sara@example.com'],
        3 => ['id' => 3, 'name' => 'خالد', 'age' => 40, 'email' => 'khalid@example.com'],
    ];

    if (!isset($people[$id])) {
        return response()->json(['error' => 'Person not found'], 404);
    }

    return response()->json($people[$id]);
});
