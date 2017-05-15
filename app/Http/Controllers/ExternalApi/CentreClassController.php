<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CentreClassRepositoryInterface;

class CentreClassController extends Controller
{
    protected $centreClass;

    public function __construct(CentreClassRepositoryInterface $centreClassRepository)
    {
        $this->centreClass = $centreClassRepository;
        $this->middleware('auth.external');
    }

    /**
    * Retrieve All Classes
    *
    * Token must be suplied as query string: external/api/v1/class?token=your-token-here
    *
    */
    public function index()
    {
        return response()->json($this->centreClass->externalAll());
    }
}
