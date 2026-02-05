<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Commission;
use App\Models\Referral;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    // Konfigurasi keuntungan referral
    private $referralBenefits = [
        'commission_percentage' => 5, // 5% dari invoice yang dibayar
        'minimum_withdraw' => 50000,
        'description' => 'Dapatkan komisi 5% dari setiap invoice yang dibayar oleh customer yang Anda referensikan',
    ];

    /**
     * Get referral benefits information
     */
    public function benefits()
    {
        return api_success('referral.benefits_info', [
            'commission_percentage' => $this->referralBenefits['commission_percentage'],
            'minimum_withdraw' => $this->referralBenefits['minimum_withdraw'],
            'description' => $this->referralBenefits['description'],
            'how_it_works' => [
                'step_1' => 'Bagikan kode referral unik Anda ke teman atau keluarga',
                'step_2' => 'Teman Anda mendaftar menggunakan kode referral Anda',
                'step_3' => 'Ketika teman Anda membayar invoice, Anda mendapatkan komisi 5%',
                'step_4' => 'Tarik komisi Anda kapan saja dengan minimum Rp ' . number_format($this->referralBenefits['minimum_withdraw'], 0, ',', '.'),
            ],
            'tips' => [
                'Semakin banyak referral, semakin besar komisi Anda',
                'Tidak ada batasan jumlah orang yang bisa Anda referensikan',
                'Komisi akan langsung masuk ke akun Anda setelah customer membayar',
            ]
        ]);
    }

    /**
     * Get all commissions for the authenticated user
     */
    public function index()
    {
        $user = auth()->user();

        $commissions = Commission::where('user_id', $user->id)
            ->with(['referredUser:id,name,contact'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($commission) {
                return [
                    'id' => $commission->id,
                    'amount' => $commission->amount,
                    'status' => $commission->status,
                    'earned_date' => $commission->earned_date,
                    'referral_code' => $commission->referral_code,
                    'referred_user' => [
                        'name' => $commission->referredUser->name ?? 'Unknown',
                        'contact' => $commission->referredUser->contact ?? 'Unknown'
                    ],
                    'created_at' => $commission->created_at
                ];
            });

        $totalEarned = Commission::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');

        $totalPending = Commission::where('user_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        return api_success('commission.fetch_success', [
            'referral_code' => $user->referral_code,
            'total_earned' => $totalEarned,
            'total_pending' => $totalPending,
            'total_referrals' => Referral::where('referrer_id', $user->id)->count(),
            'minimum_withdraw' => $this->referralBenefits['minimum_withdraw'],
            'commissions' => $commissions
        ]);
    }

    /**
     * Withdraw commission
     */
    public function withdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'bank_account_id' => 'required|integer'
        ]);

        $user = auth()->user();

        // Check minimum withdraw amount
        if ($request->amount < $this->referralBenefits['minimum_withdraw']) {
            return api_error('commission.minimum_withdraw', [
                'minimum_amount' => $this->referralBenefits['minimum_withdraw'],
                'requested_amount' => $request->amount,
                'shortfall' => $this->referralBenefits['minimum_withdraw'] - $request->amount
            ], 400);
        }

        $availableBalance = Commission::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');

        // Check available balance
        if ($request->amount > $availableBalance) {
            return api_error('commission.insufficient_balance', [
                'requested_amount' => $request->amount,
                'available_balance' => $availableBalance,
                'shortfall' => $request->amount - $availableBalance
            ], 400);
        }

        // TODO: Create withdrawal record in database
        // For now, return success
        return api_success('commission.withdraw_success', [
            'withdraw_amount' => $request->amount,
            'remaining_balance' => $availableBalance - $request->amount,
            'status' => 'pending',
            'created_at' => now()->toIso8601String()
        ], 201);
    }
}
