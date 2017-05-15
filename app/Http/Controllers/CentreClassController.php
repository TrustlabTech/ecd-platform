<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CentreClassRepositoryInterface;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Requests\CentreClass\StoreCentreClassRequest;
use App\Http\Requests\CentreClass\UpdateCentreClassRequest;

class CentreClassController extends Controller
{
    protected $centreClass;
    protected $centre;

    public function __construct(CentreRepositoryInterface $centreRepository,
        CentreClassRepositoryInterface $centreClassRepository)
    {
        $this->centre = $centreRepository;
        $this->centreClass = $centreClassRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('centreClass.list', ['centreClasses' => $this->centreClass->paginate(100), 'search' => false]);
    }

    public function create()
    {
        $centres = [null => 'Please Select'] + ($this->centre->allFiltered()->lists('name', 'id')->toArray());

        return view('centreClass.create', ['centreClass' => $this->centreClass->emptyModel(),
            'centres' => $centres]);
    }

    public function store(StoreCentreClassRequest $request)
    {
        if ($this->centreClass->create($request->all())) {
            return redirect()->route('centreClass.index')->with('info', 'Class successfully added');
        } else {
            return redirect()->route('centreClass.index')->with('info', 'Error adding class');
        }
    }

    public function edit($id)
    {
        $centres = $this->centre->allFiltered()->lists('name', 'id')->toArray();

        return view('centreClass.edit', ['centreClass' => $this->centreClass->find($id),
            'centres' => $centres]);
    }

    public function update(UpdateCentreClassRequest $request, $id)
    {
        if ($this->centreClass->update($request->all(), $id)) {
            return redirect()->route('centreClass.index')->with('info', 'Class successfully updated');
        } else {
            return redirect()->route('centreClass.index')->with('info', 'Error updating class');
        }
    }

    public function delete($id)
    {
        return view('centreClass.delete', ['centreClass' => $this->centreClass->find($id)]);
    }

    public function destroy($id)
    {
        try {
            if ($this->centreClass->delete($id)) {
                return redirect()->route('centreClass.index')->with('info', 'Class successfully deleted');
            } else {
                return redirect()->route('centreClass.index')->with('danger', 'Error deleting Class');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('centreClass.index')->with('danger', 'Error deleting class - might have children associated with it.');
        }
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('centreClass.index');
        }
        $centreClass = $this->centreClass->search($phrase);

        return view('centreClass.list', ['centreClasses' => $centreClass, 'search' => true, 'phrase' => $phrase]);
    }
}
