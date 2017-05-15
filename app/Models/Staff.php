<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\BaseModel;
use App\Traits\Attachable;
use App\Traits\ClassMethods;
use App\Traits\CountryCodes;
use App\Models\ECDQualification;
use App\Models\User;
use Carbon\Carbon;

class Staff extends Authenticatable
{
    protected $guarded = ['id'];

    use Attachable;
    use ClassMethods;
    use CountryCodes;

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function ecdQualification()
    {
        return $this->hasOne(ECDQualification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
