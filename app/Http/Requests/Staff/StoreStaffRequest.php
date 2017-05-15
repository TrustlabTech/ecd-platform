<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\Request;

class StoreStaffRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            // 'za_id_number' => 'required|unique:staff',
            'family_name' => 'required',
            'given_name' => 'required',
            'phone_number' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'centre_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Pin field is required.',
            'password.confirmed' => 'The pin confirmation does not match.',
            'centre_id.required' => 'The centre field is required',
            //'za_id_number.unique' => 'The ID number has already been taken.',
            //'za_id_number.required' => 'The ID number field is required.'
            //'password.confirmed' => 'Pin field is required',
            //'username.required' => 'Phone number field is required.'
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
