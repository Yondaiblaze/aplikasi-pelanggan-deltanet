<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan List Teman yang diajak dan total komisi
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil daftar teman (pelanggan yang kolom referred_by-nya adalah ID user ini)
        $friends = Customer::where('referred_by', $user->id)->get();

        // Hitung total komisi (Misal: 1 orang = Rp 50.000)
        $commissionAmount = $friends->count() * 50000;

        return response()->json([
            'status' => 'success',
            'referral_code' => $user->referral_code,
            'total_friends' => $friends->count(),
            'total_commission' => $commissionAmount,
            'friends_list' => $friends
        ]);
    }

    /**
     * Proses Pencairan Komisi (Withdraw)
     */
    public function withdraw(Request $request)
    {
        // Logika untuk request pencairan ke admin
        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan pencairan komisi berhasil dikirim ke admin.'
        ]);
    }
}
