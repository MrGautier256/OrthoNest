<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    public function index(): Collection
    {
        $items = Item::with('type')->get();

        return $items->map(function (Item $item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'creator' => $item->creator,
                'status' => $item->status,
                'type' => $item->type ? [
                    'id' => $item->type->id,
                    'slug' => $item->type->slug,
                    'label' => $item->type->display_label,
                    'icon' => $item->type->icon,
                    'color' => $item->type->color,
                ] : null,
            ];
        });
    }
}
