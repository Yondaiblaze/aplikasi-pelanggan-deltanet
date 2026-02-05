<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /* =======================
       HELPER: BIAR FORMAT HP SAMA (WAJIB ADA)
    ======================= */
    private function formatPhone($countryCode, $phone)
    {
        $cleanPhone = ltrim($phone, '0');
        $fullPhone = $countryCode . $cleanPhone;
        return str_starts_with($fullPhone, '+') ? $fullPhone : '+' . $fullPhone;
    }

    /* =======================
       LOGIN (GABUNGAN LOGIKA API + UI BARU)
    ======================= */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Sesuaikan: Frontend baru mungkin pakai name='phone' atau name='nomor'
        $phoneInput = $request->phone ?? $request->nomor;
        $fullPhone = $this->formatPhone($request->country_code ?? '+62', $phoneInput);

        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'contact'  => $fullPhone,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            session([
                'otp_phone'   => $fullPhone,
                'remember_me' => $request->has('remember')
            ]);
            // Redirect sesuai route tim frontend (otp.verify atau otp.form)
            return redirect()->route('otp.verify')->with('success', 'Password benar! Masukkan kode OTP.');
        }

        return back()->withErrors(['error' => 'Nomor HP atau Password salah.']);
    }

    /* =======================
       REGISTER (DENGAN LOGIKA REFERRAL ID)
    ======================= */
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Sesuaikan nama field dari tim frontend baru (misal: 'nomor')
        $phoneInput = $request->nomor ?? $request->phone;
        $fullPhone = $this->formatPhone($request->country_code ?? '+62', $phoneInput);

        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name'          => $request->name,
            'contact'       => $fullPhone,
            'password'      => $request->password,
            'referred_by'   => $request->referred_by, // Tetap tangkap kode referral
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Simpan TOKEN asli dari backend agar tidak dianggap simulasi
            session([
                'user_logged_in' => true,
                'user_token'     => $data['token'],
                'user_data'      => $data['user'],
                'user_name'      => $data['user']['name']
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang di DeltaNet.');
        }

        return back()->withErrors(['error' => 'Gagal daftar: ' . ($response->json()['message'] ?? 'Terjadi kesalahan')]);
    }

    /* =======================
       LOGOUT
    ======================= */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    /* =======================
       FORGOT PASSWORD (LOGIKA API)
    ======================= */
    public function showForgotPassword()
    {
        return view('auth.forgot');
    }

    // ... Fungsi forgotPassword & updatePassword harus disesuaikan ke API Backend nantinya
}
