<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Traits\Attachable;
use App\Traits\CountryCodes;
use App\Models\CentreClass;
use App\Models\ChildAttendance;

class Child extends BaseModel
{
    protected $guarded = ['id'];

    use Attachable;
    use CountryCodes;

    public function centreClass()
    {
        return $this->belongsTo(CentreClass::class);
    }

    public function attendance()
    {
        return $this->hasMany(ChildAttendance::class);
    }
}
