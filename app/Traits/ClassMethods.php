<?php

namespace App\Traits;

use App\Models\Attachment;

trait ClassMethods
{
    public function class_name()
    {
        return get_class();
    }
}
