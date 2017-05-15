<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CentreRepositoryInterface;

class CentreController extends Controller
{
    protected $centre;

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centre = $centreRepository;
        $this->middleware('auth.external');
    }

    /**
    * Retrieve All Centres
    *
    * Token must be suplied as query string: external/api/v1/centre?token=your-token-here
    *
    */
    public function index()
    {
        return response()->json($this->centre->externalAll());
    }
}
