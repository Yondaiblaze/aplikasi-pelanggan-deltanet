<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OtpCode;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // 1. Validasi Input
        $this->validate($request, [
            'phone' => 'required',
            'type'  => 'required|in:login,register,forgot_password'
        ]);

        // 2. Revisi Atasan: Cek Akun Terdaftar (Kecuali untuk Register)
        if ($request->type !== 'register') {
            $userExists = Customer::where('contact', $request->phone)->exists();
            if (!$userExists) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Akun tidak terdaftar'
                ], 404);
            }
        }

        // 3. Anti-Spam: Cek limit 60 detik (Mencegah bom OTP)
        $isSpam = OtpCode::where('phone', $request->phone)
                    ->where('created_at', '>', Carbon::now()->subMinute())
                    ->first();

        if ($isSpam) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Tunggu 1 menit untuk kirim ulang'
            ], 429);
        }

        // 4. Generate & Simpan OTP
        // $otp = rand(1000, 9999);
        $otp = "1234"; // OTP untuk mengetes
        OtpCode::create([
            'phone'      => $request->phone,
            'code'       => $otp,
            'type'       => $request->type,
            'expired_at' => Carbon::now()->addMinutes(30)
        ]);

        // 5. Integrasi WhatsApp Service (Opsional jika Service sudah siap)
        // $wa = new \App\Services\WhatsAppService();
        // $wa->sendMessage($request->phone, "Kode OTP Deltanet Anda adalah: $otp");

        return response()->json([
            'status'  => 'success',
            'message' => 'MODE TESTING : Gunakan kode 1234',
            'otp_debug' => $otp // Hapus baris ini jika sudah masuk tahap produksi
        ]);
    }

    public function verifyOtp(Request $request)
{
    $response = \Illuminate\Support\Facades\Http::post('http://127.0.0.1:8000/api/verify-otp', [
        'contact'  => session('otp_phone'),
        'otp_code' => $request->otp_code
    ]);

    if ($response->successful()) {
        $data = $response->json();

        // Simpan token JWT dari Lumen ke Session Laravel
        session(['user_token' => $data['token']]);

        return redirect()->route('dashboard')->with('success', 'Selamat datang!');
    }

    return back()->withErrors(['msg' => 'Kode OTP salah atau sudah kadaluwarsa!']);
}
}
