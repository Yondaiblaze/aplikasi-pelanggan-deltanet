<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class AuthCustom
{   
        public function handle($request, Closure $next)
        {
            $token = session('user_token');

            if (!$token) {
                return redirect()->route('login');
            }

            // Jika user sudah ada di session, jangan tembak API lagi (biar cepat)
            if (session()->has('user_data')) {
                return $next($request);
            }

            // Validasi ulang hanya jika session data hilang (misal ganti browser)
            $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/me');

            if ($response->successful()) {
                session(['user_data' => $response->json()]);
                return $next($request);
            }

            return redirect()->route('login')->withErrors(['error' => 'Sesi berakhir, silakan masuk kembali.']);
        }
}
