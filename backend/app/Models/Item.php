<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title',
        'description',
        'creator',
        'status',
        'item_type_id',
    ];

    public function type()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id');
    }
}
