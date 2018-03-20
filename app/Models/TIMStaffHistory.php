<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TIMStaffHistory extends Model
{
    protected $table = 'tim_staff_history';

    protected $fillable = ['staff_id', 'id_number', 'raw_response', 'action'];
}
