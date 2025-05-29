<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;

Route::get('/', [LandingPageController::class, 'index']);

// Route untuk halaman registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

