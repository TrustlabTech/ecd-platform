<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Requests\Centre\StoreCentreRequest;
use App\Http\Requests\Centre\UpdateCentreRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class CentreController extends Controller
{
    private $EISendpoint = 'http://amply-api.cloudapp.net/eis';

    protected $centre;

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centre = $centreRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('centre.list', ['centres' => $this->centre->paginate(100), 'search' => false]);
    }

    public function create()
    {
        return view('centre.create', ['centre' => $this->centre->emptyModel()]);
    }

    public function store(StoreCentreRequest $request)
    {
        $resource = $this->centre->create($request->all());
        if (!empty($resource->id)) {

            $sub = -1; // us
            $payload = JWTFactory::sub($sub)->make();
            $token = JWTAuth::encode($payload);

            $restClient = new GuzzleHttp\Client();

            try {

                $restClient->post($this->EISendpoint, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'id' => $resource->id,
                        'type' => 'centre'
                    ]
                ]);

                return redirect()->route('centre.index')->with('info', 'Centre successfully added');

            } catch (\Exception $e) {
                // if DID creation request fails, delete the resource created for consistency
                $this->centre->delete($resource->id);
                return redirect()->route('centre.index')->with('info', 'Error adding centre: ' . $e->getMessage());
            }

        }

        return redirect()->route('centre.index')->with('info', 'Error adding centre');
    }

    public function edit($id)
    {
        return view('centre.edit', ['centre' => $this->centre->find($id)]);
    }

    public function update(UpdateCentreRequest $request, $id)
    {
        if ($this->centre->update($request->all(), $id)) {
            return redirect()->route('centre.index')->with('info', 'Centre successfully updated');
        } else {
            return redirect()->route('centre.index')->with('info', 'Error updating centre');
        }
    }

    public function delete($id)
    {
        return view('centre.delete', ['centre' => $this->centre->find($id)]);
    }

    public function destroy($id)
    {
        try {
            if ($this->centre->delete($id)) {
                return redirect()->route('centre.index')->with('info', 'Centre successfully deleted');
            } else {
                return redirect()->route('centre.index')->with('danger', 'Error deleting centre');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('centre.index')->with('danger', 'Error deleting centre - might have classes associated with it.');
        }
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('centre.index');
        }
        $centres = $this->centre->search($phrase);

        return view('centre.list', ['centres' => $centres, 'search' => true, 'phrase' => $phrase]);
    }
}
