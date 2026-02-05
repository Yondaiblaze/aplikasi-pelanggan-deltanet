<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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

        // Ambil jumlah tagihan yang belum dibayar (unpaid)
        $unpaidCount = Invoice::where('customer_id', $user->id)
                              ->where('status', 'unpaid')
                              ->count();

        // Ambil total nominal tagihan yang belum dibayar
        $totalUnpaidAmount = Invoice::where('customer_id', $user->id)
                                    ->where('status', 'unpaid')
                                    ->sum('amount');

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'contact' => $user->contact,
                ],
                'billing_summary' => [
                    'unpaid_invoices' => $unpaidCount,
                    'total_bill' => $totalUnpaidAmount,
                ]
            ]
        ]);
    }
}
