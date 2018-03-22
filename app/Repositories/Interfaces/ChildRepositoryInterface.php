<?php

namespace App\Repositories\Interfaces;

interface ChildRepositoryInterface
{
    public function find($id);

    public function all();

    public function paginate($number);

    public function create(array $child);

    public function update(array $child, $id);

    public function delete($id);

    public function byClass($id, $order);

    public function existsbyId($id);

    public function search($phrase);

    public function withoutIdReport();

    public function invalidIdReport();

    public function emptyModel();

    public function forList();

    public function externalAll();
}
