<?php

namespace App\Http\Requests\Centre;

use App\Http\Requests\Request;

class UpdateCentreRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
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
