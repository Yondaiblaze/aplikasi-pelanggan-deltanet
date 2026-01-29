<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
     * Generate OTP dan kirim via WhatsApp Yusuf
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

        // 2. Simpan ke database
        $customer->update([
            'otp_code' => $otp,
            'otp_expiry' => Carbon::now()->addMinutes(5)
        ]);

        // 3. Kirim WhatsApp (Dengan Proteksi Error agar tidak Timeout)
        $message = "Kode OTP Deltanet Anda adalah: *$otp*. Berlaku 5 menit.";
        $sent = $this->sendWhatsApp($contact, $message);

        if ($sent) {
            return response()->json([
                'status' => 'success',
                'message' => 'OTP berhasil dikirim ke WhatsApp'
            ]);
        } else {
            // Mode Bypass: Tetap sukseskan response tapi beri info manual
            return response()->json([
                'status' => 'warning',
                'message' => 'Gateway WA Yusuf offline, gunakan OTP dari database (Mode Bypass)',
                'debug_otp' => $otp // Hapus baris ini jika sudah masuk tahap produksi (production)
            ]);
        }
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

        // Hapus OTP setelah sukses login
        $customer->update(['otp_code' => null]);

        // PERBAIKAN DI SINI: Gunakan JWTAuth::fromUser()
        // Ini akan menghasilkan token langsung dari objek $customer
        $token = JWTAuth::fromUser($customer);

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'customer' => $customer
        ]);
    }
    /**
     * Logout
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Berhasil logout']);
    }

    /**
     * Helper untuk nembak API Yusuf
     */
    private function sendWhatsApp($number, $message)
    {
        // URL Yusuf (Port 80 Laragon)
        $url = 'http://10.231.221.206/wa-gate/public/api/send-message';

        try {
            // Timeout singkat (2 detik) supaya Postman kamu tidak macet lama
            $response = Http::timeout(2)->post($url, [
                'number' => $number,
                'message' => $message
            ]);
            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Koneksi ke Yusuf Gagal: " . $e->getMessage());
            return false;
        }
    }
}
