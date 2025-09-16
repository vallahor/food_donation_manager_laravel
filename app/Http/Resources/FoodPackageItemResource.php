<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodPackageItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'measurement' => $this->measurement?->value,
            'package_quantity' => $this->pivot->package_quantity ?? 1,
            'quantity_label' => $this->quantity . ' ' . $this->measurement->toString(),
        ];
    }
}
