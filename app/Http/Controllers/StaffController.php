<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Interfaces\ECDQualificationRepositoryInterface;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Requests\Staff\StoreStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use App\Http\Requests\Staff\FetchByIDRequest;
use App\Http\Requests\Staff\UpdateFetchByIDRequest;
use App\Integrations\TIM\TIM;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Log;
use Auth;

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
        if(Auth::user()->isPractitioner()){
            return view('staff.list', ['staff' => $this->staff->paginate(5), 'search' => false]);
        }
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
        
        // below checks for duplicates
        $IDexists = $this->staff->existsbyId($request->za_id_number);
        
        if($IDexists && !empty($request->za_id_number)) {
            return redirect()->route('staff.create')->with('danger', 'Staff member with that ID already exists');
        } else {

        }

        //below checks if ID is valid against national registry
        if(!empty($request->za_id_number)){
            $tim = new TIM();
            $timResponse = $tim->idCheck('ZA', $request->za_id_number, null, 'staff', 'verification');
            
            if ($timResponse->status === "ERROR") {
                return redirect()->route('staff.create')
                        ->with('danger', 'ID number not found');
            }

            if ($timResponse->status === "PENDING") {
                return redirect()->route('staff.create')
                        ->with('info', 'The validation result is pending (Taking too long to respond), please try again');
            }
        }
        //end of ID validations

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

    public function withoutId(Request $request)
    {
        return view(
            'staff.report',
            [
                'staff' => $this->staff->withoutIdReport(),
                'heading' => 'Staff without ID number'
            ]
        );
    }

    public function invalidId(Request $request)
    {
        return view(
            'staff.report',
            [
                'staff' => $this->staff->invalidIdReport(),
                'heading' => 'Staff with invalid ID number'
            ]
        );
    }

    public function addFetchByTIM(FetchByIDRequest $request)
    {        
        $warningFlag = false;

        //below checks if ID is valid against national registry
        $tim = new TIM();
        $timResponse = $tim->idCheck('ZA', $request->za_id_number, null, 'staff', 'retrieval');
        
        if ($timResponse->status === "ERROR") {
            return redirect()->route('staff.create')
                    ->with('danger', 'ID number not found');
        }

        if ($timResponse->status === "PENDING") {
            return redirect()->route('staff.create')
                    ->with('info', 'The validation result is pending (Taking too long to respond), please try again');
        }
        //end of ID validations

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
            $data['za_id_number'] = ucwords(strtolower($timResponse->response->identity_number));
        } else {
            $data['za_id_number'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'date_of_birth')) {
            $data['date_of_birth'] = ucwords(strtolower($timResponse->response->date_of_birth));
        } else {
            $data['date_of_birth'] = '';
            $warningFlag = true;
        }
        if (property_exists($timResponse->response,'citizenship')) {
            if(ucwords(strtolower($timResponse->response->citizenship)) == "South African"){
                $data['citizenship'] = "ZA";
            }
            // $data['citizenship'] = ucwords(strtolower($timResponse->response->citizenship));
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

    public function updateFetchByTIM($staffId, UpdateFetchByIDRequest $request)
    {
        $staff = $this->staff->find($staffId);

        if ($staff === null) {
            return redirect()->route('staff.index');
        }

        $tim = new TIM();
        $timResponse = $tim->idCheck('ZA', $request->za_id_number, $staffId, 'staff', 'vertification');
        
        if ($timResponse->status === "ERROR") {
            return redirect()->route('staff.index')->with('danger', 'ID number not found');
        }

        $data = [];

        if ($staff->given_name === null || $staff->given_name === '') {
            $data['given_name'] = ucwords(strtolower($timResponse->response->first_name));
        }

        if ($staff->family_name === null || $staff->family_name === '') {
            $data['family_name'] = ucwords(strtolower($timResponse->response->surname));
        }

        if ($staff->gender === null || $staff->gender === '') {
            $data['gender'] = strtolower($timResponse->response->gender);
        }

        if ($staff->date_of_birth === null || $staff->date_of_birth === "0000-00-00") {
            $data['date_of_birth'] = $timResponse->response->date_of_birth;
        }

        if ($staff->citizenship === null || $staff->citizenship === '') {
            $data['citizenship'] = $timResponse->response->issuing_country;
        }

        $errorBag = new MessageBag();

        if ($staff->given_name !== null && $staff->given_name !== '') {
            if ($staff->given_name !== ucwords(strtolower($timResponse->response->first_name))) {
                $errorBag->add('token', 'Mismatch - Given Name: <' . $staff->given_name . '> Should be: '. ucwords(strtolower($timResponse->response->first_name)));
            }
        }

        if ($staff->family_name !== null && $staff->family_name !== '') {
            if ($staff->family_name !== ucwords(strtolower($timResponse->response->surname))) {
                $errorBag->add('token', 'Mismatch -  Family Name: <' . $staff->family_name . '> Should be: '. ucwords(strtolower($timResponse->response->surname)));
            }
        }

        if ($staff->gender !== null && $staff->gender !== '') {
            if ($staff->gender !== "0000-00-00" && $staff->gender !== strtolower($timResponse->response->gender)) {
                $errorBag->add('token', 'Mismatch - Gender: <' . ucwords(strtolower($staff->gender)) . '> Should be: '. ucwords(strtolower($timResponse->response->gender)));
            }
        }

        if ($staff->date_of_birth !== null && $staff->date_of_birth !== "0000-00-00") {
            if ($staff->date_of_birth !== "0000-00-00" && $staff->date_of_birth !== $timResponse->response->date_of_birth) {
                $errorBag->add('token', 'Mismatch - Date of Birth: <' . $staff->date_of_birth . '> Should be: '. $timResponse->response->date_of_birth);
            }
        }

        if ($staff->citizenship !== null && $staff->citizenship !== '') {
            if ($staff->citizenship !== null && $staff->citizenship !== $timResponse->response->issuing_country) {
                $errorBag->add('token', 'Mismatch - Citizenship: <' . $staff->retrieveNameByCode($staff->citizenship) . '> Should be: '. $staff->retrieveNameByCode($timResponse->response->issuing_country));
            }
        }

        $matchedBag = new MessageBag();

        if ($staff->given_name === ucwords(strtolower($timResponse->response->first_name))) {
            $matchedBag->add('token', 'Matched - Given Name');
        }

        if ($staff->family_name === ucwords(strtolower($timResponse->response->surname))) {
            $matchedBag->add('token', 'Matched - Family Name');
        }

        if ($staff->gender === strtolower($timResponse->response->gender)) {
            $matchedBag->add('token', 'Matched - Gender');
        }

        if ($staff->date_of_birth === $timResponse->response->date_of_birth) {
            $matchedBag->add('token', 'Matched - Date of Birth');
        }

        if ($staff->citizenship === $timResponse->response->issuing_country) {
            $matchedBag->add('token', 'Matched - Citizenship');
        }

        if ($errorBag->count() >= 1 && $matchedBag->count() < 1) {
            return redirect()->route('staff.edit', ['staff' => $staff->id])->withInput($data)
                ->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $errorBag));
        }

        if ($errorBag->count() < 1 && $matchedBag->count() >= 1) {
            return redirect()->route('staff.edit', ['staff' => $staff->id])->withInput($data)
                ->with('successful', session()->get('successful', new ViewErrorBag)->put('default', $matchedBag));
        }

        if ($errorBag->count() >= 1 && $matchedBag->count() >= 1) {
            return redirect()->route('staff.edit', ['staff' => $staff->id])->withInput($data)
                ->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $errorBag))
                ->with('successful', session()->get('successful', new ViewErrorBag)->put('default', $matchedBag));
        }

        return redirect()->route('staff.edit', ['staff' => $staff->id])->withInput($data);
    }
}
