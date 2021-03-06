<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TIMChildHistory extends Model
{
    protected $table = 'tim_child_history';

    protected $fillable = ['child_id', 'id_number', 'raw_response', 'action'];
}
