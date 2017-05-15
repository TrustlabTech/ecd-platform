<?php

namespace App\Repositories\Implementations;

use App\Repositories\Implementations\AbstractEloquentRepository;
use App\Repositories\Interfaces\CentreClassRepositoryInterface;
use App\Models\CentreClass;
use DB;

class EloquentCentreClassRepository extends AbstractEloquentRepository implements CentreClassRepositoryInterface
{
    protected $model;

    public function __construct(CentreClass $model)
    {
        $this->model = $model;
    }

    public function byCentre($id)
    {
        return CentreClass::where('centre_id', $id)->get();
    }

    public function allWithCentreName()
    {
        return DB::table('centre_classes')
                    ->join('centres', 'centre_classes.centre_id', '=', 'centres.id')
                    ->select(DB::raw('CONCAT(centres.name, " - ", centre_classes.name) as name, centre_classes.id'))
                    ->lists('name', 'id');
    }

    public function search($phrase)
    {
        $centreClassByName = CentreClass::where('name', 'like', '%' . $phrase . '%')->get();
        if ($centreClassByName->count() >= 1) {
            return $centreClassByName;
        }

        $centreClassByCentre = CentreClass::whereHas('centre', function ($query) use ($phrase) {
            $query->where('name', 'like', '%' . $phrase . '%');
        })->get();
        if ($centreClassByCentre->count() >= 1) {
            return $centreClassByCentre;
        }

        return CentreClass::where('name', 'like', '%' . $phrase . '%')->get();
    }

    public function externalAll()
    {
        return CentreClass::all();
    }
}
