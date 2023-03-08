<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @param Model $model
     * @return mixed
     */
    public function setModel(Model $model);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function findByAttributes(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function findAllByAttributes(array $attributes);

    public function create(array $attributes);

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);
}
