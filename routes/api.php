<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\NotificationController;
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

// Subject Routes

Route::get('subjects', [SubjectController::class, 'index']);
Route::get('subjects/{id}', [SubjectController::class, 'show']);
Route::post('subjects', [SubjectController::class, 'store']);
Route::put('subjects/{id}', [SubjectController::class, 'update']);
Route::delete('subjects/{id}', [SubjectController::class, 'destroy']);

// Subject Routes

Route::get('classes', [ClassController::class, 'index']);
Route::get('classes/{id}', [ClassController::class, 'show']);
Route::post('classes', [ClassController::class, 'store']);
Route::put('classes/{id}', [ClassController::class, 'update']);
Route::delete('classes/{id}', [ClassController::class, 'destroy']);

// Class Subjects Routes

Route::get('class-subjects', [ClassSubjectController::class, 'index']);
Route::get('class-subjects/{id}', [ClassSubjectController::class, 'show']);
Route::post('class-subjects', [ClassSubjectController::class, 'store']);
Route::put('class-subjects/{id}', [ClassSubjectController::class, 'update']);
Route::delete('class-subjects/{id}', [ClassSubjectController::class, 'destroy']);

// Student Classes Routes

Route::get('student-classes', [StudentClassController::class, 'index']);
Route::get('student-classes/{id}', [StudentClassController::class, 'show']);
Route::post('student-classes', [StudentClassController::class, 'store']);
Route::put('student-classes/{id}', [StudentClassController::class, 'update']);
Route::delete('student-classes/{id}', [StudentClassController::class, 'destroy']);

// Attendance Routes

Route::get('attendance', [AttendanceController::class, 'index']);
Route::get('attendance/{id}', [AttendanceController::class, 'show']);
Route::post('attendance', [AttendanceController::class, 'store']);
Route::put('attendance/{id}', [AttendanceController::class, 'update']);
Route::delete('attendance/{id}', [AttendanceController::class, 'destroy']);

// Grade Routes

Route::get('grades', [GradeController::class, 'index']);
Route::get('grades/{id}', [GradeController::class, 'show']);
Route::post('grades', [GradeController::class, 'store']);
Route::put('grades/{id}', [GradeController::class, 'update']);
Route::delete('grades/{id}', [GradeController::class, 'destroy']);

// notifiction Routes not Test eite

Route::get('notifications', [NotificationController::class, 'index']);
Route::get('notifications/{id}', [NotificationController::class, 'show']);
Route::post('notifications', [NotificationController::class, 'store']);
Route::put('notifications/{id}', [NotificationController::class, 'update']);
Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);