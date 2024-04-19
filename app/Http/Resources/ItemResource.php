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
       // return parent::toArray($request);

       return[
        'name' => $this->name,
        'name_loc' => $this->name_loc,
        'item_img' => $this->item_img,
        'cost' => $this->cost,
        'inv_store_code' => $this->inv_store_code,
        'inv_item_code' => $this->inv_item_code,
        'kitchen_printer' => $this->kitchen_printer,
        'category' => $this->category,
        'subCategory' => $this->subCategory,
        'active' => $this->active,
        'pos' => $this->pos,
        'service' => $this->service,
       ];
    }
}