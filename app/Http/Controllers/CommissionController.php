<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        $status = $request->get('status');
        
        $query = Commission::where('customer_id', $customer->id);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $commissions = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Hitung saldo tersedia
        $saldoTersedia = Commission::where('customer_id', $customer->id)
            ->where('status', 'available')
            ->sum('amount');
            
        return response()->json([
            'saldo_tersedia' => $saldoTersedia,
            'commissions' => $commissions
        ]);
    }
    
    public function withdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|string|in:bank,ewallet'
        ]);
        
        $customer = $request->user();
        $amount = $request->amount;
        
        // Cek saldo tersedia
        $saldoTersedia = Commission::where('customer_id', $customer->id)
            ->where('status', 'available')
            ->sum('amount');
            
        if ($amount > $saldoTersedia) {
            return response()->json(['error' => 'Saldo tidak mencukupi'], 400);
        }
        
        // Buat record pencairan
        Commission::create([
            'customer_id' => $customer->id,
            'amount' => -$amount,
            'type' => 'withdrawal',
            'status' => 'pending',
            'description' => 'Pencairan saldo via ' . $request->method
        ]);
        
        return response()->json([
            'message' => 'Permintaan pencairan berhasil diajukan',
            'amount' => $amount,
            'method' => $request->method
        ]);
    }
}