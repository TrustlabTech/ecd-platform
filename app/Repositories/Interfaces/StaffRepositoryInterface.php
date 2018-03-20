<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $staff);

    public function update(array $staff, $id);

    public function delete($id);

    public function search($phrase);

    public function withoutIdReport();

    public function invalidIdReport();

    public function emptyModel();

    public function externalAll();
}
