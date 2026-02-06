<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|string'
        ]);
        
        $contact = $request->contact;
        $otpCode = rand(100000, 999999);
        
        // Cari atau buat customer
        $customer = Customer::where('contact', $contact)->first();
        if (!$customer) {
            $customer = Customer::create([
                'name' => 'Customer ' . substr($contact, -4),
                'contact' => $contact
            ]);
        }
        
        // Update OTP
        $customer->otp_code = $otpCode;
        $customer->otp_expiry = now()->addMinutes(5);
        $customer->save();
        
        return response()->json([
            'message' => 'OTP berhasil dikirim',
            'otp_code' => $otpCode // Untuk testing, di production jangan return OTP
        ]);
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|string',
            'otp_code' => 'required|string'
        ]);
        
        $customer = Customer::where('contact', $request->contact)
            ->where('otp_code', $request->otp_code)
            ->where('otp_expiry', '>', now())
            ->first();
            
        if (!$customer) {
            return response()->json(['error' => 'OTP tidak valid atau expired'], 401);
        }
        
        // Clear OTP
        $customer->otp_code = null;
        $customer->otp_expiry = null;
        $customer->save();
        
        // Generate JWT token
        $token = auth()->login($customer);
        
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'customer' => $customer
        ]);
    }
}