<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::updateOrCreate(
            ['title' => 'Festival Bale Berdaya'],
            [
                'price_label' => 'Rp250.000',
                'description' => 'Festival UMKM dan kebudayaan lokal Sumbawa dengan pameran produk, lomba tradisional, dan hiburan rakyat.',
                'image_path' => 'assets/img/events-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Moyo Festival'],
            [
                'price_label' => 'Rp350.000',
                'description' => 'Festival budaya dan parade seni di Pulau Moyo menampilkan tari tradisional, drum band, dan expo UMKM.',
                'image_path' => 'assets/img/events-2.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Barapan Kebo'],
            [
                'price_label' => 'Rp75.000',
                'description' => 'Tradisi balap kerbau khas Sumbawa: kompetisi antar tim kerbau yang seru dan penuh semangat budaya.',
                'image_path' => 'assets/img/events-3.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Konser Apung Spirit of The Sea'],
            [
                'price_label' => 'Rp150.000',
                'description' => 'Konser budaya di atas laut Pulau Bungin menampilkan pertunjukan seni dan musik laut yang unik.',
                'image_path' => 'assets/img/events-4.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );
    }
}
