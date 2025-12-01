<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'slug' => 'bilan',
                'name' => 'Bilan',
                'display_label' => 'Bilan',
                'icon' => 'mdi-clipboard-text',
                'color' => '#667eea',
            ],
            [
                'slug' => 'outil',
                'name' => 'Outil',
                'display_label' => 'Outil, matériel',
                'icon' => 'mdi-tools',
                'color' => '#f093fb',
            ],
            [
                'slug' => 'jeu',
                'name' => 'Jeu',
                'display_label' => 'Jeu',
                'icon' => 'mdi-puzzle',
                'color' => '#4facfe',
            ],
        ];

        foreach ($types as $type) {
            ItemType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}
