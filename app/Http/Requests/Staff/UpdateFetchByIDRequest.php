<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\Request;

class UpdateFetchByIDRequest extends Request
{

    //protected $redirectRoute = ['staff.edit', ];
    ////https://www.neontsunami.com/posts/redirects-with-laravel-formrequests

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'za_id_number' => 'required|id_valid'
        ];
    }

    public function messages()
    {
        return [
            'za_id_number.required' => 'The ID number is required.',
            'za_id_number.id_valid' => 'The ID number used is not valid.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
