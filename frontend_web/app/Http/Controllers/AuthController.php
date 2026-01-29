<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor' => 'required|numeric|digits_between:10,15',
            'password' => 'required|string|min:8',
        ]);

        // Simulasi registrasi berhasil (tidak simpan ke database)
        return redirect()->route('register')->with('success', 'Registrasi berhasil!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Simulasi login berhasil (tidak cek database)
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['whatsapp' => 'required|numeric|digits_between:10,15']);
        
        // Simulasi kirim WhatsApp (dalam implementasi nyata gunakan WhatsApp API)
        return redirect()->route('otp.show')->with(['success' => 'Kode OTP telah dikirim ke WhatsApp Anda.', 'whatsapp' => $request->whatsapp]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function showOtp()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;
        
        // Simulasi verifikasi OTP (dalam implementasi nyata cek dengan database/cache)
        if ($otp === '123456') {
            return redirect()->route('password.new')->with('success', 'OTP berhasil diverifikasi.');
        }
        
        return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
    }

    public function showNewPassword()
    {
        return view('auth.new-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simulasi update password berhasil
        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

    public function tagihan()
    {
        return view('tagihan');
    }
}