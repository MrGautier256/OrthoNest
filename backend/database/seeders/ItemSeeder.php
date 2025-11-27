<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::truncate();

        Item::create([
            'title' => 'Bilan langage écrit adulte',
            'type' => 'bilan',
            'description' => 'Bilan complet du langage écrit pour adultes.',
            'creator' => 'Maison d édition X',
            'status' => 'officiel',
        ]);

        Item::create([
            'title' => 'Jeu de cartes phonologie DIY',
            'type' => 'outil',
            'description' => 'Jeu DIY pour travailler la phonologie chez les enfants.',
            'creator' => 'Promo Ortho 2025',
            'status' => 'diy',
        ]);

        Item::create([
            'title' => 'Jeu attention et fonctions exécutives',
            'type' => 'jeu',
            'description' => 'Jeu de plateau pour travailler l attention et les fonctions exécutives.',
            'creator' => 'Éditeur Y',
            'status' => 'officiel',
        ]);
    }
}
