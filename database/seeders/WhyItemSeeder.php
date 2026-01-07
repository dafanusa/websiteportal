<?php

namespace Database\Seeders;

use App\Models\WhyItem;
use Illuminate\Database\Seeder;

class WhyItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Informasi Terpusat',
                'description' => 'Menyajikan informasi kuliner khas Sumbawa dalam satu platform yang rapi, mudah diakses, dan terpercaya.',
                'icon_class' => 'bi bi-clipboard-data',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Autentik & Berbudaya',
                'description' => 'Mengangkat kuliner asli yang lahir dari tradisi dan kearifan lokal masyarakat Samawa.',
                'icon_class' => 'bi bi-gem',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Dukungan UMKM Lokal',
                'description' => 'Mendukung promosi pelaku usaha kuliner dan UMKM daerah agar lebih dikenal di era digital.',
                'icon_class' => 'bi bi-inboxes',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            WhyItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
