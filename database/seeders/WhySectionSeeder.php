<?php

namespace Database\Seeders;

use App\Models\WhySection;
use Illuminate\Database\Seeder;

class WhySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhySection::updateOrCreate(
            ['title' => 'Why Cita Rasa Samawa?'],
            [
                'description' => 'Cita Rasa Samawa hadir sebagai platform digital yang mengangkat kekayaan kuliner khas Sumbawa secara autentik dan informatif. Website ini dirancang untuk menjadi jembatan antara budaya lokal, pelaku kuliner, dan masyarakat luas dalam mengenal serta melestarikan cita rasa asli Samawa.',
                'button_label' => 'Pelajari Lebih Lanjut',
                'button_link' => '#about',
                'is_active' => true,
            ]
        );
    }
}
