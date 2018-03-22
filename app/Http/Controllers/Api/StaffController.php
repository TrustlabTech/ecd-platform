<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\TokenUser;

class StaffController extends Controller
{
    use TokenUser;

    protected $staff;
    protected $currentUser;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staff = $staffRepository;
        $this->currentUser = $this->getCurrentUser();
        $this->middleware('token.auth');
    }

    public function update(Request $request, $id)
    {
        if ($this->staff->update($request->all(), $id))
            return response()->json(['success' => 'true', 'message' => 'Staff updated successfully', 'data' => []]);

        return response()->json(['success' => 'false', 'message' => 'An error occurred', 'data' => []], 422);
    }

    /**
     * check if staff with id number exists
     * @param  string $id_number
     * @return json
     */

    public function existsbyId($id_number)
    {
        return response()->json($this->staff->existsbyId($id_number));
    }
}