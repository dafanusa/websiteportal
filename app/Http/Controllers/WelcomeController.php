<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class WelcomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $token = $request->cookie('token') ?? $request->bearerToken();
        $authUser = null;

        if ($token) {
            try {
                $authUser = JWTAuth::setToken($token)->authenticate();
            } catch (TokenExpiredException|TokenInvalidException|JWTException) {
                $authUser = null;
            }
        }

        $categories = MenuCategory::query()
            ->where('is_active', true)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        return response()->view('welcome', [
            'menuCategories' => $categories,
            'authUser' => $authUser,
        ]);
    }
}
