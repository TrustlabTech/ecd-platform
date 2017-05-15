<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StaffRepositoryInterface;

class StaffController extends Controller
{
    protected $staff;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staff = $staffRepository;
        $this->middleware('auth.external');
    }

    /**
    * Retrieve all Staff
    *
    * Token must be suplied as query string: external/api/v1/staff?token=your-token-here
    *
    */
    public function index()
    {
        return response()->json($this->staff->externalAll());
    }
}
