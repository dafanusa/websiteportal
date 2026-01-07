<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteStat>
 */
class SiteStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $label = $this->faker->words(2, true);

        return [
            'key' => Str::slug($label),
            'label' => $label,
            'value' => $this->faker->numberBetween(1, 5000),
            'sort_order' => 0,
        ];
    }
}
