<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class authorizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                "errors" => [
                    "message" => [
                        "Unauthorized : No token provided"
                    ]
                ]
            ], 401);
        }
        // Validasi token menggunakan Sanctum
        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken) {
            return response()->json([
                "errors" => [
                    "message" => [
                        "Unauthorized : Invalid token provided"
                    ]
                ]
            ], 401);
        }
        return $next($request);
    }
}
