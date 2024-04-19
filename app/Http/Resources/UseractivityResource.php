<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UseractivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'description' => $this->description,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'causer' => $this->causer,
            'properties' => $this->properties,
            'subject_id' => $this->subject_id,
            'log_name' => $this->log_name,
            'event' => $this->event,
        ];
    }
}
