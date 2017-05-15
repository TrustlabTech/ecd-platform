<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExternalRepositoryInterface;
use App\Http\Requests\External\StoreUserRequest;
use App\Http\Requests\External\UpdateUserRequest;

class ExternalUserController extends Controller
{
    protected $external;

    public function __construct(ExternalRepositoryInterface $externalRepository)
    {
        $this->middleware('auth');
        $this->external = $externalRepository;
    }

    public function index()
    {
        return view('externalUser.list', ['users' => $this->external->allWebUsers()]);
    }

    public function create()
    {
        return view('externalUser.create', ['user' => $this->external->emptyModel()]);
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->external->createWebUser($request->all())) {
            return redirect()->route('externalUser.index')->with('info', 'External user successfully added');
        } else {
            return redirect()->route('externalUser.index')->with('info', 'Error adding external user');
        }
    }

    public function edit($id)
    {
        return view('externalUser.edit', ['user' => $this->external->findWebUser($id)]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if ($this->external->updateWebUser($request->all(), $id)) {
            return redirect()->route('externalUser.index')->with('info', 'External user successfully updated');
        } else {
            return redirect()->route('externalUser.index')->with('info', 'Error updating external user');
        }
    }

    public function delete($id)
    {
        return view('externalUser.delete', ['user' => $this->external->findWebUser($id)]);
    }

    public function destroy($id)
    {
        if ($this->external->deleteWebUser($id)) {
            return redirect()->route('externalUser.index')->with('info', 'External user successfully deleted');
        } else {
            return redirect()->route('externalUser.index')->with('danger', 'Error deleting external user');
        }
    }
}
