<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ChildRepositoryInterface;
use App\Repositories\Interfaces\ChildAttendanceRepositoryInterface;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Auth;

class HomeController extends Controller
{
    protected $child;
    protected $childAttendance;
    protected $centre;
    protected $staff;

    public function __construct(ChildRepositoryInterface $childRepository,
                                ChildAttendanceRepositoryInterface $childAttendance,
                                CentreRepositoryInterface $centre,
                                StaffRepositoryInterface $staff)
    {
        $this->child = $childRepository;
        $this->childAttendance = $childAttendance;
        $this->centre = $centre;
        $this->staff = $staff;
    }

    public function index()
    {
        $children = $this->child->all()->count();
        $attendanceToday = $this->childAttendance->attendanceToday();
        $attendanceThisWeek = $this->childAttendance->attendanceThisWeek();
        $centres = $this->centre->all()->count();
        $staff = $this->staff->all()->count();

        return view('home')->with(
            compact(
                'children',
                'attendanceToday',
                'attendanceThisWeek',
                'centres',
                'staff'
            )
        );
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function getCentresAttendanceMarkers()
    {
        if (! Auth::check()) {
            return response()->json("false");
        }

        $centres = $this->centre->getCentresForMaps();
        $attendance = $this->childAttendance->getAttendanceForMaps();

        return response()->json(['centres' => $centres, 'attendance' => $attendance]);
    }
}
