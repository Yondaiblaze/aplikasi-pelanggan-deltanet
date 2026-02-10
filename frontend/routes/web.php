<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;

/* =======================
   AUTH
======================= */
Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

/* REGISTER (TANPA OTP) */
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/* LOGIN OTP */
Route::post('/login/send-otp', [OtpController::class, 'sendOtp'])->name('login.send-otp');
Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

/* LOGOUT */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* FORGOT PASSWORD */
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.post');
Route::get('/password-baru', [AuthController::class, 'showNewPassword'])->name('password.new');
Route::post('/password-baru', [AuthController::class, 'updatePassword'])->name('password.update');

/* =======================
   DASHBOARD
======================= */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/paket', [DashboardController::class, 'paket'])->name('paket');
Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
Route::get('/tagihan', [DashboardController::class, 'tagihan'])->name('tagihan');
Route::get('/tiket', [DashboardController::class, 'tiket'])->name('tiket');
Route::get('/tiket/buat', [DashboardController::class, 'buatTiket'])->name('tiket.buat');
Route::get('/tiket/edit/{id}', [DashboardController::class, 'editTiket'])->name('tiket.edit');
Route::post('/tiket/simpan', [DashboardController::class, 'simpanTiket'])->name('tiket.simpan');
Route::post('/tiket/update/{id}', [DashboardController::class, 'updateTiket'])->name('tiket.update');
Route::get('/referral', [DashboardController::class, 'referral'])->name('referral');
Route::get('/komisi', [DashboardController::class, 'komisi'])->name('komisi');
Route::get('/tracking/detail', [DashboardController::class, 'trackingDetail'])->name('tracking.detail');
Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
