<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyFoodPackageResource extends JsonResource
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
            'delivery_date' => Carbon::parse($this->pivot->delivery_date)->format('d-m-Y'),
            'delivered' => $this->pivot->delivered ? Carbon::parse($this->pivot->delivered)->format('d-m-Y') : null,
        ];
    }
}
