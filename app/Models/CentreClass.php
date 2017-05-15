<?php

namespace App\Models;

use App\Models\BaseModel;

use App\Models\Centre;
use App\Models\Child;

class CentreClass extends BaseModel
{
    protected $guarded = ['id'];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }
}
