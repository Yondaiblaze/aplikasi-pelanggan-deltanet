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
        if (session('user_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $phoneInput = $request->phone ?? $request->nomor;
        $fullPhone = $this->formatPhone($request->country_code ?? '+62', $phoneInput);

        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'contact'  => $fullPhone,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            session([
                'otp_phone'   => $fullPhone,
                'otp_type'    => 'login',
                'remember_me' => $request->has('remember')
            ]);
            return redirect()->route('otp.form')->with('success', 'Password benar! Masukkan kode OTP.');
        }

        return back()->withErrors(['error' => 'Nomor HP atau Password salah.'])->withInput();
    }

    /* =======================
       REGISTER (DENGAN LOGIKA REFERRAL ID)
    ======================= */
    public function showRegister()
    {
        if (session('user_token')) {
            return redirect()->route('dashboard');
        }
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
        cookie()->queue(cookie()->forget('remember_token'));
        cookie()->queue(cookie()->forget('remember_user'));
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    /* =======================
       FORGOT PASSWORD (LOGIKA API)
    ======================= */
    public function showForgotPassword()
    {
        return view('auth.forgot');
    }

    public function forgotPassword(Request $request)
    {
        $fullPhone = $this->formatPhone($request->country_code ?? '+62', $request->whatsapp);

        // Cek apakah nomor terdaftar
        $user = User::where('contact', $fullPhone)->first();
        if (!$user) {
            return back()->withErrors(['whatsapp' => 'Nomor WhatsApp tidak terdaftar.'])->withInput();
        }

        // Gunakan endpoint resend-otp yang sudah ada (sama seperti login)
        $response = Http::post('http://127.0.0.1:8000/api/resend-otp', [
            'contact' => $fullPhone
        ]);

        session([
            'otp_phone' => $fullPhone,
            'otp_type' => 'forgot'
        ]);
        
        return redirect()->route('otp.form')->with('success', 'Kode OTP telah dikirim. Cek kolom otp_code di tabel app_customers.');
    }

    public function showNewPassword()
    {
        if (!session('otp_phone') || session('otp_type') !== 'forgot') {
            return redirect()->route('login')->withErrors(['error' => 'Sesi tidak valid.']);
        }
        return view('auth.new-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $phone = session('otp_phone');
        $user = User::where('contact', $phone)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'User tidak ditemukan.']);
        }

        $user->update(['password' => Hash::make($request->password)]);
        session()->forget(['otp_phone', 'otp_type']);

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }
}
