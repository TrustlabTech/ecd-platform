<?php

namespace App\Repositories\Implementations;

use DB;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Repositories\Implementations\AbstractEloquentRepository;
use App\Models\Centre;

class EloquentCentreRepository extends AbstractEloquentRepository implements CentreRepositoryInterface
{
    protected $model;

    public function __construct(Centre $model)
    {
        $this->model = $model;
    }

    public function update(array $centre, $id)
    {
        return Centre::findOrfail($id)->update($centre);
    }

    public function delete($id)
    {
        return Centre::findOrfail($id)->delete();
    }

    public function allFiltered()
    {
        return Centre::select('id', 'name')->get();
    }

    public function search($phrase)
    {
        $centresByName = Centre::where('name', 'like', '%' . $phrase . '%')->get();
        if ($centresByName->count() >= 1) {
            return $centresByName;
        }

        $centresByCcode = Centre::where('c_code', 'like', '%' . $phrase . '%')->get();
        if ($centresByCcode->count() >= 1) {
            return $centresByCcode;
        }

        return $centresByName;
    }

    public function emptyModel()
    {
        return new Centre();
    }

    public function externalAll()
    {
        return Centre::all();
    }

    public function summaryClassesChildren($centreId)
    {
        $centre = Centre::find($centreId);

        if ($centre === null) {
            return false;
        }

        $centreName = $centre->name;

        $classesCount = $centre->classes->count();

        $childrenCount = DB::table('children')
            ->join('centre_classes', 'children.centre_class_id', '=', 'centre_classes.id')
            ->where('centre_classes.centre_id', '=', $centreId)
            ->select('children.*')
            ->count();

        $summary = [
            'name' => $centreName,
            'classes' => $classesCount,
            'children' => $childrenCount
        ];

        return $summary;
    }

    public function getCentresForMaps()
    {
        return DB::table('centres')
            ->select('name', 'latitude', 'longitude')
            ->orderBy('name', 'asc')
            ->get();
    }
}
