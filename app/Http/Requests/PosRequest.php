<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
        if((in_array($this->method(), ['PUT', 'PATCH'])))
        {
            return [
                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',
                'logo' => 'nullable|min:2|max:254',
                'phone' => 'nullable|min:2|max:49',
            ];
        }else{
            return [
                'name' => 'required|min:2|max:49',
                'name_loc' => 'required|min:2|max:49',
                'logo' => 'nullable|min:2|max:254',
                'phone' => 'nullable|min:2|max:49',
            ];
        }
}

}
