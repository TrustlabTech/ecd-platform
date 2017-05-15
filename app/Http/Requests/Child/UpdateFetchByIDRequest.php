<?php

namespace App\Http\Requests\Child;

use App\Http\Requests\Request;

class UpdateFetchByIDRequest extends Request
{

    //protected $redirectRoute = ['child.edit', ];
    ////https://www.neontsunami.com/posts/redirects-with-laravel-formrequests

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'id_number' => 'required|id_valid'
        ];
    }

    public function messages()
    {
        return [
            'id_number.required' => 'The ID number is required.',
            'id_number.id_valid' => 'The ID number used is not valid.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
