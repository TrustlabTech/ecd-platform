<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Interfaces\ECDQualificationRepositoryInterface;

class ECDQualificationController extends Controller
{
    public function __construct(ECDQualificationRepositoryInterface $ECDQualificationRepository)
    {
        $this->qualification = $ECDQualificationRepository;
    }

    public function indexByPublic()
    {
        return response()->json($this->qualification->allFiltered());
    }
}
