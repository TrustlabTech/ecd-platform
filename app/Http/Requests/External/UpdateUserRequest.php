<?php

namespace App\Http\Requests\External;

use App\Http\Requests\Request;
use App\Models\User;

class UpdateUserRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $user = User::find($this->user);

        return [
            'email' => 'required|email|unique:users,email,'.$user->id
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
