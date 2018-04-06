<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Centre;
use App\Models\CentreClass;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Config;
use DB;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Models\User;
use App\Models\Role;
use App\Models\Staff;

use Auth;

class StaffAuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Login for the staff
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JWTAuth Token
     */
     public function postLogin(Request $request)
     {
         $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

         if ($validator->fails()) {
             $response = [
                "error" => $validator->errors()->all()
            ];

             return response()->json($response, 401);
         } else {
            $creds = $request->only('username', 'password');
            try {
                if (! $token = JWTAuth::attempt($creds)) {
                    return response()->json(['error' => 'Invalid Credentials'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Auth Token Failure'], 500);
            }

            $user = Auth::user();
            $centreId = $user->staff->centre->id;
            $staffCount = $user->staff->centre->staff->count();

            $graduatedClass = CentreClass::where('name', 'SYS_GRADUATED')->get();
            $unassignedClass = CentreClass::where('name', 'SYS_UNASSIGNED')->get();

             $childrenCount = DB::table('children')
            ->join('centre_classes', 'children.centre_class_id', '=', 'centre_classes.id')
            ->where('centre_classes.centre_id', $centreId)
            ->count();

             $meta = [
            'staffCount' => $staffCount,
            'childrenCount' => $childrenCount,
            'graduatedClass' => $graduatedClass,
            'unassignedClass' => $unassignedClass
        ];


            return response()->json(['_token' => $token, 'user' => $user->staff, 'meta' => $meta]);
        }
     }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'phone_number' => 'required',
             'password' => 'required|confirmed',
             'did' => 'required',
             'za_id_number' => 'required',
             'family_name' => 'required',
             'given_name' => 'required',
             'principle' => 'required|boolean',
             'practitioner' => 'required|boolean',
             'volunteer' => 'required|boolean',
             'cook' => 'required|boolean',
             'other' => 'required|boolean',
             'registration_latitude' => 'required',
             'registration_longitude' => 'required',
             'ecd_qualification_id' => 'required',
             'centre_id' => 'required'
         ]);

        if ($validator->fails()) {
            $response = [
                 "error" => $validator->errors()->all()
             ];

            return response()->json($response, 401);
        } else {
            $staffInfo = [
                 'did' => $request->get('did'),
                 'za_id_number' => $request->get('za_id_number'),
                 'family_name' => $request->get('family_name'),
                 'given_name' => $request->get('given_name'),
                 'principle' => $request->get('principle'),
                 'practitioner' => $request->get('practitioner'),
                 'volunteer' => $request->get('volunteer'),
                 'cook' => $request->get('cook'),
                 'other' => $request->get('other'),
                 'registration_latitude' => $request->get('registration_latitude'),
                 'registration_longitude' => $request->get('registration_longitude'),
                 'ecd_qualification_id' => $request->get('ecd_qualification_id'),
                 'centre_id' => $request->get('centre_id'),
                 'username' => $request->get('phone_number'),
                 'password' => bcrypt($request->get('password'))

             ];

            $staff = Staff::create($staffInfo);

            if ($staff) {
                return response()->json(['success' => 'User Created']);
            } else {
                return response()->json(['error' => 'User could not be created']);
            }
        }
    }
}
