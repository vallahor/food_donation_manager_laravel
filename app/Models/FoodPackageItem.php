<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodPackageItem extends Pivot
{
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function foodPackages(): HasMany
    {
        return $this->hasMany(FoodPackage::class);
    }
}
