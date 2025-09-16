<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FoodPackage extends Model
{
    /** @use HasFactory<\Database\Factories\FoodPackageFactory> */
    use HasFactory;

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->using(FoodPackageItem::class)->withPivot(['package_quantity']);
    }
}
