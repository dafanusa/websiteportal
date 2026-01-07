<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class InfoPageController extends Controller
{
    public function history(Request $request): Response
    {
        return response()->view('info.history', [
            'authUser' => $this->resolveAuthUser($request),
        ]);
    }

    public function specialties(Request $request): Response
    {
        $favoriteCategories = MenuCategory::query()
            ->where('is_active', true)
            ->whereHas('items.favorite')
            ->with(['items' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->whereHas('favorite')
                    ->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        return response()->view('info.specialties', [
            'authUser' => $this->resolveAuthUser($request),
            'favoriteCategories' => $favoriteCategories,
        ]);
    }

    private function resolveAuthUser(Request $request): ?User
    {
        $token = $request->cookie('token') ?? $request->bearerToken();

        if (! $token) {
            return null;
        }

        try {
            return JWTAuth::setToken($token)->authenticate();
        } catch (TokenExpiredException|TokenInvalidException|JWTException) {
            return null;
        }
    }
}
