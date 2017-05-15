<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\RepositoryInterface;

abstract class AbstractEloquentRepository implements RepositoryInterface
{
    /**
     * @param array $models
     * @return mixed
     */
    public function make(array $models = [])
    {
        if (!empty($models)) {
            return $this->model->with($models);
        }

        return $this->model;
    }

    /**
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function find($id, $relations = [])
    {
        return $this->make($relations)->findOrFail($id);
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function all($relations = [])
    {
        return $this->make($relations)->get();
    }

    /**
     * @param $number
     * @return mixed
     */
    public function paginate($number)
    {
        return $this->model->paginate($number);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        return $this->model->findOrfail($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * @return mixed
     */
    public function emptyModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function createModel(array $data = [])
    {
        if (!empty($data)) {
            return new $this->model($data);
        }

        return $this->model;
    }
}
