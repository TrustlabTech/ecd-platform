<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Interfaces\ChildAttendanceRepositoryInterface;

use App\Http\Requests\ChildAttendance\StoreChildAttendanceRequest;
use App\Http\Requests\ChildAttendance\UpdateChildAttendanceRequest;
use App\Traits\TokenUser;

class ChildAttendanceController extends Controller
{
    use TokenUser;

    protected $childAttendance;
    protected $currentUser;

    public function __construct(ChildAttendanceRepositoryInterface $childAttendanceRepository)
    {
        $this->childAttendance = $childAttendanceRepository;
        $this->currentUser = $this->getCurrentUser();
        $this->middleware('token.auth');
    }

    public function byClass($staff_id)
    {
        return response()->json($this->childAttendance->byClass($staff_id));
    }

    public function bulk(Request $request)
    {
        $res = $this->childAttendance->byBatch($request->all());
        if (array_key_exists('error', $res)) {
            return response()->json([$res['error']],400);
        } else {
            return response()->json([$res],200);
        }
        
    }

    public function history($centreId, $year = 0, $month = 0)
    {
        return response()->json($this->childAttendance->history($centreId, $year, $month));
    }
}
