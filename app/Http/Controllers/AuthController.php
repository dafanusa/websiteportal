<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showLogin(): Response
    {
        return response()->view('auth.login');
    }

    public function showRegister(): Response
    {
        return response()->view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);
        unset($user);

        return redirect()
            ->route('login')
            ->with('status', 'Registrasi berhasil. Silakan login.');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->withInput($request->only('email'));
        }

        $token = JWTAuth::fromUser($user);

        $route = $user->role === 'admin' ? 'dashboard' : 'welcome';

        return redirect()
            ->route($route)
            ->withCookie($this->tokenCookie($token));
    }

    public function logout(Request $request): RedirectResponse
    {
        $token = $request->cookie('token') ?? $request->bearerToken();

        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (JWTException) {
                // Token already invalid or missing from blacklist storage.
            }
        }

        return redirect()
            ->route('login')
            ->withCookie($this->forgetTokenCookie());
    }

    private function tokenCookie(string $token): Cookie
    {
        $secure = config('app.env') === 'production';
        $ttl = (int) config('jwt.ttl', 60);

        return cookie(
            'token',
            $token,
            $ttl,
            '/',
            null,
            $secure,
            true,
            false,
            'Lax'
        );
    }

    private function forgetTokenCookie(): Cookie
    {
        return cookie()->forget('token');
    }
}
