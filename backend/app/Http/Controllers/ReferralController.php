<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Referral;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    /**
     * Persentase komisi referral (10%)
     * Bisa dipindah ke config kalau mau
     */
    private float $commissionRate = 0.10;

    public function __construct()
    {
        // $this->middleware('auth'); // aktifkan di production
    }

    /**
     * ================================
     * GET DATA REFERRAL USER
     * ================================
     */
    public function getMyReferralCode()
    {
        $user = auth()->user();

        return response()->json([
            'status' => 'success',
            'data' => [
                'referral_code'      => $user->referral_code,
                'total_referrals'    => Referral::where('referrer_id', $user->id)->count(),
                'total_commission'   => Commission::where('user_id', $user->id)
                    ->where('status', 'paid')
                    ->sum('amount'),
                'pending_commission' => Commission::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->sum('amount')
            ]
        ]);
    }

    /**
     * ================================
     * APPLY REFERRAL CODE
     * ================================
     */
    public function applyReferralCode(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|string'
        ]);

        $user = auth()->user();
        $referralCode = strtoupper($request->referral_code);

        // Cari referrer
        $referrer = Customer::where('referral_code', $referralCode)->first();

        if (!$referrer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode referral tidak valid'
            ], 400);
        }

        if (!$referrer->is_member) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode referral hanya berlaku untuk member'
            ], 400);
        }

        if ($referrer->id === $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak dapat menggunakan kode referral sendiri'
            ], 400);
        }

        // Cek apakah user sudah pakai referral
        if (Referral::where('referred_id', $user->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah menggunakan kode referral'
            ], 400);
        }

        // Simpan referral
        Referral::create([
            'referrer_id'  => $referrer->id,
            'referred_id'  => $user->id,
            'referral_code' => $referralCode,
            'status'       => 'active'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kode referral berhasil digunakan'
        ]);
    }

    /**
     * ================================
     * LIST REFERRAL YANG DIMILIKI USER
     * ================================
     */
    public function myReferrals()
    {
        $user = auth()->user();

        $referrals = Referral::where('referrer_id', $user->id)
            ->with('referred:id,name,contact')
            ->get()
            ->map(function ($referral) {
                return [
                    'id' => $referral->id,
                    'referred_user' => [
                        'name'    => $referral->referred->name,
                        'contact' => $referral->referred->contact
                    ],
                    'referral_code' => $referral->referral_code,
                    'status'        => $referral->status,
                    'created_at'    => $referral->created_at
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $referrals
        ]);
    }

    /**
     * ================================
     * INVITE FRIEND (DUMMY / SIMULASI)
     * ================================
     */
    public function inviteFriend(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'phone' => 'required|string'
        ]);

        $user = auth()->user();
        $name = Str::title(strtolower($request->name));

        return response()->json([
            'status' => 'success',
            'message' => "Undangan untuk {$name} berhasil dikirim",
            'data' => [
                'referral_code' => $user->referral_code,
                'invite_link'   => "https://app.deltanet.com/register?ref={$user->referral_code}",
                'friend_name'  => $name,
                'friend_phone' => $request->phone
            ]
        ]);
    }

    /**
     * ================================
     * PROSES KOMISI SETELAH INVOICE PAID
     * ================================
     */
    public function processCommission($invoiceId, $amount)
    {
        // Cegah komisi dobel
        if (Commission::where('invoice_id', $invoiceId)->exists()) {
            return false;
        }

        // Cari referral dari user yang bayar invoice
        $referral = Referral::whereHas('referred.invoices', function ($query) use ($invoiceId) {
            $query->where('id', $invoiceId)
                ->where('status', 'paid');
        })->first();

        if (!$referral) {
            return false;
        }

        if (!$referral->referrer->is_member) {
            return false;
        }

        $commissionAmount = $amount * $this->commissionRate;

        Commission::create([
            'user_id'          => $referral->referrer_id,
            'referred_user_id' => $referral->referred_id,
            'referral_code'    => $referral->referral_code,
            'amount'           => $commissionAmount,
            'status'           => 'pending', // penting
            'invoice_id'       => $invoiceId,
            'earned_date'      => now()->toDateString()
        ]);

        return true;
    }
}
