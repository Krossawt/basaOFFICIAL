<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Root → Login
Route::get('/', fn () => redirect()->route('login'));

// Auth routes (controller handles authenticated-user redirect internally)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
