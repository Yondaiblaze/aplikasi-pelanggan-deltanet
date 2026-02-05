<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;

/* =======================
    AUTH & LANDING
======================= */

Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

/* REGISTER */
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/* LOGIN OTP FLOW */
// 1. User input nomor & password
Route::post('/login/send-otp', [OtpController::class, 'sendOtp'])->name('login.send-otp');

// 2. Tampilkan form input kode OTP
Route::get('/verify-otp', [OtpController::class, 'showOtpForm'])->name('otp.verify'); // <-- Ubah name jadi otp.verify agar sinkron

// 3. Proses verifikasi kode ke Lumen
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify.post'); // <-- Tambahkan .post

/* LOGOUT */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* FORGOT PASSWORD */
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.post');
Route::get('/password-baru', [AuthController::class, 'showNewPassword'])->name('password.new');
Route::post('/password-baru', [AuthController::class, 'updatePassword'])->name('password.update');

/* =======================
    DASHBOARD (PROTECTED)
======================= */
// Sebaiknya tambahkan middleware 'auth' nanti agar orang tidak bisa tembus dashboard tanpa login
Route::middleware(['auth.custom'])->group(function () {
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
   Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');
});
