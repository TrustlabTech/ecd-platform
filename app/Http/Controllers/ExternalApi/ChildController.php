<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ChildRepositoryInterface;

class ChildController extends Controller
{
    protected $child;

    public function __construct(ChildRepositoryInterface $childRepository)
    {
        $this->child = $childRepository;
        $this->middleware('auth.external');
    }

    /**
    * Retrieve all Children
    *
    * Token must be suplied as query string: external/api/v1/child?token=your-token-here
    *
    */
    public function index()
    {
        return response()->json($this->child->externalAll());
    }
}
