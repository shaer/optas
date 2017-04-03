<?php

namespace App\Accounts;

use App\Core\BaseRepository;
use App\Helpers\Helper;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    
    public function delete($model) {
        if($model->role_type == 0) {
            return false;
        }
        
        return parent::delete($model);
    }
    
    public function save($data) {
        $data['machine_name'] = Helper::tokenize($data['name']);
        return parent::save($data);
    }
    
    public function update($id, $data) {
        $model = $this->repository->requireById($id);
        
        if($model->role_type == 0) {
            return false;
        }
        
        $data['machine_name'] = Helper::tokenize($data['name']);
        return parent::update($id, $data); 
    }
}