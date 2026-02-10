<?php

namespace App\Http\Middleware; // Pastikan ini benar

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware // Namanya harus sama dengan nama file
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return response()->json(['message' => 'Token tidak valid'], 401);
        }
        return $next($request);
    }
}
