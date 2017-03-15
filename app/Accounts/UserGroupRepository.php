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
        $model = $this->repository->requireById($id);
        
        if($model->group_type == 0) {
            return false;
        }
        
        return parent::update($id, $data); 
    }
    
    public function saveGroupRoles($groups, $user_id) {
        if(empty($groups)) {
            if($user_id == null) {
                DB::table('role_user_group')->truncate();
            } else {
                $this->requireById($user_id)->roles()->detach();
            }
            return true;
        }
        
        DB::table('role_user_group')->truncate();
        foreach($groups as $group => $roles) {
            $model = $this->requireById($group);
            $model->roles()->attach($roles);
        }
    }
}