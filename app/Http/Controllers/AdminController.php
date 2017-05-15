<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    protected $admin;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->admin = $adminRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.list', ['administrators' => $this->admin->paginate(100)]);
    }

    public function create()
    {
        return view('admin.create', ['admin' => $this->admin->emptyModel()]);
    }

    public function store(StoreAdminRequest $request)
    {
        if ($this->admin->create($request->all())) {
            return redirect()->route('admin.index')->with('info', 'Administrator successfully added');
        } else {
            return redirect()->route('admin.index')->with('info', 'Error adding administrator');
        }
    }

    public function edit($id)
    {
        return view('admin.edit', ['admin' => $this->admin->find($id)]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        if ($this->admin->update($request->all(), $id)) {
            return redirect()->route('admin.index')->with('info', 'Administrator successfully updated');
        } else {
            return redirect()->route('admin.index')->with('info', 'Error updating administrator');
        }
    }

    public function delete($id)
    {
        return view('admin.delete', ['admin' => $this->admin->find($id)]);
    }

    public function destroy($id)
    {
        if ($this->admin->delete($id)) {
            return redirect()->route('admin.index')->with('info', 'Administrator successfully deleted');
        } else {
            return redirect()->route('admin.index')->with('danger', 'Error deleting administrator');
        }
    }
}
