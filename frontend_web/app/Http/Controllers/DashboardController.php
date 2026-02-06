<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Helper untuk memanggil API Backend dengan Token JWT
     */
    private function apiRequest($method, $endpoint, $data = [])
    {
        $token = session('user_token'); // Mengambil token hasil login/regis tadi
        return Http::withToken($token)->$method("http://127.0.0.1:8000/api/{$endpoint}", $data);
    }

    public function index()
    {
        // Contoh: Mengambil ringkasan data untuk dashboard (opsional)
        // Jika belum ada API-nya di backend, biarkan view() saja dulu.
        return view('dashboard.dashboard');
    }

    public function profil()
    {
        // Mengambil data profil terbaru dari Backend agar sinkron
        $response = $this->apiRequest('get', 'user/profile');
        $user = $response->successful() ? $response->json() : session('user_data');

        return view('profil.profil', compact('user'));
    }

    public function referral()
    {
        // LOGIKA PENTING: Mengambil daftar bawahan (contoh: Yondai untuk Daiva)
        // Kita asumsikan ada endpoint di backend: api/user/referrals
        $response = $this->apiRequest('get', 'user/referrals');
        $referrals = $response->successful() ? $response->json()['data'] : [];

        // Ambil juga data user untuk menampilkan kode referral milik sendiri
        $user = session('user_data');

        return view('referral.referral', compact('referrals', 'user'));
    }

    /* --- Fungsi Statis Tetap Dipertahankan Sesuai Update Frontend --- */

    public function paket() { return view('paket.paket'); }
    public function tagihan() { return view('tagihan.tagihan'); }
    public function tiket() { return view('tiket.tiket'); }
    public function buatTiket() { return view('tiket.buat'); }
    public function editTiket($id) { return view('tiket.edit', compact('id')); }
    public function komisi() { return view('komisi.komisi'); }
    public function pengaturan() { return view('pengaturan.pengaturan'); }
    public function trackingDetail() { return view('tracking.detail'); }

    public function simpanTiket()
    {
        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil dibuat!');
    }

    public function updateTiket($id)
    {
        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil diupdate!');
    }
}
