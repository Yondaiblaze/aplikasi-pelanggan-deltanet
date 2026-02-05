<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Commission;
use App\Models\Referral;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Ambil data invoice dari database menggunakan customer_id
        $unpaidCount = Invoice::where('customer_id', $user->customer_id)
                              ->where('status', 'unpaid')
                              ->count();

        $totalUnpaidAmount = Invoice::where('customer_id', $user->customer_id)
                                    ->where('status', 'unpaid')
                                    ->sum('amount');
        
        // Ambil total komisi menggunakan customer_id
        $totalCommission = Commission::where('user_id', $user->customer_id)
                                    ->where('status', 'paid')
                                    ->sum('amount') ?? 0;

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'contact' => $user->contact,
                    'referral_code' => $user->referral_code,
                ],
                'billing_summary' => [
                    'unpaid_invoices' => $unpaidCount,
                    'total_bill' => $totalUnpaidAmount,
                ],
                'commission_summary' => [
                    'total_earned' => $totalCommission,
                    'pending_commission' => Commission::where('user_id', $user->customer_id)
                                                     ->where('status', 'pending')
                                                     ->sum('amount') ?? 0,
                    'total_referrals' => Referral::where('referrer_id', $user->customer_id)->count()
                ]
            ]
        ]);
    }

    public function getBillingStatus()
    {
        $user = auth()->user();
        
        $invoices = Invoice::where('customer_id', $user->customer_id)
                           ->select('id', 'amount', 'status', 'due_date', 'created_at')
                           ->orderBy('created_at', 'desc')
                           ->get()
                           ->map(function($invoice) {
                               return [
                                   'id' => $invoice->id,
                                   'amount' => $invoice->amount,
                                   'status' => $invoice->status,
                                   'due_date' => $invoice->due_date,
                                   'is_paid' => $invoice->status === 'paid'
                               ];
                           });

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
                'id' => $user->customer_id,
                'name' => $user->name,
                'contact' => $user->contact,
                'email' => $user->email ?? null,
                'referral_code' => $user->referral_code,
                'created_at' => $user->created_at
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
