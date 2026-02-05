<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Helper untuk mengambil data user.
     * Kita prioritaskan data dari SESSION agar tidak terlalu sering menembak API.
     */
    private function getUserData()
    {
        // 1. Ambil token dari session
        $token = session('user_token');
        if (!$token) return null;

        // 2. Coba ambil data user yang sudah disimpan di session (jika ada)
        // Ini mencegah redirect berulang jika API sedang sibuk
        if (session()->has('user_data')) {
            return session('user_data');
        }

        // 3. Jika di session tidak ada, baru tembak API Backend Lumen
        try {
            $response = Http::withToken($token)
                            ->timeout(5) // Beri batas waktu agar tidak loading selamanya
                            ->get('http://127.0.0.1:8000/api/me');

            if ($response->successful()) {
                $userData = $response->json();
                // Simpan ke session agar request berikutnya lebih cepat
                session(['user_data' => $userData]);
                return $userData;
            }
        } catch (\Exception $e) {
            Log::error("Gagal koneksi ke Backend: " . $e->getMessage());
        }

        return null;
    }

    public function index()
    {
        // Debugging: Jika masih error, hapus tanda komentar baris di bawah ini untuk melihat isi session
        // dd(session()->all());

        $user = $this->getUserData();

        if (!$user) {
            // HANYA hapus session jika memang token benar-benar tidak ada
            if (!session()->has('user_token')) {
                return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
            }

            // Jika token ada tapi API gagal, jangan langsung login ulang,
            // cukup tampilkan error tanpa menghapus session (mungkin server backend mati)
            return redirect()->route('login')->withErrors(['error' => 'Gagal mengambil data profil dari server.']);
        }

        return view('dashboard', compact('user'));
    }

    // --- SISA METHOD LAINNYA ---
    // Gunakan logika yang sama: ambil dari getUserData()
    public function profil() {
        $user = $this->getUserData();
        if (!$user) return redirect()->route('login');
        return view('profil.profil', compact('user'));
    }

    // ... (method lainnya tetap sama namun akan lebih stabil karena getUserData sudah diperbaiki)
}
