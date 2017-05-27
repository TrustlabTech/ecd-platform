<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Interfaces\ECDQualificationRepositoryInterface;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Requests\Staff\StoreStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Log;
class StaffController extends Controller
{
    private $EISendpoint = 'http://amply-api.cloudapp.net/eis';

    protected $staff;
    protected $qualification;
    protected $centre;

    public function __construct(StaffRepositoryInterface $staffRepository,
        ECDQualificationRepositoryInterface $qualificationRepository,
        CentreRepositoryInterface $centreRepository)
    {
        $this->staff = $staffRepository;
        $this->qualification = $qualificationRepository;
        $this->centre = $centreRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('staff.list', ['staff' => $this->staff->paginate(100), 'search' => false]);
    }

    public function create()
    {
        $centres = [null => 'Please Select'] + ($this->centre->allFiltered()->lists('name', 'id')->toArray());

        return view('staff.create', ['staff' => $this->staff->emptyModel(),
            'qualifications' => $this->qualification->allFiltered(),
            'centres' => $centres]);
    }

    public function store(StoreStaffRequest $request)
    {
        $resourceID = $this->staff->create($request->all());

        if ($resourceID) {

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
                        'id' => $resourceID,
                        'type' => 'practitioner'
                    ]
                ]);

                return redirect()->route('staff.index')->with('info', 'Staff successfully added');

            } catch (\Exception $e) {
                // if DID creation request fails, delete the resource created for consistency
                $this->staff->delete($resource->id);
                return redirect()->route('staff.index')->with('info', 'Error adding staff: ' . $e->getMessage());
            }

        }

        return redirect()->route('staff.index')->with('info', 'Error adding staff');
    }

    public function edit($id)
    {
        $centres = $this->centre->allFiltered()->lists('name', 'id')->toArray();

        return view('staff.edit', ['staff' => $this->staff->find($id),
            'qualifications' => $this->qualification->allFiltered(),
            'centres' => $centres]);
    }

    public function update(UpdateStaffRequest $request, $id)
    {
        if ($this->staff->update($request->all(), $id)) {
            return redirect()->route('staff.index')->with('info', 'Staff successfully updated');
        } else {
            return redirect()->route('staff.index')->with('info', 'Error updating staff');
        }
    }

    public function delete($id)
    {
        return view('staff.delete', ['staff' => $this->staff->find($id)]);
    }

    public function destroy($id)
    {
        if ($this->staff->delete($id)) {
            return redirect()->route('staff.index')->with('info', 'Staff successfully deleted');
        } else {
            return redirect()->route('staff.index')->with('danger', 'Error deleting staff');
        }
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('staff.index');
        }
        $staff = $this->staff->search($phrase);

        return view('staff.list', ['staff' => $staff, 'search' => true, 'phrase' => $phrase]);
    }
}
