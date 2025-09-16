<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'street_name' => $this->street_name,
            'zipcode' => $this->zipcode,
            'phone_number' => $this->phone_number,
            'visited' => $this->visited,
            'food_packages' => FamilyFoodPackageResource::collection($this->whenLoaded('foodPackages')),
        ];
    }
}
