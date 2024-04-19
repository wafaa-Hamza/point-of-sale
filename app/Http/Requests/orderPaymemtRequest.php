<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderPaymemtRequest extends FormRequest
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
                'pos_id' => 'required|integer',
                'order_date' => 'datetime',
                'order_master_id' => 'required|integer',
                'payment_type_id' => 'required|integer',
                'amount' => 'decimal',
                'is_cash' => 'boolean',
                'room_no' => 'nullable|string',
                'guest_id' => 'nullable|integer',
            ];
        } else {
            return [
                'pos_id' => 'required|integer',
                'order_date' => 'datetime',
                'order_master_id' => 'required|integer',
                'payment_type_id' => 'required|integer',
                'amount' => 'decimal',
                'is_cash' => 'boolean',
                'room_no' => 'nullable|string',
                'guest_id' => 'nullable|integer',
            ];
        }
    }
}
