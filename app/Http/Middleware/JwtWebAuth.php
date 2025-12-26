<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtWebAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->cookie('token');

        if (! $token) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silakan login terlebih dulu.',
            ]);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (TokenExpiredException) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Sesi login sudah berakhir.',
            ]);
        } catch (TokenInvalidException|JWTException) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Token tidak valid.',
            ]);
        }

        if (! $user) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silakan login terlebih dulu.',
            ]);
        }

        Auth::setUser($user);

        return $next($request);
    }
}
