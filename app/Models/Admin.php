<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\User;

class Admin extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
