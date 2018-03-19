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
use App\Http\Requests\Staff\FetchByIDRequest;
use App\Integrations\TIM\TIM;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    private $EISendpoint;

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

        $this->EISendpoint = env('API_V2_CREATE_DID_ENDPOINT', 'http://api.amply.tech/eis');
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

    public function addFetchByTIM(FetchByIDRequest $request)
    {
        $tim = new TIM();

        $timResponse = $tim->idCheck('ZA', $request->id_number, null, 'retrieval');

        $warningFlag = false;

        if ($timResponse->status === "ERROR") {
            return redirect()->route('staff.create')
                    ->with('danger', 'ID number not found');
        }

        if ($timResponse->status === "PENDING") {
            return redirect()->route('staff.create')
                    ->with('danger', 'The result is pending (Taking too long to respond), please try again');
        }

        if (property_exists($timResponse->response,'first_name')) {
            $data['given_name'] = ucwords(strtolower($timResponse->response->first_name));
        } else {
            $data['given_name'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'surname')) {
            $data['family_name'] = ucwords(strtolower($timResponse->response->surname));
        } else {
            $data['family_name'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'gender')) {
            $data['gender'] = strtolower($timResponse->response->gender);
        } else {
            $data['gender'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'identity_number')) {
            $data['id_number'] = ucwords(strtolower($timResponse->response->identity_number));
        } else {
            $data['id_number'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'date_of_birth')) {
            $data['date_of_birth'] = ucwords(strtolower($timResponse->response->date_of_birth));
        } else {
            $data['date_of_birth'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'citizenship')) {
            $data['citizenship'] = ucwords(strtolower($timResponse->response->citizenship));
        } else {
            $data['citizenship'] == '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'issuing_country')) {
            $data['nationality'] = $timResponse->response->issuing_country;
        } else {
            $data['nationality'] == '';
            $warningFlag = true;
        }

        if($warningFlag === true){
            return redirect()->route('staff.create')->withInput($data)
                ->with('danger', 'Information fetched successfully, some fields are not filled in');
        }
        return redirect()->route('staff.create')->withInput($data)
                ->with('info', 'Information fetched successfully');
    }
}
