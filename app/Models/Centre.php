<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Traits\Attachable;
use App\Models\CentreClass;

class Centre extends BaseModel
{
    protected $guarded = ['id'];

    use Attachable;

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function classes()
    {
        return $this->hasMany(CentreClass::class);
    }
}
