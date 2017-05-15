<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ChildAttendanceRepositoryInterface;

class ChildAttendanceController extends Controller
{
    protected $childAttendance;

    public function __construct(ChildAttendanceRepositoryInterface $childAttendanceRepository)
    {
        $this->childAttendance = $childAttendanceRepository;
        $this->middleware('auth.external');
    }

    /**
    * Retrieve Child Attendance Records
    *
    * Token must be suplied as query string: external/api/v1/attendance?token=your-token-here
    *
    */
    public function index()
    {
        return response()->json($this->childAttendance->externalAll());
    }
}
