<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
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
        if(in_array($this->method(),['PUT','PATCH']))
        {
            return [
                'name' =>'nullable|min:2|max:49',
                    'name_loc' => 'nullable|min:2|max:49',
                    'pos_id' => 'nullable|exists:pos,id',
                    'per' => 'nullable',
                    'amount' => 'nullable',
                    'formula' => 'nullable|min:2|max:254',
                    'extra' => 'nullable|min:2|max:254',
                    'accept_per' =>'nullable|boolean',
            ];
        }else{
            return [
                    'name' =>'required|min:2|max:49',
                    'name_loc' => 'required|min:2|max:49',
                    'pos_id' => 'required|exists:pos,id',
                    'per' => 'nullable',
                    'amount' => 'nullable',
                    'formula' => 'nullable|min:2|max:254',
                    'extra' => 'nullable|min:2|max:254',
                    'accept_per' =>'nullable|boolean',
            ];
        }

    }
}