<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model
{
    public function getCreatedAtAttribute($value)
    {
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'], 'UTC');
        $datetime->setTimezone('Africa/Johannesburg');
        return $datetime->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value)
    {
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'], 'UTC');
        $datetime->setTimezone('Africa/Johannesburg');
        return $datetime->toDateTimeString();
    }
}
