<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExternalRepositoryInterface;
use App\Http\Requests\External\StoreApiUserRequest;
use App\Http\Requests\External\UpdateApiUserRequest;

class ExternalApiController extends Controller
{
    protected $external;

    public function __construct(ExternalRepositoryInterface $externalRepository)
    {
        $this->middleware('auth');
        $this->external = $externalRepository;
    }

    public function index()
    {
        return view('externalApiUser.list', ['users' => $this->external->allApiUsers()]);
    }

    public function create()
    {
        return view('externalApiUser.create', ['user' => $this->external->emptyModel()]);
    }

    public function store(StoreApiUserRequest $request)
    {
        if ($this->external->createApiUser($request->all())) {
            return redirect()->route('externalApiUser.index')->with('info', 'External user successfully added');
        } else {
            return redirect()->route('externalApiUser.index')->with('info', 'Error adding external user');
        }
    }

    public function edit($id)
    {
        return view('externalApiUser.edit', ['user' => $this->external->findApiUser($id)]);
    }

    public function update(UpdateApiUserRequest $request, $id)
    {
        if ($this->external->updateApiUser($request->all(), $id)) {
            return redirect()->route('externalApiUser.index')->with('info', 'External user successfully updated');
        } else {
            return redirect()->route('externalApiUser.index')->with('info', 'Error updating external user');
        }
    }

    public function delete($id)
    {
        return view('externalApiUser.delete', ['user' => $this->external->findApiUser($id)]);
    }

    public function destroy($id)
    {
        if ($this->external->deleteApiUser($id)) {
            return redirect()->route('externalApiUser.index')->with('info', 'External user successfully deleted');
        } else {
            return redirect()->route('externalApiUser.index')->with('danger', 'Error deleting external user');
        }
    }

    public function refreshToken($id)
    {
        if ($this->external->generateNewToken($id)) {
            return redirect()->route('externalApiUser.edit', ['user' => $id])->with('info', 'Token refreshed');
        } else {
            return redirect()->route('externalApiUser.edit', ['user' => $id])->with('danger', 'Error refreshing token');
        }
    }
}
