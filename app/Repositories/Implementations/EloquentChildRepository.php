<?php

namespace App\Repositories\Implementations;

use App\Repositories\Implementations\AbstractEloquentRepository;
use App\Repositories\Interfaces\ChildRepositoryInterface;
use App\Models\Child;
use DB;

class EloquentChildRepository extends AbstractEloquentRepository implements ChildRepositoryInterface
{
    protected $model;

    public function __construct(Child $model)
    {
        $this->model = $model;
    }

    public function byClass($id, $order)
    {
        if ($order === 'asc' || $order === 'desc') {
            return Child::where('centre_class_id', $id)
                ->orderBy('given_name', $order)
                ->orderBy('family_name', $order)
                ->get();
        }

        return false;
    }

    public function byCenter($id, $order) {
        if ($order === 'asc' || $order === 'desc') {
            return Child::where('centreClass.center.id', $id)
                ->orderBy('given_name', $order)
                ->orderBy('family_name', $order)
                ->get();
        }

        return false;
    }

    public function existsbyId($id)
    {
        return Child::where('id_number', $id)->get()->count() > 0;
    }

    public function search($phrase)
    {
        $combination = preg_split('/\s+/', $phrase);

        if (count($combination) === 1) {
            $childByGivenName = Child::where('given_name', 'like', '%' . $phrase . '%')->get();
            if ($childByGivenName->count() >= 1) {
                return $childByGivenName;
            }

            $childByFamilyName = Child::where('family_name', 'like', '%' . $phrase . '%')->get();
            if ($childByFamilyName->count() >= 1) {
                return $childByFamilyName;
            }

            $childByZAId = Child::where('id_number', 'like', '%' . $phrase . '%')->get();
            if ($childByZAId->count() >= 1) {
                return $childByZAId;
            }

            $childByCentreClass = Child::whereHas('centreClass', function ($query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->get();
            if ($childByCentreClass->count() >= 1) {
                return $childByCentreClass;
            }

            $childByCentre = Child::whereHas('centreClass.centre', function ($query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->get();
            if ($childByCentre->count() >= 1) {
                return $childByCentre;
            }
        } elseif (count($combination) >= 2) {
            $childNameCombination = Child::where('family_name', 'LIKE', '%' . $combination[0] . '%')
                ->where('given_name', 'like', '%' . $combination[1] . '%')
                ->get();
            if ($childNameCombination->count() >= 1) {
                return $childNameCombination;
            }

            $childNameCombinationReversed = Child::where('family_name', 'LIKE', '%' . $combination[1] . '%')
                ->where('given_name', 'like', '%' . $combination[0] . '%')
                ->get();
            if ($childNameCombinationReversed->count() >= 1) {
                return $childNameCombinationReversed;
            }

            $childByCentreClass = Child::whereHas('centreClass', function ($query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->get();
            if ($childByCentreClass->count() >= 1) {
                return $childByCentreClass;
            }

            $childByCentre = Child::whereHas('centreClass.centre', function ($query) use ($phrase) {
                $query->where('name', 'like', '%' . $phrase . '%');
            })->get();
            if ($childByCentre->count() >= 1) {
                return $childByCentre;
            }
        }

        return Child::where('given_name', 'like', '%' . $phrase . '%')->get();
    }

    public function withoutIdReport()
    {
        return Child::where('id_number', '')
                ->get();
    }

    public function invalidIdReport()
    {
        $validator = new \App\Validators\IDValidator();

        $children = Child::all();

        $childrenInvalid = [];

        foreach ($children as $child) {
            if ($child->id_number !== '') {
                if (!$validator->externalValidate($child->id_number)) {
                    $childrenInvalid[] = $child;
                }
            }
        }

        return collect($childrenInvalid);
    }

    public function forList()
    {
        return DB::table('children')
            ->select(DB::raw('CONCAT(family_name, " ", given_name) as name, id'))
            ->lists('name', 'id');
    }

    public function externalAll()
    {
        return Child::all();
    }

    public function allRaces()
    {
        // Hardcoded, since these are declared as an enum
        // field via the AddRaceFieldToChildrenTable migration
        return [
            'Black' => 'Black',
            'Coloured' => 'Coloured',
            'White' => 'White',
            'Indian' => 'Indian',
            'Foreigner' => 'Foreigner'
        ];
    }
}
