<?php

namespace App\Repositories\Interfaces;

interface CentreClassRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $centreClass);

    public function update(array $centreClass, $id);

    public function delete($id);

    public function byCentre($id);

    public function allWithCentreName();

    public function search($phrase);

    public function emptyModel();

    public function externalAll();
}
