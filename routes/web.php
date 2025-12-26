<?php

use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

$showWelcome = function (Request $request, WelcomeController $controller) {
    $token = $request->cookie('token') ?? $request->bearerToken();

    if ($token) {
        try {
            $user = JWTAuth::setToken($token)->authenticate();

            if ($user && $user->role === 'admin') {
                return redirect()->route('dashboard');
            }
        } catch (TokenExpiredException|TokenInvalidException|JWTException) {
            // Invalid token should fall back to the public landing page.
        }
    }

    return $controller($request);
};

Route::get('/', $showWelcome)->name('welcome');
Route::get('/welcome', WelcomeController::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['jwt.web', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminMenuController::class, 'dataItems'])->name('dashboard');
    Route::post('/dashboard/categories', [AdminMenuController::class, 'storeCategory'])->name('dashboard.categories.store');
    Route::put('/dashboard/categories/{category}', [AdminMenuController::class, 'updateCategory'])->name('dashboard.categories.update');
    Route::delete('/dashboard/categories/{category}', [AdminMenuController::class, 'destroyCategory'])->name('dashboard.categories.destroy');
    Route::post('/dashboard/items', [AdminMenuController::class, 'storeItem'])->name('dashboard.items.store');
    Route::put('/dashboard/items/{item}', [AdminMenuController::class, 'updateItem'])->name('dashboard.items.update');
    Route::delete('/dashboard/items/{item}', [AdminMenuController::class, 'destroyItem'])->name('dashboard.items.destroy');
});
