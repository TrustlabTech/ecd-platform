<?php

namespace App\Repositories\Interfaces;

interface AdminRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $admin);

    public function update(array $admin, $id);

    public function delete($id);

    public function emptyModel();
}
