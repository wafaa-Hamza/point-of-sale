<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname'   => $this->firstname,
            'lastname'    => $this->lastname,
            'phonenumber' => $this->phonenumber,
            'email'       => $this->email,
            'role'        => $this->role,
            'language'    => $this->language,
        ];
    }
}
