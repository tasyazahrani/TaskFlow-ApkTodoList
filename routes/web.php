<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Route untuk landing page (halaman utama untuk user yang belum login)
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Route untuk halaman registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang membutuhkan authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard menggunakan tasks.index
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    
    // Task routes (tanpa index karena sudah digunakan untuk dashboard)
// Tasks Routes (gunakan URL bahasa Indonesia)
Route::get('/tugas', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tugas/buat', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tugas', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tugas/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tugas/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tugas/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tugas/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});