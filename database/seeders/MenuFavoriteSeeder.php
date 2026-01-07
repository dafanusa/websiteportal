<?php

namespace Database\Seeders;

use App\Models\MenuFavorite;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuFavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = MenuItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        foreach ($items as $item) {
            MenuFavorite::firstOrCreate([
                'menu_item_id' => $item->id,
            ]);
        }
    }
}
