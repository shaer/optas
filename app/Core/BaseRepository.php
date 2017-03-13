<?php

namespace App\Core;

use App\Core\Exceptions\EntityNotFoundException;

class BaseRepository
{
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }
    
    public function getModel()
    {
        return $this->model;
    }
    
    public function setModel($model)
    {
        $this->model = $model;
    }
    
    public function getAll()
    {
        return $this->model->all();
    }
    
    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }
    
    public function getById($id)
    {
        return $this->model->find($id);
    }
    
    public function requireById($id)
    {
        $model = $this->getById($id);
        if ( ! $model) {
            throw new EntityNotFoundException;
        }
        return $model;
    }
    
    public function update($id, $data)
    {
        $this->model = $this->requireById($id);
        $this->model->fill($data);
        return $this->storeEloquentModel($this->model);
    }
    
    public function getNew($attributes = [])
    {
        $model = $this->model->newInstance($attributes);
        $model->fill($attributes);
        return $model;
    }
    
    public function save($data)
    {
        if ($data instanceOf BaseModel) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }
    
    public function delete($model)
    {
        return $model->delete();
    }
    
    protected function storeEloquentModel($model)
    {
        if(!$model->validate($model->getAttributes())) {
            return false;
        }

        if ($model->getDirty()) {
            return $model->save(); 
        } else {
            return $model->touch();
        }
    }
    
    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        $this->model = $model;
        return $this->storeEloquentModel($model);
    }
}