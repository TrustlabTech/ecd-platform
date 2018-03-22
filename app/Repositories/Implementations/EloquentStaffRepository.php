<?php

namespace App\Repositories\Implementations;

use DB;

use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Models\User;
use App\Models\Role;
use App\Models\Staff;

class EloquentStaffRepository extends AbstractEloquentRepository implements StaffRepositoryInterface
{
    protected $model;
    public $lastCreatedId;

    public function __construct(Staff $model)
    {
        $this->model = $model;
    }

    public function all($relations = [])
    {
        return Staff::with('user', 'centre')->get();
    }

    public function create(array $staff)
    {
        $user = new User();
        $user->username = $staff['phone_number'];
        $user->password = bcrypt($staff['password']);

        if ($user->save()) {
            $user->load('role');
            $role = Role::where('name', 'staff')->first();
            $user->role()->attach($role);

            $staffInfo = [
                'did' => $staff['did'],
                'za_id_number' => $staff['za_id_number'],
                'family_name' => $staff['family_name'],
                'given_name' => $staff['given_name'],
                'principle' => $staff['principle'],
                'practitioner' => $staff['practitioner'],
                'volunteer' => $staff['volunteer'],
                'cook' => $staff['cook'],
                'other' => $staff['other'],
                'registration_latitude' => $staff['registration_latitude'],
                'registration_longitude' => $staff['registration_longitude'],
                'ecd_qualification_id' => $staff['ecd_qualification_id'],
                'centre_id' => $staff['centre_id'],
                'gender' => $staff['gender'],
                'citizenship' => $staff['citizenship'],
                'date_of_birth' => $staff['date_of_birth'],
                'user_id' => $user->id
            ];

            $staff = Staff::create($staffInfo);

            if (!$staff) {
                $user->role()->detach($role);
                $user->delete();

                return false;
            } else {
                return $staff->id;
            }
        }

        return false;
    }

    public function update(array $staff, $id)
    {
        $staffUser = Staff::findOrfail($id);
        $staffInfo = $staff;
        unset($staffInfo['phone_number']);
        unset($staffInfo['password']);
        unset($staffInfo['password_confirmation']);

        // $staffInfo = [
        //     'did' => $staff['did'],
        //     'za_id_number' => $staff['za_id_number'],
        //     'family_name' => $staff['family_name'],
        //     'given_name' => $staff['given_name'],
        //     'principle' => $staff['principle'],
        //     'practitioner' => $staff['practitioner'],
        //     'volunteer' => $staff['volunteer'],
        //     'cook' => $staff['cook'],
        //     'other' => $staff['other'],
        //     'registration_latitude' => $staff['registration_latitude'],
        //     'registration_longitude' => $staff['registration_longitude'],
        //     'ecd_qualification_id' => $staff['ecd_qualification_id'],
        //     'centre_id' => $staff['centre_id']
        // ];

        if ($staffUser->update($staffInfo)) {
            if (isset($staff['phone_number'])) {
                $staffUser->user->username = $staff['phone_number'];
            }

            if (isset($staff['password'])) {
                if ($staff['password'] != null) {
                    $staffUser->user->password = bcrypt($staff['password']);
                }
            }

            $staffUser->user->save();

            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $staff = Staff::findOrfail($id);
        $role = Role::where('name', 'staff')->first();
        $staff->user->role()->detach($role);

        if ($staff->delete()) {
            $staff->user->delete();

            return true;
        } else {
            $staff->user->role()->attach($role);
        }

        return false;
    }

    public function existsbyId($id)
    {
        return Staff::where('za_id_number', $id)->get()->count() > 0;
    }

    public function search($phrase)
    {
        $combination = preg_split('/\s+/', $phrase);

        if (count($combination) === 1) {
            $staffByGivenName = Staff::where('given_name', 'like', '%' . $phrase . '%')->get();
            if ($staffByGivenName->count() >= 1) {
                return $staffByGivenName;
            }

            $staffByFamilyName = Staff::where('family_name', 'like', '%' . $phrase . '%')->get();
            if ($staffByFamilyName->count() >= 1) {
                return $staffByFamilyName;
            }

            $staffByZAId = Staff::where('za_id_number', 'like', '%' . $phrase . '%')->get();
            if ($staffByZAId->count() >= 1) {
                return $staffByZAId;
            }

            $staffByCell = Staff::whereHas('user', function ($query) use ($phrase) {
                $query->where('username', 'like', '%' . $phrase . '%');
            })->get();
            if ($staffByCell->count() >= 1) {
                return $staffByCell;
            }
        } elseif (count($combination) >= 2) {
            $staffNameCombination = Staff::where('family_name', 'LIKE', '%' . $combination[0] . '%')
                ->where('given_name', 'like', '%' . $combination[1] . '%')
                ->get();
            if ($staffNameCombination->count() >= 1) {
                return $staffNameCombination;
            }

            $staffNameCombinationReversed = Staff::where('family_name', 'LIKE', '%' . $combination[1] . '%')
                ->where('given_name', 'like', '%' . $combination[0] . '%')
                ->get();
            if ($staffNameCombinationReversed->count() >= 1) {
                return $staffNameCombinationReversed;
            }
        }

        return Staff::where('given_name', 'like', '%' . $phrase . '%')->get();
    }

    public function emptyModel()
    {
        $user = new User();
        $staff = new Staff();
        $staff->user = $user;

        return $staff;
    }

    public function withoutIdReport()
    {   
        return Staff::where('za_id_number', '')
                ->get();
    }

    public function invalidIdReport()
    {
        $validator = new \App\Validators\IDValidator();

        $staffMembers = Staff::all();

        $cstaffInvalid = [];

        foreach ($staffMembers as $staff) {
            if ($staff->za_id_number !== '') {
                if (!$validator->externalValidate($staff->za_id_number)) {
                    $staffInvalid[] = $staff;
                }
            }
        }

        return collect($staffInvalid);
    }

    public function externalAll()
    {
        return DB::table('staff')
                    ->join('users', 'staff.user_id', '=', 'users.id')
                    ->whereNotNull('username')
                    ->select(DB::raw('staff.id,
                                    staff.did,
                                    staff.za_id_number,
                                    staff.family_name,
                                    staff.given_name,
                                    staff.principle,
                                    staff.practitioner,
                                    staff.volunteer,
                                    staff.cook,
                                    staff.other,
                                    staff.registration_latitude,
                                    staff.registration_longitude,
                                    staff.ecd_qualification_id,
                                    staff.centre_id,
                                    staff.user_id,
                                    staff.created_at,
                                    staff.updated_at,
                                    staff.gender,
                                    staff.citizenship,
                                    staff.date_of_birth,
                                    users.username as mobile_number'))
                    ->get();
    }
}
