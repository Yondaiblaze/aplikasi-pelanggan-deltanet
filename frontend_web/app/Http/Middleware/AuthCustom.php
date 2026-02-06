<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class AuthCustom
{   
    public function handle($request, Closure $next)
    {
        $token = session('user_token');

        // Jika tidak ada token di session, cek cookie "Ingat Saya"
        if (!$token && $request->cookie('remember_token')) {
            $token = $request->cookie('remember_token');
            $userData = json_decode($request->cookie('remember_user'), true);
            
            // Restore session dari cookie
            session([
                'user_logged_in' => true,
                'user_token' => $token,
                'user_data' => $userData,
                'user_name' => $userData['name'] ?? 'User'
            ]);
        }

        if (!$token) {
            return redirect()->route('login');
        }

        if (session()->has('user_data')) {
            return $next($request);
        }

        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/me');

        if ($response->successful()) {
            session(['user_data' => $response->json()]);
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['error' => 'Sesi berakhir, silakan masuk kembali.']);
    }
}
