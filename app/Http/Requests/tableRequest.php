<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tableRequest extends FormRequest
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

                'pos_id' => 'integer',
                'name' => 'string|min:2|max:49',
                'name_loc' => 'string|min:2|max:49',
                'is_used' => 'boolean|default:0',

            ];
        } else {
            return [
                'pos_id' => 'integer',
                'name' => 'string|min:2|max:49',
                'name_loc' => 'string|min:2|max:49',
                'is_used' => 'boolean|default:0',

            ];
        }
    }
}
