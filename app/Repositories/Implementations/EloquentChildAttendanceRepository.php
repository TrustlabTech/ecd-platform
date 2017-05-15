<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\ChildAttendanceRepositoryInterface;
use App\Models\ChildAttendance;
use App\Models\Child;
use App\Models\Staff;
use Carbon\Carbon;
use DB;

class EloquentChildAttendanceRepository extends AbstractEloquentRepository implements ChildAttendanceRepositoryInterface
{
    protected $model;

    public function __construct(ChildAttendance $model)
    {
        $this->model = $model;
    }

    public function all($relations = [])
    {
        return ChildAttendance::with(['children' => function ($query) {
            $query->with('centreClass');
        }])->get();
    }

    public function byClass($staff_id)
    {
        $classesByAttendance = [];
        $staff = Staff::findOrfail($staff_id);

        foreach ($staff->centre->classes as $centreClass) {
            $child = Child::where('centre_class_id', $centreClass->id)->get()->first();
            //$child = $centreClass->children->first();
            if ($child != null) {
                $attendanceRecord = ChildAttendance::where('children_id', '=', $child->id)
                    ->whereDate('created_at', '=', Carbon::today()
                    ->toDateString())
                    ->get()
                    ->first();

                if ($attendanceRecord != null) {
                    $centreClass->attended = true;
                    $classesByAttendance[] = $centreClass;
                } else {
                    $centreClass->attended = false;
                    $classesByAttendance[] = $centreClass;
                }
            }
        }

        return $classesByAttendance;
    }

    public function byBatch($data)
    {
        try {
            if (isset($data['children'])) {
                foreach ($data['children'] as $children) {
                    if (! isset($children['attended'])) {
                        return ['error' => 'attended key not found'];
                    }
                    if (! isset($children['children_id'])) {
                        return ['error' => 'children_id key not found'];
                    }
                    if (! isset($children['latitude'])) {
                        return ['error' => 'latitude key not found'];
                    }
                    if (! isset($children['longitude'])) {
                        return ['error' => 'longitude key not found'];
                    }

                    $attendance = [
                        'attended' => $children['attended'],
                        'children_id' => $children['children_id'],
                        'latitude' => $children['latitude'],
                        'longitude' => $children['longitude']
                    ];

                    // Safeguard against duplicate Attendance Records
                    $attendanceRecordCheck = ChildAttendance::where('children_id', '=', $children['children_id'])
                        ->whereDate('created_at', '=', Carbon::today()
                        ->toDateString())
                        ->get()
                        ->first();
                    if ($attendanceRecordCheck === null) {
                        ChildAttendance::create($attendance);
                    }
                }
            } else {
                return ['error' => 'children key not found'];
            }
        } catch (ErrorException $ex) {
            return ['error' => 'attendance structure invalid'];
        }

        return true;
    }

    public function attendanceToday()
    {
        $attended = ChildAttendance::where('attended', true)
            ->whereDate('created_at', '=', Carbon::today()
            ->toDateString())
            ->get()
            ->count();

        $all = ChildAttendance::whereDate('created_at', '=', Carbon::today()->toDateString())
            ->get()
            ->count();

        if ($attended === 0 || $all === 0) {
            return 0;
        }

        return ((float)$attended / (float)$all) * 100;
    }

    public function attendanceThisWeek()
    {
        $date = Carbon::now();
        $startOfWeek = $date->startOfWeek();

        $attended = ChildAttendance::where('attended', true)
            ->whereDate('created_at', '>=', $startOfWeek
            ->toDateString())
            ->get()
            ->count();

        $all = ChildAttendance::whereDate('created_at', '>=', $startOfWeek->toDateString())
            ->get()
            ->count();

        if ($attended === 0 || $all === 0) {
            return 0;
        }

        return ((float)$attended / (float)$all) * 100;
    }

    public function externalAll()
    {
        return ChildAttendance::all();
    }

    public function history($centreId, $year, $month)
    {
        $dateNow = Carbon::now();
        if ($year === 0) {
            $year = $dateNow->year;
        }

        if ($month === 0) {
            $month = $dateNow->month;
        }

        return DB::table('child_attendances')
                ->join('children', 'child_attendances.children_id', '=', 'children.id')
                ->join('centre_classes', 'children.centre_class_id', '=', 'centre_classes.id')
                ->where('centre_classes.centre_id', '=', $centreId)
                ->whereYear('child_attendances.created_at', '=', $year)
                ->whereMonth('child_attendances.created_at', '=', $month)
                ->orderBy('centre_classes.name', 'ASC')
                ->orderBy('child_attendances.created_at', 'DESC')
                ->select('child_attendances.created_at AS attendance_date',
                            'centre_classes.name AS class_name',
                            'children.given_name AS given_name',
                            'children.family_name AS family_name',
                            'child_attendances.attended AS attended')
                ->get();
    }

    public function getAttendanceForMaps()
    {
        return DB::table('child_attendances')
            ->join('children', 'child_attendances.children_id', '=', 'children.id')
            ->join('centre_classes', 'children.centre_class_id', '=', 'centre_classes.id')
            ->join('centres', 'centre_classes.centre_id', '=', 'centres.id')
            ->whereDate('child_attendances.created_at', '=', Carbon::today())
            ->groupBy('centre_classes.name')
            ->select('centres.name AS centre_name', 'centre_classes.name AS class_name', 'child_attendances.latitude', 'child_attendances.longitude')
            ->get();
    }
}
