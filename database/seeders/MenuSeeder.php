<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $camilan = MenuCategory::create([
            'name' => 'Camilan',
            'slug' => 'camilan',
            'heading' => 'Cemilan Tradisional',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $camilan->items()->createMany([
            [
                'name' => 'Singang Bakar',
                'description' => 'Ikan bakar khas dengan bumbu asam pedas Samawa',
                'price' => 18000,
                'image_path' => 'assets/img/menu/menu-item-1.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Manjareal',
                'description' => 'Kue tradisional berbahan beras & gula aren',
                'price' => 8000,
                'image_path' => 'assets/img/menu/menu-item-2.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Kerupuk Kulit Sapi',
                'description' => 'Gurih & renyah khas daerah Sumbawa',
                'price' => 12000,
                'image_path' => 'assets/img/menu/menu-item-3.png',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        $sarapan = MenuCategory::create([
            'name' => 'Sarapan',
            'slug' => 'sarapan',
            'heading' => 'Sarapan',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $sarapan->items()->createMany([
            [
                'name' => 'Sepat Segar',
                'description' => 'Sup ikan khas Sumbawa dengan rasa asam segar',
                'price' => 15000,
                'image_path' => 'assets/img/menu/menu-item-4.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Nasi Dea',
                'description' => 'Nasi gurih dengan lauk tradisional',
                'price' => 20000,
                'image_path' => 'assets/img/menu/menu-item-5.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ]);

        $utama = MenuCategory::create([
            'name' => 'Hidangan Utama',
            'slug' => 'hidangan-utama',
            'heading' => 'Hidangan Utama',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $utama->items()->createMany([
            [
                'name' => 'Singang Balado',
                'description' => 'Olahan ikan segar dengan sambal khas',
                'price' => 25000,
                'image_path' => 'assets/img/menu/menu-item-6.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ayam Taliwang',
                'description' => 'Ayam bakar bumbu pedas gurih',
                'price' => 28000,
                'image_path' => 'assets/img/menu/menu-item-1.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ]);

        $spesial = MenuCategory::create([
            'name' => 'Menu Spesial',
            'slug' => 'menu-spesial',
            'heading' => 'Menu Spesial',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        $spesial->items()->createMany([
            [
                'name' => 'Sate Rembiga',
                'description' => 'Sate sapi pedas khas Nusantara',
                'price' => 30000,
                'image_path' => 'assets/img/menu/menu-item-2.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Janda Bere',
                'description' => 'Kudapan gurih dari singkong',
                'price' => 10000,
                'image_path' => 'assets/img/menu/menu-item-6.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ]);
    }
}
