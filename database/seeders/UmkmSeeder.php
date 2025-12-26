<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Umkm::updateOrCreate(
            ['name' => 'Bapak Alex'],
            [
                'specialty' => 'Singang & Masakan Tradisional',
                'description' => 'Pelaku kuliner tradisional yang telah menjaga resep Singang khas Sumbawa secara turun-temurun.',
                'image_path' => 'assets/img/chefs/chefs-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        Umkm::updateOrCreate(
            ['name' => 'Bapak Muhammad'],
            [
                'specialty' => 'Sepat & Olahan Ikan',
                'description' => 'UMKM kuliner yang mengembangkan olahan ikan khas Sumbawa dengan cita rasa autentik.',
                'image_path' => 'assets/img/chefs/chefs-3.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        Umkm::updateOrCreate(
            ['name' => 'Neng Arum'],
            [
                'specialty' => 'Jajanan & Kuliner Modern Lokal',
                'description' => 'Pelaku UMKM muda yang memadukan kuliner khas Sumbawa dengan sentuhan modern.',
                'image_path' => 'assets/img/chefs/chefs-2.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );
    }
}
