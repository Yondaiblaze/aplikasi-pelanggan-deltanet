<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| Web Routes - DeltaNet Project
|--------------------------------------------------------------------------
*/

/* ============================================================
    AUTH ROUTES (Login, Register, OTP, Password)
   ============================================================ */

Route::get('/', [AuthController::class, 'showLogin'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

/* REGISTER (TANPA OTP) */
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/* LOGIN OTP */
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'sendOtp'])->name('otp.resend');

/* LOGOUT */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* FORGOT PASSWORD */
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.post');
Route::get('/password-baru', [AuthController::class, 'showNewPassword'])->name('password.new');
Route::post('/password-baru', [AuthController::class, 'updatePassword'])->name('password.update');


/* ============================================================
    DASHBOARD & USER PANEL (Requires Auth)
   ============================================================ */

Route::middleware(['auth'])->group(function () {

    // Main Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Paket & Layanan
    Route::get('/paket', [DashboardController::class, 'paket'])->name('paket');

    // Profil User
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');

    // Sistem Tagihan & Pembayaran
    Route::get('/tagihan', [DashboardController::class, 'tagihan'])->name('tagihan');

    // Sistem Tiket Bantuan (CRUD)
    Route::prefix('tiket')->name('tiket.')->group(function () {
        Route::get('/', [DashboardController::class, 'tiket'])->name('index');
        Route::get('/buat', [DashboardController::class, 'buatTiket'])->name('buat');
        Route::get('/edit/{id}', [DashboardController::class, 'editTiket'])->name('edit');
        Route::post('/simpan', [DashboardController::class, 'simpanTiket'])->name('simpan');
        Route::post('/update/{id}', [DashboardController::class, 'updateTiket'])->name('update');
    });

    // Referral & Komisi
    Route::get('/referral', [DashboardController::class, 'referral'])->name('referral');
    Route::get('/komisi', [DashboardController::class, 'komisi'])->name('komisi');

    // Tracking & Pengaturan
    Route::get('/tracking/detail', [DashboardController::class, 'trackingDetail'])->name('tracking.detail');
    Route::get('/pengaturan', [DashboardController::class, 'pengaturan'])->name('pengaturan');

});
