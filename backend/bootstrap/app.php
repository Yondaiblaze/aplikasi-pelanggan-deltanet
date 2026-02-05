<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Referral;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        // Tidak perlu middleware auth di sini karena sudah di route
    }

    public function index()
    {
        $user = auth()->user();

        // Dummy data untuk invoice jika tidak ada
        $unpaidCount = 2;
        $totalUnpaidAmount = 350000;

        // Ambil total komisi
        $totalCommission = Commission::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount') ?? 0;

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'contact' => $user->contact,
                    'referral_code' => $user->referral_code,
                    'is_member' => $user->is_member ?? false
                ],
                'billing_summary' => [
                    'unpaid_invoices' => $unpaidCount,
                    'total_bill' => $totalUnpaidAmount,
                ],
                'commission_summary' => [
                    'total_earned' => $totalCommission,
                    'pending_commission' => Commission::where('user_id', $user->id)
                        ->where('status', 'pending')
                        ->sum('amount') ?? 0,
                    'total_referrals' => Referral::where('referrer_id', $user->id)->count()
                ],
                'recent_referrals' => Referral::where('referrer_id', $user->id)
                    ->with('referred:id,name,created_at')
                    ->latest()
                    ->limit(3)
                    ->get()
                    ->map(function ($ref) {
                        return [
                            'name' => $ref->referred->name ?? 'Unknown',
                            'created_at' => $ref->created_at,
                            'status' => 'Aktif'
                        ];
                    })
            ]
        ]);
    }

    public function getBillingStatus()
    {
        $user = auth()->user();

        // Dummy data tagihan
        $invoices = [
            [
                'id' => 1,
                'amount' => 150000,
                'status' => 'paid',
                'due_date' => '2024-01-15',
                'paid_at' => '2024-01-10 10:30:00',
                'is_paid' => true
            ],
            [
                'id' => 2,
                'amount' => 200000,
                'status' => 'unpaid',
                'due_date' => '2024-02-15',
                'paid_at' => null,
                'is_paid' => false
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $invoices
        ]);
    }

    public function getProfile()
    {
        $user = auth()->user();

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'contact' => $user->contact,
                'email' => $user->email ?? null,
                'referral_code' => $user->referral_code,
                'is_member' => $user->is_member ?? false,
                'created_at' => $user->created_at,
                'last_login' => now()
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255'
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        if ($request->email) {
            $user->email = $request->email;
        }
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile berhasil diupdate',
            'data' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    }
}
