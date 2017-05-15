<?php

namespace App\Repositories\Interfaces;

interface CentreRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $centre);

    public function update(array $centre, $id);

    public function delete($id);

    public function allFiltered();

    public function search($phrase);

    public function emptyModel();

    public function externalAll();

    public function summaryClassesChildren($centreId);

    public function getCentresForMaps();
}
