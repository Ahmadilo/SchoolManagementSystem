<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/api/hello', function () {
//     return 'Hello World';
// });
Route::get('/test', function(){
    return view('Test');
});

Route::get('/personForm', function () {
    return view('personForm');
});