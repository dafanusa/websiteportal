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

    Route::post('/dashboard/umkms', [AdminMenuController::class, 'storeUmkm'])->name('dashboard.umkms.store');
    Route::put('/dashboard/umkms/{umkm}', [AdminMenuController::class, 'updateUmkm'])->name('dashboard.umkms.update');
    Route::delete('/dashboard/umkms/{umkm}', [AdminMenuController::class, 'destroyUmkm'])->name('dashboard.umkms.destroy');

    Route::post('/dashboard/events', [AdminMenuController::class, 'storeEvent'])->name('dashboard.events.store');
    Route::put('/dashboard/events/{event}', [AdminMenuController::class, 'updateEvent'])->name('dashboard.events.update');
    Route::delete('/dashboard/events/{event}', [AdminMenuController::class, 'destroyEvent'])->name('dashboard.events.destroy');

    Route::post('/dashboard/galleries', [AdminMenuController::class, 'storeGallery'])->name('dashboard.galleries.store');
    Route::put('/dashboard/galleries/{gallery}', [AdminMenuController::class, 'updateGallery'])->name('dashboard.galleries.update');
    Route::delete('/dashboard/galleries/{gallery}', [AdminMenuController::class, 'destroyGallery'])->name('dashboard.galleries.destroy');
});
