<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\ClassMethods;
use App\Models\Admin;
use Carbon\Carbon;

class User extends Authenticatable
{
    use ClassMethods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function principal()
    {
        return $this->hasOne(Principal::class);
    }

    public function practitioner()
    {
        return $this->hasOne(Practitioner::class);
    }

    public function isAdmin()
    {
        $role = Role::where('name', 'admin')->first();
        return $this->role->contains($role->id);
    }

    public function isPrincipal()
    {
        $role = Role::where('name', 'principal')->first();
        return $this->role->contains($role->id);
    }

    public function isPractitioner()
    {
        $role = Role::where('name', 'practitioner')->first();
        return $this->role->contains($role->id);
    }

    public function isStaff()
    {
        $role = Role::where('name', 'staff')->first();
        return $this->role->contains($role->id);
    }

    public function isExternalUser()
    {
        $role = Role::where('name', 'external_user')->first();
        return $this->role->contains($role->id);
    }

    public function isExternalApiUser()
    {
        $role = Role::where('name', 'external_api')->first();
        return $this->role->contains($role->id);
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
