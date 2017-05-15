<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\Request;
use App\Models\Staff;

class UpdateStaffRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $staff = Staff::find($this->staff);

        return [
            //'za_id_number' => 'required|unique:staff,za_id_number,'.$staff->id,
            'family_name' => 'required',
            'given_name' => 'required',
            'phone_number' => 'required|unique:users,username,'.$staff->user->id,
            'centre_id' => 'required',
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'centre_id.required' => 'The centre field is required',
            'password.confirmed' => 'The pin confirmation does not match.',
            //'za_id_number.unique' => 'The ID number has already been taken.',
            //'za_id_number.required' => 'The ID number field is required.'
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
