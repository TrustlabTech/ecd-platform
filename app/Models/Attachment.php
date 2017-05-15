<?php

namespace App\Models;

use App\Models\BaseModel;

class Attachment extends BaseModel
{
    protected $fillable = ['latitude', 'longitude', 'attachment_type_id'];

    public function attachable()
    {
        return $this->morphTo();
    }
}
