<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function paket()
    {
        return view('paket.paket');
    }

    public function profil()
    {
        return view('profil.profil');
    }

    public function tagihan()
    {
        return view('tagihan.tagihan');
    }

    public function tiket()
    {
        return view('tiket.tiket');
    }

    public function buatTiket()
    {
        return view('tiket.buat');
    }

    public function editTiket($id)
    {
        return view('tiket.edit', compact('id'));
    }

    public function simpanTiket()
    {
        return redirect()->route('tiket')->with('success', 'Tiket berhasil dibuat!');
    }

    public function updateTiket($id)
    {
        return redirect()->route('tiket')->with('success', 'Tiket berhasil diupdate!');
    }

    public function referral()
    {
        return view('referral.referral');
    }

    public function komisi()
    {
        return view('komisi.komisi');
    }

    public function pengaturan()
    {
        return view('pengaturan.pengaturan');
    }

    public function trackingDetail()
    {
        return view('tracking.detail');
    }
}