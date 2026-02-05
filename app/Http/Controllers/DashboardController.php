<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Commission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        
        // Ringkasan tagihan berdasarkan struktur database yang ada
        $totalTagihan = Invoice::where('customer_id', $customer->id)->count();
        $tagihanBelumBayar = Invoice::where('customer_id', $customer->id)
            ->where('status', 0)->count(); // status 0 = belum bayar
        $tagihanSudahBayar = Invoice::where('customer_id', $customer->id)
            ->where('status', 1)->count(); // status 1 = sudah bayar
        
        // Ringkasan komisi
        $totalKomisi = Commission::where('customer_id', $customer->id)->count();
        
        return response()->json([
            'user' => [
                'name' => $customer->name,
                'contact' => $customer->contact
            ],
            'tagihan' => [
                'total' => $totalTagihan,
                'belum_bayar' => $tagihanBelumBayar,
                'sudah_bayar' => $tagihanSudahBayar
            ],
            'komisi' => [
                'total' => $totalKomisi
            ]
        ]);
    }
}