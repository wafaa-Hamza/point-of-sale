<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        if(in_array($this->method(), ['PUT','PATCH']))
        {
            return [
                'name' => 'nullable|min:2|max:49',
                'name_loc' => 'nullable|min:2|max:49',
                'pos_id' => 'nullable|exists:pos,id',
                'item_img' => 'nullable|min:2|max:254',
                'cost' => 'nullable',
                'inv_store_code' => 'nullable|min:2|max:254',
                'inv_item_code' => 'nullable|min:2|max:254',
                'kitchen_printer' => 'nullable|min:2|max:254',
                'category_id' => 'nullable|exists:item_categories,id',
                'sub_category_id' => 'nullable|exists:item_sub_categories,id',
                'active' => 'nullable|bolean',
            ];
        }else{
            return [
                'name' => 'required|min:2|max:49',
                'name_loc' => 'required|min:2|max:49',
                'pos_id' => 'required|exists:pos,id',
                'item_img' => 'nullable|min:2|max:254',
                'cost' => 'required',
                'inv_store_code' => 'nullable|min:2|max:254',
                'inv_item_code' => 'nullable|min:2|max:254',
                'kitchen_printer' => 'required|min:2|max:254',
                'category_id' => 'required|exists:item_categories,id',
                'sub_category_id' => 'nullable|exists:item_sub_categories,id',
                'active' => 'nullable|bolean',
            ];
        }
    
    }
}
