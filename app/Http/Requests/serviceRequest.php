<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class serviceRequest extends FormRequest
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

                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',

            ];
        } else {
            return [

                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',

            ];
        }
    }
}
