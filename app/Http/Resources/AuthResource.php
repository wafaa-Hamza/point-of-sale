<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // dd($this);
        return [
            'token'       =>$this->token,
            'firstname'   => $this->firstname,
            'lastname'    => $this->lastname,
            'phonenumber' => $this->phonenumber,
            'email'       => $this->email,
            'role'        => $this->role,
            'language'    => $this->language,
            'apilites'      => $this->apilites->map->only(['name']),
            'pos'    => $this->pos,


    ];



    }
}
