<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        // Otomatis mengambil data pelanggan berdasarkan Token JWT yang dikirim
        $user = auth()->user();

        return response()->json([
            'status' => 'success',
            'message' => 'Data tagihan untuk ' . $user->name,
            'data' => [
                ['id' => 101, 'amount' => 150000, 'status' => 'unpaid'],
                ['id' => 102, 'amount' => 200000, 'status' => 'paid'],
            ]
        ]);
    }
}
