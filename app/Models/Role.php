<?php

namespace App\Models;

use App\Models\BaseModel;

use App\Models\User;

class Role extends BaseModel
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
