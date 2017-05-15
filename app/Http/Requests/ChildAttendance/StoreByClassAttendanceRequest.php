<?php

namespace App\Http\Requests\ChildAttendance;

use App\Http\Requests\Request;

class StoreByClassAttendanceRequest extends Request
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'centre_id' => 'required',
            'centre_class_id' => 'required',
            'created_at' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'centre_id.required' => 'Centre field is required.',
            'centre_class_id.required' => 'Class field is required.',
            'created_at.required' => 'Date field is required.'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
