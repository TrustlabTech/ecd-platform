<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Child;

class ChildAttendance extends BaseModel
{
    protected $table = 'child_attendances';

    protected $guarded = ['id'];

    public function children()
    {
        return $this->belongsTo(Child::class);
    }
}
