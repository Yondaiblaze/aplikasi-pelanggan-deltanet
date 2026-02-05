<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // Simulasi - terima input apapun
        $fullPhone = ($request->country_code ?? '+62') . ($request->phone ?? '812345678');
        
        // Generate OTP demo
        $otp = '123456'; // OTP tetap untuk simulasi
        
        // Simpan ke session untuk simulasi
        session([
            'otp_code' => $otp,
            'otp_phone' => $fullPhone,
            'otp_expires' => now()->addMinutes(5),
            'otp_type' => 'login' // Set type untuk login
        ]);
        
        return redirect()->route('otp.form')->with([
            'phone' => $fullPhone,
            'success' => 'Kode OTP telah dikirim. Demo OTP: 123456'
        ]);
    }

    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        // Simulasi - terima OTP apapun
        $otpType = session('otp_type');
        
        if ($otpType === 'forgot') {
            // Redirect ke halaman password baru untuk forgot password
            return redirect()->route('password.new')->with('success', 'OTP berhasil diverifikasi! Silakan buat password baru.');
        } elseif ($otpType === 'register') {
            // Redirect ke login untuk register
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } elseif ($otpType === 'login') {
            // Clear OTP session data setelah login berhasil
            session()->forget(['otp_code', 'otp_phone', 'otp_expires', 'otp_type']);
            // Redirect ke dashboard untuk login
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }
        
        // Fallback jika tidak ada type yang cocok
        return redirect()->route('login')->with('error', 'Terjadi kesalahan. Silakan login ulang.');
    }
}