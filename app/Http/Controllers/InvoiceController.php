<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        $status = $request->get('status');
        
        $query = Invoice::where('customer_id', $customer->id);
        
        if ($status !== null) {
            $query->where('status', $status);
        }
        
        $invoices = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json($invoices);
    }
    
    public function show(Request $request, $id)
    {
        $customer = $request->user();
        
        $invoice = Invoice::where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
            
        if (!$invoice) {
            return response()->json(['error' => 'Tagihan tidak ditemukan'], 404);
        }
        
        return response()->json($invoice);
    }
    
    public function pay(Request $request, $id)
    {
        $customer = $request->user();
        
        $invoice = Invoice::where('customer_id', $customer->id)
            ->where('id', $id)
            ->where('status', 0) // status 0 = belum bayar
            ->first();
            
        if (!$invoice) {
            return response()->json(['error' => 'Tagihan tidak valid'], 404);
        }
        
        // Update status pembayaran
        $invoice->status = 1; // status 1 = sudah bayar
        $invoice->send_date = now();
        $invoice->save();
        
        return response()->json([
            'message' => 'Pembayaran berhasil',
            'invoice' => $invoice
        ]);
    }
}