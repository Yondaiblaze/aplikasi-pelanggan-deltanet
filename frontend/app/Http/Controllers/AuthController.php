<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /* =======================
       LOGIN
    ======================= */
    public function showLogin()
    {
        return view('auth.login');
    }

    /* =======================
       REGISTER (TANPA OTP)
    ======================= */
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // VALIDASI (opsional)
        // $request->validate([...]);

        // SIMPAN USER (simulasi / database)
        // User::create([...]);
        
        // Set session untuk auto login
        session([
            'user_logged_in' => true,
            'user_name' => $request->name,
            'user_phone' => ($request->country_code ?? '+62') . ($request->nomor ?? '812345678')
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di DeltaNet.');
    }

    /* =======================
       LOGOUT
    ======================= */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')
            ->with('success', 'Logout berhasil!');
    }

    /* =======================
       FORGOT PASSWORD
    ======================= */
    public function showForgotPassword()
    {
        return view('auth.forgot');
    }

    public function forgotPassword(Request $request)
    {
        $fullPhone = ($request->country_code ?? '+62') . ($request->whatsapp ?? '812345678');
        
        session([
            'whatsapp' => $fullPhone,
            'otp_type' => 'forgot'
        ]);

        return redirect()->route('otp.form')
            ->with('success', 'Kode OTP telah dikirim ke WhatsApp Anda!');
    }

    public function showNewPassword()
    {
        return view('auth.new-password');
    }

    public function updatePassword(Request $request)
    {
        // UPDATE PASSWORD (simulasi / database)
        // User::where('whatsapp', session('whatsapp'))->update([...]);

        session()->forget(['whatsapp', 'otp_type']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah! Silakan login.');
    }
}
