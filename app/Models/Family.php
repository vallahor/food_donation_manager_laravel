<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;

    public function foodPackages(): BelongsToMany
    {
        return $this->belongsToMany(FoodPackage::class)
            ->using(FamilyFoodPackage::class)
            ->withPivot(['delivery_date', 'delivered'])
            ->withTimestamps();
    }
}
