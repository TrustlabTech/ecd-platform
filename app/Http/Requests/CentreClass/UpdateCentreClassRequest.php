<?php

namespace App\Http\Requests\CentreClass;

use App\Http\Requests\Request;
use App\Models\CentreClass;

class UpdateCentreClassRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $centreClass = CentreClass::find($this->centreClass);

        return [
            'name' => 'required',
            'centre_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'centre_id.required' => 'The centre field is required',
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
