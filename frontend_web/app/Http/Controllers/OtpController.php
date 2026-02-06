<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    /* =======================
       MENAMPILKAN FORM OTP
    ======================= */
    public function showOtpForm()
    {
        // Pastikan ada nomor HP di session agar form tidak kosong
        if (!session('otp_phone')) {
            return redirect()->route('login')->with('error', 'Sesi berakhir, silakan masukkan nomor HP kembali.');
        }
        return view('auth.otp');
    }

    /* =======================
       VERIFIKASI OTP (REAL API)
    ======================= */
    public function verifyOtp(Request $request)
    {
        $otpCode = implode('', $request->otp_code ?? []);
        $phone = session('otp_phone');
        $otpType = session('otp_type', 'login');

        $response = Http::post('http://127.0.0.1:8000/api/verify-otp', [
            'contact'  => $phone,
            'otp_code' => $otpCode,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if ($otpType === 'forgot') {
                return redirect()->route('password.new')->with('success', 'OTP Valid! Silakan buat password baru.');
            }

            // Set session login
            session([
                'user_logged_in' => true,
                'user_token'     => $data['token'],
                'user_data'      => $data['user'],
                'user_name'      => $data['user']['name']
            ]);

            // Jika centang "Ingat Saya", set cookie 7 hari
            if (session('remember_me')) {
                cookie()->queue('remember_token', $data['token'], 10080); // 7 hari = 10080 menit
                cookie()->queue('remember_user', json_encode($data['user']), 10080);
            }

            session()->forget(['otp_code', 'otp_phone', 'otp_expires', 'otp_type', 'remember_me']);

            return redirect()->route('dashboard')->with('success', 'Verifikasi berhasil! Selamat datang ' . $data['user']['name']);
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
    }

    /* =======================
       RESEND OTP (KIRIM ULANG)
    ======================= */
    public function sendOtp(Request $request)
    {
        $phone = $request->phone ?? session('otp_phone');

        // Panggil API Backend untuk generate ulang OTP di DB
        $response = Http::post('http://127.0.0.1:8000/api/resend-otp', [
            'contact' => $phone
        ]);

        if ($response->successful()) {
            return redirect()->route('otp.form')->with('success', 'Kode OTP baru telah dikirim ke WhatsApp Anda!');
        }

        return back()->with('error', 'Gagal mengirim ulang OTP.');
    }
}
