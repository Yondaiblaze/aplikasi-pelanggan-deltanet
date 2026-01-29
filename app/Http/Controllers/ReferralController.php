<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        
        // Generate kode referral berdasarkan ID customer
        $referralCode = 'REF' . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
        
        // Hitung jumlah teman yang sudah bergabung
        $totalReferrals = Customer::where('referral_code', $referralCode)->count();
        
        return response()->json([
            'referral_code' => $referralCode,
            'total_referrals' => $totalReferrals,
            'whatsapp_message' => "Halo! Yuk gabung ke DeltaNet pakai kode referral saya: {$referralCode}. Dapatkan benefit menarik!"
        ]);
    }
    
    public function friends(Request $request)
    {
        $customer = $request->user();
        $referralCode = 'REF' . str_pad($customer->id, 6, '0', STR_PAD_LEFT);
        
        $friends = Customer::where('referral_code', $referralCode)
            ->select('name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return response()->json($friends);
    }
}