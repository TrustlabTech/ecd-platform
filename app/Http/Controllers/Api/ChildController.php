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
     * Retrieve children by class
     * @param  string $center_id
     * @param  string $orderBy
     * @return json
     */
    public function byCenter($center_id, $orderBy = "asc")
    {
        return response()->json($this->child->byCenter($center_id, $orderBy));
    }

    /**
     * Check if child with ID number exists
     * @param  string $id_number
     * @return json
     */
    public function existsbyId($id_number)
    {
        return response()->json($this->child->existsbyId($id_number));
    }

    /**
     * addChild API Endpoint
     * @param StoreChildRequest $request
     */
    public function addChild(StoreChildRequest $request)
    {
        return response()->json($this->child->create($request->all()));
    }

    public function update(Request $request, $childId)
    {
        if ($this->child->update($request->all(), $childId))
            return response()->json(['success' => 'true', 'message' => 'Child updated successfully', 'data' => []]);

        return response()->json(['success' => 'false', 'message' => 'An error occurred', 'data' => []], 422);
    }
}
