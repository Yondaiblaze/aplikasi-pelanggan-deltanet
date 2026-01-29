<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function logout()
{
    auth()->logout();
    return response()->json(['message' => 'Berhasil logout']);
}
    public function me()
{
    // Mengambil data user yang sedang login dari token
    return response()->json([
        'status' => 'success',
        'data' => auth()->user()
    ]);
}
    public function register(Request $request)
{
    $this->validate($request, [
        'name'    => 'required|string',
        'contact' => 'required|unique:customers', // Pastikan nomor HP belum terdaftar
        'email'   => 'required|email|unique:customers',
    ]);

    $customer = Customer::create([
        'name'    => $request->name,
        'contact' => $request->contact,
        'email'   => $request->email,
    ]);

    return response()->json(['message' => 'Registrasi berhasil, silakan login via OTP'], 201);
}
    public function sendOtp(Request $request)
    {
        $contact = $request->input('contact');
        $customer = Customer::where('contact', $contact)->first();

        if (!$customer) {
            return response()->json(['message' => 'Nomor tidak terdaftar'], 404);
        }

        // 1. Generate OTP 6 Digit
        $otp = rand(100000, 999999);

        // 2. Simpan ke database lokal kamu
        $customer->update([
            'otp_code' => $otp,
            'otp_expiry' => Carbon::now()->addMinutes(5)
        ]);

        // 3. Simulasi Kirim WA (Nanti dihubungkan ke API Gateway)
        // Log::info("Kirim OTP $otp ke $contact");

        return response()->json(['message' => 'OTP berhasil dikirim ke WhatsApp']);
    }

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

        // 4. Generate JWT Token untuk akses API selanjutnya
        $token = JWTAuth::fromUser($customer);

        return response()->json([
            'token' => $token,
            'customer' => $customer
        ]);
    }
}
