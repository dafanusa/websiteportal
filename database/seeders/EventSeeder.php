<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::updateOrCreate(
            ['title' => 'Custom Parties'],
            [
                'price_label' => '$99',
                'description' => 'Quo corporis voluptas ea ad. Consectetur inventore sapiente ipsum voluptas eos omnis facere. Enim facilis veritatis id est rem repudiandae nulla expedita quas.',
                'image_path' => 'assets/img/events-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Private Parties'],
            [
                'price_label' => '$289',
                'description' => 'In delectus sint qui et enim. Et ab repudiandae inventore quaerat doloribus. Facere nemo vero est ut dolores ea assumenda et. Delectus saepe accusamus aspernatur.',
                'image_path' => 'assets/img/events-2.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Birthday Parties'],
            [
                'price_label' => '$499',
                'description' => 'Laborum aperiam atque omnis minus omnis est qui assumenda quos. Quis id sit quibusdam. Esse quisquam ducimus officia ipsum ut quibusdam maxime. Non enim perspiciatis.',
                'image_path' => 'assets/img/events-3.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Wedding Parties'],
            [
                'price_label' => '$899',
                'description' => 'Laborum aperiam atque omnis minus omnis est qui assumenda quos. Quis id sit quibusdam. Esse quisquam ducimus officia ipsum ut quibusdam maxime. Non enim perspiciatis.',
                'image_path' => 'assets/img/events-4.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );
    }
}
