<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoicePayment;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fitur: List Tagihan (Halaman Kelola Tagihan)
     */
    public function index()
    {
        $user = auth()->user();

        // Mengambil semua invoice milik pelanggan
        $invoices = Invoice::where('customer_id', $user->id)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return response()->json([
            'status' => 'success',
            'data' => $invoices
        ]);
    }

    /**
     * Fitur: Detail Tagihan (Melihat Produk & Riwayat Bayar)
     */
    public function show($id)
    {
        $user = auth()->user();

        // Mengambil invoice beserta produk dan pembayarannya sekaligus (Eager Loading)
        $invoice = Invoice::with(['products', 'payments'])
                          ->where('customer_id', $user->id)
                          ->find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Tagihan tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $invoice
        ]);
    }

    /**
     * Fitur: Bayar (Simulasi Pilih Metode Pembayaran)
     */
    public function pay(Request $request, $id)
    {
        $this->validate($request, [
            'payment_method' => 'required|string'
        ]);

        $user = auth()->user();
        $invoice = Invoice::where('customer_id', $user->id)->find($id);

        if (!$invoice || $invoice->status === 'paid') {
            return response()->json(['message' => 'Tagihan tidak tersedia untuk dibayar'], 400);
        }

        // Mulai transaksi database agar data aman
        DB::beginTransaction();
        try {
            // 1. Catat ke tabel invoice_payments
            InvoicePayment::create([
                'invoice_id' => $invoice->id,
                'payment_method' => $request->payment_method,
                'amount_paid' => $invoice->amount,
                'payment_date' => now(),
                'status' => 'pending' // Status awal pending sesuai flowchart
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Metode pembayaran berhasil dipilih. Silakan lakukan pembayaran.',
                'instruction' => 'Silakan transfer ke rekening Deltanet sesuai nominal.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memproses pembayaran'], 500);
        }
    }
    public function uploadProof(Request $request, $id)
{
    $this->validate($request, [
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $invoice = Invoice::find($id);
    if (!$invoice) return response()->json(['message' => 'Invoice tidak ditemukan'], 404);

    // Simulasi penyimpanan file
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = $file->store('proofs', 'public');

            // Simpan ke tabel invoice_attachments
            InvoiceAttachment::create([
            'invoice_id' => $invoice->id,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bukti pembayaran berhasil diunggah, menunggu verifikasi admin.'
        ]);
    }
}
}
