<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Set associated model
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function setSelect(array $columns = ['*'])
    {
        $this->model = $this->model->select($columns);
        return $this;
    }

    public function setGroup(array $columns = ['*'])
    {
        $this->model = $this->model->groupBy($columns);
        return $this;
    }

    public function clearBindings()
    {
        $this->model->latest()->getQuery()->wheres = [];
        $this->model->latest()->getQuery()->bindings['select'] = [];
        $this->model->latest()->getQuery()->bindings['where'] = [];
        $this->model->latest()->getQuery()->bindings['groupBy'] = [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get the first model result based on attributes
     * @param array $attributes
     * @return mixed
     */
    public function findByAttributes(array $attributes)
    {
        $this->clearBindings();
        foreach ($attributes as $column => $value) {
            $this->model = $this->model->where($column, $value);
        }

        return $this->model->first();
    }

    /**
     * Get all model results based on attributes
     * @param array $attributes
     * @return mixed
     */
    public function findAllByAttributes(array $attributes)
    {
        $this->clearBindings();
        foreach ($attributes as $column => $value) {
            $this->model = $this->model->where($column, $value);
        }

        return $this->model->get();
    }

    /**
     * Create a new model instance
     * @param array $attributes
     * @return Builder|Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        return $this->model->findOrfail($id)->update($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreate($id, array $attributes)
    {
        return $this->model->updateOrCreate(['id' => $id], $attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateAndReturn($id, array $attributes)
    {
        return tap($this->model->findOrfail($id))->update($attributes);
    }
}
