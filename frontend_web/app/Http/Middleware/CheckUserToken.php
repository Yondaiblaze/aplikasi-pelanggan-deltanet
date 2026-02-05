<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek apakah di session ada token dari Lumen
        if (!Session::has('user_token')) {
            // Jika tidak ada, tendang balik ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.']);
        }

        // 2. Jika ada token, izinkan lanjut ke halaman yang dituju (Dashboard, dll)
        return $next($request);
    }
}
