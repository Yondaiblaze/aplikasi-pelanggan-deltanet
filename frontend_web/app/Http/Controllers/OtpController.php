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
        // Gabungkan 6 input kotak OTP dari frontend menjadi satu string
        $otpCode = implode('', $request->otp_code ?? []);
        $phone = session('otp_phone');
        $otpType = session('otp_type', 'login');

        // Kirim verifikasi ke API Backend Lumen
        $response = Http::post('http://127.0.0.1:8000/api/verify-otp', [
            'contact'  => $phone,
            'otp_code' => $otpCode,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if ($otpType === 'forgot') {
                return redirect()->route('password.new')->with('success', 'OTP Valid! Silakan buat password baru.');
            }

            // Jika Login atau Register Berhasil
            session([
                'user_logged_in' => true,
                'user_token'     => $data['token'], // Token JWT asli dari backend
                'user_data'      => $data['user'],
                'user_name'      => $data['user']['name']
            ]);

            // Hapus session OTP karena sudah tidak dipakai
            session()->forget(['otp_code', 'otp_phone', 'otp_expires', 'otp_type']);

            return redirect()->route('dashboard')->with('success', 'Verifikasi berhasil! Selamat datang ' . $data['user']['name']);
        }

        // Jika OTP Salah (Misal memasukkan 123456 padahal di DB itu 635093)
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
