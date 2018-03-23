<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use App\Repositories\Interfaces\ChildRepositoryInterface;
use App\Repositories\Interfaces\CentreClassRepositoryInterface;
use App\Http\Requests\Child\StoreChildRequest;
use App\Http\Requests\Child\UpdateChildRequest;
use App\Http\Requests\Child\FetchByIDRequest;
use App\Http\Requests\Child\UpdateFetchByIDRequest;
use App\Integrations\TIM\TIM;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ChildController extends Controller
{
    private $EISendpoint;

    protected $child;
    protected $centreClass;

    public function __construct(
        ChildRepositoryInterface $childRepository,
        CentreClassRepositoryInterface $centreClassRepository
    ) {
        $this->child = $childRepository;
        $this->centreClass = $centreClassRepository;
        $this->middleware('auth');

        $this->EISendpoint = env('API_V2_CREATE_DID_ENDPOINT', 'http://api.amply.tech/eis');
    }

    public function index()
    {
        return view(
            'children.list',
            [
                'children' => $this->child->paginate(100),
                'search' => false
            ]
        );
    }

    public function create()
    {
        $classesWithCentre = [null => 'Please Select'] + $this->centreClass->allWithCentreName();
        $races = [null => 'Please Select'] + $this->child->allRaces();

        return view('children.create', ['child' => $this->child->emptyModel(),
            'centreClasses' => $classesWithCentre,
            'races' => $races]);
    }

    public function store(StoreChildRequest $request)
    {
        $IDexists = $this->child->existsbyId($request->id_number);

        if($IDexists) {
            return redirect()->route('child.create')->with('danger', 'Child with that ID already exists');
        }
        
        $resource = $this->child->create($request->all());
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
                        'type' => 'child'
                    ]
                ]);

                return redirect()->route('child.index')->with('info', 'Child successfully added');

            } catch (\Exception $e) {
                // if DID creation request fails, delete the resource created for consistency
                $this->child->delete($resource->id);
                return redirect()->route('child.index')->with('info', 'Error adding child: ' . $e->getMessage());
            }
        }

        return redirect()->route('child.index')->with('info', 'Error adding child');
    }

    public function edit($childId)
    {
        return view('children.edit', ['child' => $this->child->find($childId),
            'centreClasses' => $this->centreClass->allWithCentreName(),
            'races' => [null => 'Please Select'] + $this->child->allRaces()
        ]);
    }

    public function update(UpdateChildRequest $request, $childId)
    {

        if($request->current_class != $request->centre_class_id){
                $centreID = DB::table('centre_classes')->where('id',$request->centre_class_id)->value('centre_id');
                $current_time = Carbon::now()->toDateTimeString();
        
                DB::table('child_class_movements')->insert(
                    ['child_id' => $childId,
                    'centre_id' => $centreID,
                    'class_id' => $request->centre_class_id,
                    'prev_class_id' => $request->current_class,
                    'created_at'=>$current_time,
                    'updated_at'=>$current_time]
                );
                
        }

        $request->offsetUnset('current_class');
        if ($this->child->update($request->all(), $childId)) {
            return redirect()->route('child.index')->with('info', 'Child successfully updated');
        }

        return redirect()->route('child.index')->with('info', 'Error updating child');
    }

    public function delete($childId)
    {
        return view('children.delete', ['child' => $this->child->find($childId)]);
    }

    public function destroy($childId)
    {
        try {
            if ($this->child->delete($childId)) {
                return redirect()->route('child.index')->with('info', 'Child successfully deleted');
            }

            return redirect()->route('child.index')
                            ->with('danger', 'Error deleting child');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('child.index')
                            ->with(
                                'danger',
                                'Error deleting child - might have attendance records associated with it.'
                            );
        }
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('child.index');
        }
        $children = $this->child->search($phrase);

        return view('children.list', ['children' => $children, 'search' => true, 'phrase' => $phrase]);
    }

    public function withoutId(Request $request)
    {
        return view(
            'children.report',
            [
                'children' => $this->child->withoutIdReport(),
                'heading' => 'Children without ID number'
            ]
        );
    }

    public function invalidId(Request $request)
    {
        return view(
            'children.report',
            [
                'children' => $this->child->invalidIdReport(),
                'heading' => 'Children with invalid ID number'
            ]
        );
    }

    public function addFetchByTIM(FetchByIDRequest $request)
    {
        $tim = new TIM();
        $timResponse = $tim->idCheck('ZA', $request->id_number, null, 'child', 'retrieval');

        $warningFlag = false;

        if ($timResponse->status === "ERROR") {
            return redirect()->route('child.create')
                    ->with('danger', 'ID number not found');
        }

        if ($timResponse->status === "PENDING") {
            return redirect()->route('child.create')
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
            if(ucwords(strtolower($timResponse->response->citizenship)) == "South African"){
                $data['citizenship'] = "ZA";
            }
        }
        else {
            $data['citizenship'] == '';
            $warningFlag = true;
        }

        if($warningFlag === true){
            return redirect()->route('child.create')->withInput($data)
                ->with('danger', 'Information fetched successfully, some fields are not filled in');
        }
        return redirect()->route('child.create')->withInput($data)
                ->with('info', 'Information fetched successfully');
    }

    public function updateFetchByTIM($childId, UpdateFetchByIDRequest $request)
    {
        $child = $this->child->find($childId);

        if ($child === null) {
            return redirect()->route('child.index');
        }

        $tim = new TIM();
        $timResponse = $tim->idCheck('ZA', $request->id_number, $childId, 'child', 'verification');
        
        if ($timResponse->status === "ERROR") {
            return redirect()->route('child.index')->with('danger', 'ID number not found');
        }

        $data = [];

        if ($child->given_name === null || $child->given_name === '') {
            $data['given_name'] = ucwords(strtolower($timResponse->response->first_name));
        }

        if ($child->family_name === null || $child->family_name === '') {
            $data['family_name'] = ucwords(strtolower($timResponse->response->surname));
        }

        if ($child->gender === null || $child->gender === '') {
            $data['gender'] = strtolower($timResponse->response->gender);
        }

        if ($child->date_of_birth === null || $child->date_of_birth === "0000-00-00") {
            $data['date_of_birth'] = $timResponse->response->date_of_birth;
        }

        if ($child->citizenship === null || $child->citizenship === '') {
            $data['citizenship'] = $timResponse->response->issuing_country;
        }

        $errorBag = new MessageBag();

        if ($child->given_name !== null && $child->given_name !== '') {
            if ($child->given_name !== ucwords(strtolower($timResponse->response->first_name))) {
                $errorBag->add('token', 'Mismatch - Given Name: <' . $child->given_name . '> Should be: '. ucwords(strtolower($timResponse->response->first_name)));
            }
        }

        if ($child->family_name !== null && $child->family_name !== '') {
            if ($child->family_name !== ucwords(strtolower($timResponse->response->surname))) {
                $errorBag->add('token', 'Mismatch -  Family Name: <' . $child->family_name . '> Should be: '. ucwords(strtolower($timResponse->response->surname)));
            }
        }

        if ($child->gender !== null && $child->gender !== '') {
            if ($child->gender !== "0000-00-00" && $child->gender !== strtolower($timResponse->response->gender)) {
                $errorBag->add('token', 'Mismatch - Gender: <' . ucwords(strtolower($child->gender)) . '> Should be: '. ucwords(strtolower($timResponse->response->gender)));
            }
        }

        if ($child->date_of_birth !== null && $child->date_of_birth !== "0000-00-00") {
            if ($child->date_of_birth !== "0000-00-00" && $child->date_of_birth !== $timResponse->response->date_of_birth) {
                $errorBag->add('token', 'Mismatch - Date of Birth: <' . $child->date_of_birth . '> Should be: '. $timResponse->response->date_of_birth);
            }
        }

        if ($child->citizenship !== null && $child->citizenship !== '') {
            if ($child->citizenship !== null && $child->citizenship !== $timResponse->response->issuing_country) {
                $errorBag->add('token', 'Mismatch - Citizenship: <' . $child->retrieveNameByCode($child->citizenship) . '> Should be: '. $child->retrieveNameByCode($timResponse->response->issuing_country));
            }
        }

        $matchedBag = new MessageBag();

        if ($child->given_name === ucwords(strtolower($timResponse->response->first_name))) {
            $matchedBag->add('token', 'Matched - Given Name');
        }

        if ($child->family_name === ucwords(strtolower($timResponse->response->surname))) {
            $matchedBag->add('token', 'Matched - Family Name');
        }

        if ($child->gender === strtolower($timResponse->response->gender)) {
            $matchedBag->add('token', 'Matched - Gender');
        }

        if ($child->date_of_birth === $timResponse->response->date_of_birth) {
            $matchedBag->add('token', 'Matched - Date of Birth');
        }

        if ($child->citizenship === $timResponse->response->issuing_country) {
            $matchedBag->add('token', 'Matched - Citizenship');
        }

        if ($errorBag->count() >= 1 && $matchedBag->count() < 1) {
            return redirect()->route('child.edit', ['child' => $child->id])->withInput($data)
                ->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $errorBag));
        }

        if ($errorBag->count() < 1 && $matchedBag->count() >= 1) {
            return redirect()->route('child.edit', ['child' => $child->id])->withInput($data)
                ->with('successful', session()->get('successful', new ViewErrorBag)->put('default', $matchedBag));
        }

        if ($errorBag->count() >= 1 && $matchedBag->count() >= 1) {
            return redirect()->route('child.edit', ['child' => $child->id])->withInput($data)
                ->with('errors', session()->get('errors', new ViewErrorBag)->put('default', $errorBag))
                ->with('successful', session()->get('successful', new ViewErrorBag)->put('default', $matchedBag));
        }

        return redirect()->route('child.edit', ['child' => $child->id])->withInput($data);
    }
}
