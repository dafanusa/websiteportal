<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\SiteStat;
use App\Models\Testimonial;
use App\Models\Umkm;
use App\Models\WhyItem;
use App\Models\WhySection;
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

        $umkms = Umkm::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $events = Event::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $galleries = Gallery::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::query()
            ->with('user')
            ->latest()
            ->take(8)
            ->get();

        $stats = SiteStat::query()
            ->orderBy('sort_order')
            ->get();

        if ($stats->isEmpty()) {
            $stats = collect([
                ['key' => 'kuliner-khas', 'label' => 'Kuliner Khas', 'value' => 25, 'sort_order' => 1],
                ['key' => 'umkm-kuliner', 'label' => 'UMKM Kuliner', 'value' => 18, 'sort_order' => 2],
                ['key' => 'tokoh-kuliner', 'label' => 'Tokoh Kuliner', 'value' => 10, 'sort_order' => 3],
                ['key' => 'pengunjung-website', 'label' => 'Pengunjung Website', 'value' => 1200, 'sort_order' => 4],
            ]);
        }

        $whySection = WhySection::query()
            ->where('is_active', true)
            ->latest()
            ->first();

        if (! $whySection) {
            $whySection = [
                'title' => 'Why Cita Rasa Samawa?',
                'description' => 'Cita Rasa Samawa hadir sebagai platform digital yang mengangkat kekayaan kuliner khas Sumbawa secara autentik dan informatif. Website ini dirancang untuk menjadi jembatan antara budaya lokal, pelaku kuliner, dan masyarakat luas dalam mengenal serta melestarikan cita rasa asli Samawa.',
                'button_label' => 'Pelajari Lebih Lanjut',
                'button_link' => '#about',
            ];
        }

        $whyItems = WhyItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        if ($whyItems->isEmpty()) {
            $whyItems = collect([
                [
                    'title' => 'Informasi Terpusat',
                    'description' => 'Menyajikan informasi kuliner khas Sumbawa dalam satu platform yang rapi, mudah diakses, dan terpercaya.',
                    'icon_class' => 'bi bi-clipboard-data',
                ],
                [
                    'title' => 'Autentik & Berbudaya',
                    'description' => 'Mengangkat kuliner asli yang lahir dari tradisi dan kearifan lokal masyarakat Samawa.',
                    'icon_class' => 'bi bi-gem',
                ],
                [
                    'title' => 'Dukungan UMKM Lokal',
                    'description' => 'Mendukung promosi pelaku usaha kuliner dan UMKM daerah agar lebih dikenal di era digital.',
                    'icon_class' => 'bi bi-inboxes',
                ],
            ]);
        }

        return response()->view('welcome', [
            'menuCategories' => $categories,
            'authUser' => $authUser,
            'umkms' => $umkms,
            'events' => $events,
            'galleries' => $galleries,
            'testimonials' => $testimonials,
            'stats' => $stats,
            'whySection' => $whySection,
            'whyItems' => $whyItems,
        ]);
    }
}
