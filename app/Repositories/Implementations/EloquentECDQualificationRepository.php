<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\ECDQualificationRepositoryInterface;
use App\Models\ECDQualification;

class EloquentECDQualificationRepository implements ECDQualificationRepositoryInterface
{
    public function allFiltered()
    {
        return ECDQualification::select('id', 'name')->get();
    }
}
