<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ChildRepositoryInterface;
use App\Repositories\Interfaces\CentreClassRepositoryInterface;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Repositories\Interfaces\ChildAttendanceRepositoryInterface;
use App\Http\Requests\ChildAttendance\StoreChildAttendanceRequest;
use App\Http\Requests\ChildAttendance\UpdateChildAttendanceRequest;
use App\Http\Requests\ChildAttendance\StoreByClassAttendanceRequest;

class ChildAttendanceController extends Controller
{
    protected $child;
    protected $childAttendance;

    public function __construct(ChildRepositoryInterface $childRepository,
        ChildAttendanceRepositoryInterface $childAttendanceRepository,
        CentreRepositoryInterface $centreRepository,
        CentreClassRepositoryInterface $centreClassRepository)
    {
        $this->child = $childRepository;
        $this->childAttendance = $childAttendanceRepository;
        $this->centre = $centreRepository;
        $this->centreClass = $centreClassRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('childAttendance.list', ['childAttendances' => $this->childAttendance->paginate(100)]);
    }

    public function create()
    {
        return view('childAttendance.create', ['childAttendance' => $this->childAttendance
                ->createModel(['created_at' => date('Y-m-d')]),
            'children' => $this->child->forList(), 'create' => true]);
    }

    public function store(StoreChildAttendanceRequest $request)
    {
        if ($this->childAttendance->create($request->all())) {
            return redirect()->route('childAttendance.index')->with('info', 'Attendance successfully added');
        } else {
            return redirect()->route('childAttendance.index')->with('info', 'Error adding attendance');
        }
    }

    public function edit($id)
    {
        return view('childAttendance.edit', ['childAttendance' => $this->childAttendance->find($id),
            'children' => $this->child->forList(), 'create' => false]);
    }

    public function update(UpdateChildAttendanceRequest $request, $id)
    {
        if ($this->childAttendance->update($request->all(), $id)) {
            return redirect()->route('childAttendance.index')->with('info', 'Attendance successfully updated');
        } else {
            return redirect()->route('childAttendance.index')->with('info', 'Error updating attendance');
        }
    }

    public function delete($id)
    {
        return view('childAttendance.delete', ['childAttendance' => $this->childAttendance->find($id)]);
    }

    public function destroy($id)
    {
        if ($this->childAttendance->delete($id)) {
            return redirect()->route('childAttendance.index')->with('info', 'Attendance successfully deleted');
        } else {
            return redirect()->route('childAttendance.index')->with('danger', 'Error deleting attendance');
        }
    }

    public function createByClass()
    {
        return view('childAttendance.create_by_class', ['centres' => $this->centre->all()]);
    }

    public function storeByClass(StoreByClassAttendanceRequest $request)
    {
        $centreClassId = $request->centre_class_id;
        $attendedIds= $request->attendance;
        $date = $request->created_at;

        $children = $this->child->byClass($centreClassId, 'asc');

        if (count($attendedIds) >= 1) {
            foreach ($children as $child) {
                if (in_array($child->id, $attendedIds)) {
                    $this->childAttendance->create([
                        'latitude' => '0',
                        'longitude' => '0',
                        'attended' => true,
                        'children_id' => $child->id,
                        'created_at' => $date
                    ]);
                } else {
                    $this->childAttendance->create([
                        'latitude' => '0',
                        'longitude' => '0',
                        'attended' => false,
                        'children_id' => $child->id,
                        'created_at' => $date
                    ]);
                }
            }
        } else {
            foreach ($children as $child) {
                $this->childAttendance->create([
                    'latitude' => '0',
                    'longitude' => '0',
                    'attended' => false,
                    'children_id' => $child->id,
                    'created_at' => $date
                ]);
            }
        }

        return redirect()->route('childAttendance.index')->with('info', 'Attendance successfully added');
    }

    public function retrieveClasses($centreId)
    {
        return response()->json($this->centreClass->byCentre($centreId));
    }

    public function retrieveChildren($classId)
    {
        return view('childAttendance.list_children', ['children' => $this->child->byClass($classId, 'asc')]);
    }
}
