<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // List tiket milik pelanggan
    public function index()
    {
        $user = auth()->user();
        $tickets = Ticket::where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => 'success', 'data' => $tickets]);
    }

    // Proses buat tiket baru (Sesuai Flowchart: "buat tiket")
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string'
        ]);

        $user = auth()->user();

        $ticket = Ticket::create([
            'customer_id' => $user->id,
            'subject' => $request->subject,
            'description' => $request->description,
            'category' => $request->category,
            'priority' => 'medium', // Default priority
            'status' => 'open'     // Status awal sesuai flowchart
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tiket berhasil dibuat. Admin akan segera meninjau.',
            'data' => $ticket
        ], 201);
    }
}
