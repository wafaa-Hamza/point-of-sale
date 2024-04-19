<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'name_loc' => $this->name_loc,
            'price' => $this->price,
            'pos' => $this->pos,
            'item' => $this->item,
        ];

    
        return $data;
    }
}