<?php

namespace App\Accounts;

use App\Core\BaseRepository;
use DB;

class UserGroupRepository extends BaseRepository
{
    public function __construct(UserGroup $model)
    {
        $this->model = $model;
    }
    
    public function getGroups($id) {
        if($id == null) {
            return $this->getAll();
        }
        
        return [$this->requireById($id)];
    }
    
    public function delete($model) {
        if($model->group_type == 0) {
            return false;
        }
        
        return parent::delete($model);
    }
    
    public function update($id, $data) {
        $model = $this->requireById($id);
        
        if($model->group_type == 0) {
            return false;
        }
        
        return parent::update($id, $data); 
    }
    
    public function saveGroupRoles($data) {
        foreach($data['groups'] as $group) {
            $group_roles = isset($data['roles'][$group]) ? $data['roles'][$group] : array();
            $this->handleGroupRoles($group, $group_roles);
        }
    }
    
    public function handleGroupRoles($group_id, $roles) {
        $group = $this->requireById($group_id);
        
        if(empty($roles)) {
            return $group->roles()->detach();
        }
        
        return $group->roles()->sync($roles);
    }
    
    public function getUserGroups()
    {
        return $this->model->orderBy('name')->pluck('name', 'id');
    }
}
