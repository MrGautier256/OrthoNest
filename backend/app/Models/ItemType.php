<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'display_label',
        'icon',
        'color',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

