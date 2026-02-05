<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // 1. Membersihkan input nomor telepon
        $fullPhone = $request->country_code . ltrim($request->phone, '0');

        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'contact'  => $fullPhone,
            'password' => $request->password
        ]);

        if ($response->successful()) {
            // Simpan nomor di session agar sinkron dengan tampilan di Blade
            session(['otp_phone' => $fullPhone]);

            return redirect()->route('otp.verify')->with('success', 'Kode OTP telah dikirim!');
        }

        return back()->withErrors(['phone' => 'Nomor atau Password salah!']);
    }

    public function showOtpForm()
    {
        // Proteksi: Jangan biarkan akses langsung ke /otp tanpa proses login
        if (!session()->has('otp_phone')) {
            return redirect()->route('login');
        }

        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $otpCode = is_array($request->otp) ? implode('', $request->otp) : $request->otp_code;
        $phone = session('otp_phone');

        $response = Http::post('http://127.0.0.1:8000/api/verify-otp', [
            'contact'  => $phone,
            'otp_code' => $otpCode
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Simpan token dan data user
            session([
                'user_token' => $data['token'],
                'user_data'  => $data['user']
            ]);

            // LOGIKA INGAT SAYA (7 HARI)
            if (session('remember_me')) {
                // Kita set lifetime session secara dinamis untuk user ini
                config(['session.lifetime' => 10080]); // 7 hari dalam menit
            }

            // Hapus data sementara
            session()->forget(['otp_phone', 'remember_me']);

            return redirect()->route('dashboard')->with('success', 'Selamat Datang!');
        }

        return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
    }
}
