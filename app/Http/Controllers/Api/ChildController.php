<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Interfaces\ChildRepositoryInterface;
use App\Http\Requests\Child\StoreChildRequest;
use App\Traits\TokenUser;

class ChildController extends Controller
{
    use TokenUser;

    protected $child;
    protected $currentUser;

    public function __construct(ChildRepositoryInterface $childRepository)
    {
        $this->child = $childRepository;
        $this->currentUser = $this->getCurrentUser();
        $this->middleware('token.auth');
    }

    /**
     * Retrieve children by class
     * @param  string $class_id
     * @param  string $orderBy
     * @return json
     */
    public function byClass($class_id, $orderBy = "asc")
    {
        return response()->json($this->child->byClass($class_id, $orderBy));
    }

    /**
     * addChild API Endpoint
     * @param StoreChildRequest $request
     */
    public function addChild(StoreChildRequest $request)
    {
        return response()->json($this->child->create($request->all()));
    }
}
