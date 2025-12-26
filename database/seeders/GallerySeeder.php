<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'assets/img/gallery/gallery-1.jpg',
            'assets/img/gallery/gallery-2.jpg',
            'assets/img/gallery/gallery-3.jpg',
            'assets/img/gallery/gallery-4.jpg',
            'assets/img/gallery/gallery-5.jpg',
            'assets/img/gallery/gallery-6.jpg',
            'assets/img/gallery/gallery-7.jpg',
            'assets/img/gallery/gallery-8.jpg',
        ];

        foreach ($images as $index => $image) {
            Gallery::updateOrCreate(
                ['image_path' => $image],
                [
                    'title' => null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
