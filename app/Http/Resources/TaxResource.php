<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'name_loc' => $this->name_loc,
            'pos' => $this->pos,
            'per' => $this->per,
            'amount' => $this->amount,
            'formula' => $this->formula,
            'extra' => $this->extra,
            'accept_per' => $this->accept_per
        ];
    }
}