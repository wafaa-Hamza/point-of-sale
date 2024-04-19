<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemSubCategoryRequest extends FormRequest
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
                'category_id' => 'required',
                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',
                'color' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        } else {
            return [
                'pos_id' => 'required',
                'category_id' => 'required',
                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',
                'color' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        }
    }
}
