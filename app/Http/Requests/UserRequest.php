<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            $idException = request()->segment(count(request()->segments()));
            return [
                'firstname'=>'nullable|min:2|max:50',
                'lastname'=>'nullable|min:2|max:50',
                'phonenumber'=>'nullable|min:2|max:50',
                'email'=>'nullable|email|unique:users,email,'.$idException,
                'password'=>'nullable|min:8|max:17',
                'role'=>'nullable|min:2|max:50',
                'language'=>'nullable',
            ];
        }else{
            return [
                'firstname'=>'required|min:2|max:50',
                'lastname'=>'required|min:2|max:50',
                'phonenumber'=>'required|min:2|max:50',
                'email'=>'required|email|unique:users|email',
                'password'=>'required|min:8|max:17',
                'role'=>'nullable|min:2|max:50',
                'language'=>'required',
            ];
        }
       
    }
}
