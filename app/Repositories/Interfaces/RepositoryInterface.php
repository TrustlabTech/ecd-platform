<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function find($id, $relations = []);

    public function all($relations = []);

    public function paginate($number);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function emptyModel();

    public function createModel(array $data = []);
}
