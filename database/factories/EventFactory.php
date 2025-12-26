<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'price_label' => '$'.fake()->numberBetween(50, 500),
            'description' => fake()->paragraph(),
            'image_path' => null,
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
