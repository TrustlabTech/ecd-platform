<?php

namespace App\Http\Requests\Child;

use App\Http\Requests\Request;

class StoreChildRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'family_name' => 'required',
            'given_name' => 'required',
            'centre_class_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_number.required' => 'The ID number field is required.',
            'id_number.unique' => 'The ID number has already been taken.',
            'centre_class_id.required' => 'The class field is required',
            // 'user.email.required' => 'Email field is required.',
            // 'user.email.unique' => 'Email already taken.',
            // 'user.password.required' => 'Password is required.',
            // 'user.password.confirmed' => 'Password confirmation does not match.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
