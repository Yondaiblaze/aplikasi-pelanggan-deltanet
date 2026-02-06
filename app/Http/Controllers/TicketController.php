<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskTicket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $customer = $request->user();
        
        $tickets = HelpdeskTicket::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return response()->json($tickets);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        
        $customer = $request->user();
        
        $ticket = HelpdeskTicket::create([
            'customer_id' => $customer->id,
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => 'open'
        ]);
        
        return response()->json([
            'message' => 'Tiket berhasil dibuat',
            'ticket' => $ticket
        ], 201);
    }
    
    public function show(Request $request, $id)
    {
        $customer = $request->user();
        
        $ticket = HelpdeskTicket::where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
            
        if (!$ticket) {
            return response()->json(['error' => 'Tiket tidak ditemukan'], 404);
        }
        
        return response()->json($ticket);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);
        
        $customer = $request->user();
        
        $ticket = HelpdeskTicket::where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
            
        if (!$ticket) {
            return response()->json(['error' => 'Tiket tidak ditemukan'], 404);
        }
        
        $ticket->description = $request->description;
        $ticket->save();
        
        return response()->json([
            'message' => 'Tiket berhasil diupdate',
            'ticket' => $ticket
        ]);
    }
}