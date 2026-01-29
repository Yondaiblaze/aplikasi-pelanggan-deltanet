<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Ambil data profil user berdasarkan Token JWT
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'data' => auth()->user()
        ]);
    }

    /**
     * Registrasi pelanggan baru
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|string',
            'contact' => 'required|unique:customers',
            'email'   => 'required|email|unique:customers',
        ]);

        $customer = Customer::create([
            'name'    => $request->name,
            'contact' => $request->contact,
            'email'   => $request->email,
        ]);

        return response()->json(['message' => 'Registrasi berhasil, silakan login via OTP'], 201);
    }

    /**
     * Generate OTP dan suruh WhatsApp Yusuf buat kirim pesan
     */
    public function sendOtp(Request $request)
    {
        $contact = $request->input('contact');
        $customer = Customer::where('contact', $contact)->first();

        if (!$customer) {
            return response()->json(['message' => 'Nomor tidak terdaftar'], 404);
        }

        // 1. Generate OTP 6 Digit
        $otp = rand(100000, 999999);

        // 2. Simpan ke database lokal
        $customer->update([
            'otp_code' => $otp,
            'otp_expiry' => Carbon::now()->addMinutes(5)
        ]);

        // 3. Panggil fungsi WhatsApp untuk kirim pesan asli
        $message = "Kode OTP Deltanet Anda adalah: *$otp*. Jangan berikan kode ini kepada siapapun. Berlaku 5 menit.";
        $sent = $this->sendWhatsApp($contact, $message);

        if ($sent) {
            return response()->json(['message' => 'OTP berhasil dikirim ke WhatsApp']);
        }

        return response()->json(['message' => 'OTP gagal dikirim, cek koneksi gateway'], 500);
    }

    /**
     * Verifikasi OTP dan berikan Token JWT
     */
    public function login(Request $request)
    {
        $contact = $request->input('contact');
        $otp = $request->input('otp');

        $customer = Customer::where('contact', $contact)
                            ->where('otp_code', $otp)
                            ->where('otp_expiry', '>', Carbon::now())
                            ->first();

        if (!$customer) {
            return response()->json(['message' => 'OTP salah atau sudah kedaluwarsa'], 401);
        }

        // 4. Hapus OTP setelah sukses login agar tidak bisa dipakai lagi (Keamanan)
        $customer->update(['otp_code' => null]);

        // 5. Generate JWT Token
        $token = JWTAuth::fromUser($customer);

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'customer' => $customer
        ]);
    }

    /**
     * Logout dan hanguskan token
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Berhasil logout']);
    }

    /**
     * Helper internal untuk nembak script Node.js Yusuf
     */
    private function sendWhatsApp($number, $message)
    {
        // Pastikan port 3000 sesuai dengan yang dijalankan Yusuf di terminal
        $url = 'http://localhost:3000/send-message';

        try {
            $response = Http::post($url, [
                'number' => $number,
                'message' => $message
            ]);
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
