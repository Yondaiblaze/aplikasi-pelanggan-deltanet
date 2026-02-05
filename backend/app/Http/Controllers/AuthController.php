<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppCustomer as Customer; // Gunakan model baru kamu
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * TAHAP 1: LOGIN (Cek Kredensial & Buat OTP)
     */
    public function login(Request $request) {
    // Gunakan trim() untuk membuang spasi liar di depan/belakang
    $contact = trim($request->contact);
    $password = $request->password;

    if (!str_starts_with($contact, '+')) {
        $contact = '+' . $contact;
    }

    $user = Customer::where('contact', $contact)->first();

    // Diagnosa: Apakah user ketemu?
    if (!$user) {
        return response()->json(['message' => 'Nomor HP tidak ditemukan: ' . $contact], 401);
    }

    // Diagnosa: Apakah password cocok?
    if (!Hash::check($password, $user->password)) {
         return response()->json(['message' => 'Password salah untuk nomor: ' . $contact], 401);
    }

    // Jika semua OK, lanjut OTP
    $otp = rand(111111, 999999);
    $user->update([
        'otp_code' => $otp,
        'otp_expiry' => Carbon::now('Asia/Jakarta')->addMinutes(5)
    ]);

    return response()->json(['message' => 'Password benar, silakan verifikasi OTP']);
}

    /**
     * TAHAP 2: VERIFIKASI OTP (Mengecek kode dari database)
     */
    public function verifyOtp(Request $request)
{
    // 1. Validasi input
    $this->validate($request, [
        'contact'  => 'required',
        'otp_code' => 'required'
    ]);

    // 2. Cari user berdasarkan nomor dan kode OTP
    $user = Customer::where('contact', $request->contact)
                ->where('otp_code', $request->otp_code)
                ->first();

    // 3. Cek apakah user ditemukan
    if (!$user) {
        return response()->json(['message' => 'Kode OTP salah'], 401);
    }

    // 4. Cek apakah OTP sudah kedaluwarsa (menggunakan Carbon yang sudah kita sinkronkan tadi)
    if (\Illuminate\Support\Carbon::now('Asia/Jakarta')->gt($user->otp_expiry)) {
        return response()->json(['message' => 'Kode OTP sudah kedaluwarsa'], 401);
    }

    // 5. JIKA LOLOS: Bersihkan OTP di database agar tidak bisa dipakai lagi
    $user->update([
        'otp_code'   => null,
        'otp_expiry' => null
    ]);

    // 6. GENERATE TOKEN (Gunakan library JWT yang kamu pakai, misal Firebase JWT atau Tymon)
    // Contoh sederhana jika kamu sudah set up JWT:
    $token = JWTAuth::fromUser($user);

    // 7. KIRIM RESPONSE (Bagian yang kamu tanyakan)
    return response()->json([
        'status' => 'success',
        'message' => 'Verifikasi berhasil',
        'token'  => $token, // Token inilah yang ditunggu oleh Frontend
        'user'   => $user
    ], 200);
}

    /**
     * REGISTER
     */
    public function register(Request $request)
{
    // 1. Validasi input dasar
    $this->validate($request, [
        'name'     => 'required|string',
        'contact'  => 'required|unique:app_customers,contact',
        'password' => 'required|min:6',
    ]);

    // 2. Normalisasi nomor HP (Tambahkan '+' jika tidak ada)
    $contact = $request->contact;
    if (!str_starts_with($contact, '+')) {
        $contact = '+' . $contact;
    }

    // 3. LOGIKA MENCARI ID PENGGUNA DARI KODE REFERRAL
    $referralId = null; // Default jika tidak pakai kode

    if ($request->has('referred_by') && !empty($request->referred_by)) {
        // Cari user yang punya kode tersebut
        $inviter = Customer::where('referral_code', $request->referred_by)->first();

        if ($inviter) {
            // Kita ambil ID-nya (1, 2, 3...) untuk disimpan, bukan teks kodenya
            $referralId = $inviter->id;
        }
    }

    // 4. Simpan ke Database
    $user = Customer::create([
        'name'          => $request->name,
        'contact'       => $contact,
        'password'      => Hash::make($request->password),
        'referral_code' => $this->generateReferralCode(), // Kode unik milik dia sendiri
        'referral_id'   => $referralId, // ID milik si pengajak
        'otp_code'      => rand(111111, 999999),
        'otp_expiry'    => Carbon::now('Asia/Jakarta')->addMinutes(5)
    ]);

    // 5. Generate Token JWT agar bisa langsung masuk Dashboard
    $token = JWTAuth::fromUser($user);

    return response()->json([
        'status'  => 'success',
        'message' => 'Registrasi berhasil!',
        'token'   => $token, // Token dikirim ke Frontend
        'user'    => $user
    ], 201);
}

/**
 * Helper untuk generate kode referral unik untuk user baru
 */
private function generateReferralCode()
{
    return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    // Hasilnya misal: 7B2A91
}

    /**
     * RESET PASSWORD
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'contact'  => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Customer::where('contact', $request->contact)->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Password berhasil diperbarui.'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Berhasil logout']);
    }
}
