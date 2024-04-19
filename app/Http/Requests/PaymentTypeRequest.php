<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTypeRequest extends FormRequest
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
                'name'              => 'string|min:2|max:49',
                'name_loc'          => 'string|min:2|max:49',
                'type'              => 'string|in:DR,CR',
                'payment_mode_id'   => 'required|integer',
                'gl_account'        => 'nullable',
                'fo_pay_id'         => 'nullable|integer',
                'is_cash'           => 'default:0',
                'active'            => 'default:1',
            ];
        } else {
            return [
                'name'              => 'string|min:2|max:49',
                'name_loc'          => 'string|min:2|max:49',
                'type'              => 'string|in:DR,CR',
                'payment_mode_id'   => 'required|integer',
                'gl_account'        => 'nullable',
                'fo_pay_id'         => 'nullable|integer',
                'is_cash'           => 'default:0',
                'active'            => 'default:1',
            ];
        }
    }
}
