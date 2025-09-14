<?php

namespace App\Models;

use App\Enums\Measurement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $casts = [
        'measurement' => Measurement::class,
    ];
}
