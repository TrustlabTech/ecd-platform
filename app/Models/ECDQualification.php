<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Staff;

class ECDQualification extends BaseModel
{
    protected $table = 'ecd_qualifications';

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
