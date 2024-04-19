<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ((in_array($this->method(), ['PUT', 'PATCH']))) {
            return [
                'pos_id' => 'required',
                'pos_date' => 'datetime',
                'is_inventory' => 'nullable|boolean',
                'is_kitchen_printer' => 'nullable|boolean',
                'pos_room_id' => 'nullable|integer',
                'vat_number' => 'nullable|string',
            ];
        } else {
            return [
                'pos_id' => 'required',
                'pos_date' => 'datetime',
                'is_inventory' => 'nullable|boolean',
                'is_kitchen_printer' => 'nullable|boolean',
                'pos_room_id' => 'nullable|integer',
                'vat_number' => 'nullable|string',
            ];
        }
    }
}
