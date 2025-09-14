<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isExisting = $this->resource && $this->resource->exists;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'measurement' => $this->measurement?->value,
            'quantity_label' => $isExisting ? $this->quantity . ' ' . $this->measurement->toString() : '',
        ];
    }
}
