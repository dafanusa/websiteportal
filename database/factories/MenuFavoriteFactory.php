<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuFavorite>
 */
class MenuFavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $menuItem = MenuItem::query()->inRandomOrder()->first();

        if (! $menuItem) {
            $categoryName = $this->faker->unique()->words(2, true);
            $category = MenuCategory::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'heading' => null,
                'sort_order' => 0,
                'is_active' => true,
            ]);

            $menuItem = MenuItem::create([
                'menu_category_id' => $category->id,
                'name' => $this->faker->words(2, true),
                'description' => $this->faker->sentence(),
                'price' => $this->faker->numberBetween(10000, 50000),
                'image_path' => null,
                'sort_order' => 0,
                'is_active' => true,
            ]);
        }

        return [
            'menu_item_id' => $menuItem->id,
        ];
    }
}
