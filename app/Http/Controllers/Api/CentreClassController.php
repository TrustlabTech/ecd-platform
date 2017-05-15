<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\Interfaces\CentreClassRepositoryInterface;
use App\Traits\TokenUser;

class CentreClassController extends Controller
{
    use TokenUser;

    protected $centreClass;
    protected $currentUser;

    public function __construct(CentreClassRepositoryInterface $centreClassRepository)
    {
        $this->centreClass = $centreClassRepository;
        $this->currentUser = $this->getCurrentUser();
        $this->middleware('token.auth');
    }

    public function indexByCentre($centre_id)
    {
        return response()->json($this->centreClass->byCentre($centre_id));
    }
}
