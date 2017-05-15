<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Requests\Centre\StoreCentreRequest;
use App\Http\Requests\Centre\UpdateCentreRequest;

class CentreController extends Controller
{
    protected $centre;

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centre = $centreRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('centre.list', ['centres' => $this->centre->paginate(100), 'search' => false]);
    }

    public function create()
    {
        return view('centre.create', ['centre' => $this->centre->emptyModel()]);
    }

    public function store(StoreCentreRequest $request)
    {
        if ($this->centre->create($request->all())) {
            return redirect()->route('centre.index')->with('info', 'Centre successfully added');
        } else {
            return redirect()->route('centre.index')->with('info', 'Error adding centre');
        }
    }

    public function edit($id)
    {
        return view('centre.edit', ['centre' => $this->centre->find($id)]);
    }

    public function update(UpdateCentreRequest $request, $id)
    {
        if ($this->centre->update($request->all(), $id)) {
            return redirect()->route('centre.index')->with('info', 'Centre successfully updated');
        } else {
            return redirect()->route('centre.index')->with('info', 'Error updating centre');
        }
    }

    public function delete($id)
    {
        return view('centre.delete', ['centre' => $this->centre->find($id)]);
    }

    public function destroy($id)
    {
        try {
            if ($this->centre->delete($id)) {
                return redirect()->route('centre.index')->with('info', 'Centre successfully deleted');
            } else {
                return redirect()->route('centre.index')->with('danger', 'Error deleting centre');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('centre.index')->with('danger', 'Error deleting centre - might have classes associated with it.');
        }
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('centre.index');
        }
        $centres = $this->centre->search($phrase);

        return view('centre.list', ['centres' => $centres, 'search' => true, 'phrase' => $phrase]);
    }
}
