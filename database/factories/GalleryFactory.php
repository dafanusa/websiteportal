<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'image_path' => fake()->randomElement([
                'assets/img/gallery/gallery-1.jpg',
                'assets/img/gallery/gallery-2.jpg',
                'assets/img/gallery/gallery-3.jpg',
                'assets/img/gallery/gallery-4.jpg',
                'assets/img/gallery/gallery-5.jpg',
                'assets/img/gallery/gallery-6.jpg',
                'assets/img/gallery/gallery-7.jpg',
                'assets/img/gallery/gallery-8.jpg',
            ]),
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
