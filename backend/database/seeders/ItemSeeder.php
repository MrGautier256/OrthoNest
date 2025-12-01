<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::truncate();

        $bilan = ItemType::where('slug', 'bilan')->first();
        $outil = ItemType::where('slug', 'outil')->first();
        $jeu   = ItemType::where('slug', 'jeu')->first();

        Item::create([
            'title' => 'Bilan langage écrit adulte',
            'item_type_id' => $bilan->id,
            'description' => 'Bilan complet du langage écrit pour adultes.',
            'creator' => 'Maison d édition X',
            'status' => 'officiel',
        ]);

        Item::create([
            'title' => 'Jeu de cartes phonologie DIY',
            'item_type_id' => $outil->id,
            'description' => 'Jeu DIY pour travailler la phonologie chez les enfants.',
            'creator' => 'Promo Ortho 2025',
            'status' => 'diy',
        ]);

        Item::create([
            'title' => 'Jeu attention et fonctions exécutives',
            'item_type_id' => $jeu->id,
            'description' => 'Jeu de plateau pour travailler l attention et les fonctions exécutives.',
            'creator' => 'Éditeur Y',
            'status' => 'officiel',
        ]);
    }
}
