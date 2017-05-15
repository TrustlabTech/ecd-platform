<?php

namespace App\Traits;

use App\Models\Attachment;

trait Attachable
{
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
