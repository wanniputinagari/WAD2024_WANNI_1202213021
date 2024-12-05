<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('home');
});

// Lecturer routes
Route::resource('lecturers', LecturerController::class);

// Student routes
Route::resource('students', StudentController::class);