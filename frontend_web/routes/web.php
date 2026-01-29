<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.post');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('/otp', [AuthController::class, 'showOtp'])->name('otp.show');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/password-baru', [AuthController::class, 'showNewPassword'])->name('password.new');
Route::post('/password-baru', [AuthController::class, 'updatePassword'])->name('password.update');

Route::get('/tagihan', [AuthController::class, 'tagihan'])->name('tagihan');
