<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // Validasi field wajib terlebih dahulu
        $request->validate([
            'name'     => 'required|string|max:255',
            'contact'  => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'contact.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        // Validasi kode referral jika diisi
        if ($request->filled('referral_code')) {
            $referralExists = User::where('referral_code', trim($request->referral_code))->exists();
            if (!$referralExists) {
                return back()->withErrors(['referral_code' => 'Maaf, kode referral tersebut tidak terdaftar.'])->withInput();
            }
        }

        // Format nomor HP dengan country code
        $fullPhone = $this->formatPhone($request->country_code ?? '+62', $request->contact);

        // Cek apakah nomor HP sudah terdaftar
        if (User::where('contact', $fullPhone)->exists()) {
            return back()->withErrors(['contact' => 'Nomor WhatsApp sudah terdaftar.'])->withInput();
        }

        // Cari pemilik referral berdasarkan kode yang diinput
        $referrerId = null;
        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', trim($request->referral_code))->first();
            $referrerId = $referrer ? $referrer->id : null;
        }

        // Simpan data
        $user = User::create([
            'name'          => $request->name,
            'contact'       => $fullPhone,
            'password'      => Hash::make($request->password),
            'referral_id'   => $referrerId,
            'referral_code' => strtoupper(Str::random(6)),
        ]);

        // Set session SEBELUM redirect (PENTING!)
        session()->put('user_logged_in', true);
        session()->put('user_token', 'register_token_' . $user->id);
        session()->put('user_data', [
            'id' => $user->id,
            'name' => $user->name,
            'contact' => $user->contact,
            'referral_code' => $user->referral_code
        ]);
        session()->put('user_name', $user->name);
        session()->save(); // Paksa save session

        return redirect()->route('dashboard');
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
