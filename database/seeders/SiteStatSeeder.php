<?php

namespace Database\Seeders;

use App\Models\SiteStat;
use Illuminate\Database\Seeder;

class SiteStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stats = [
            ['key' => 'kuliner-khas', 'label' => 'Kuliner Khas', 'value' => 25, 'sort_order' => 1],
            ['key' => 'umkm-kuliner', 'label' => 'UMKM Kuliner', 'value' => 18, 'sort_order' => 2],
            ['key' => 'tokoh-kuliner', 'label' => 'Tokoh Kuliner', 'value' => 10, 'sort_order' => 3],
            ['key' => 'pengunjung-website', 'label' => 'Pengunjung Website', 'value' => 1200, 'sort_order' => 4],
        ];

        foreach ($stats as $stat) {
            SiteStat::updateOrCreate(
                ['key' => $stat['key']],
                $stat
            );
        }
    }
}
