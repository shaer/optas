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
    
    public function saveGroupRoles($groups, $group_id) {
        $cached_groups = array();
        
        //we are going to update all the roles, so truncate
        if($group_id == null) {
            DB::table('role_user_group')->truncate();
        } 
        else if(empty($groups)) {
            //group id exists, but no groups so delete all for this group
            $this->requireById($group_id)->roles()->detach();
        }
        
        if(is_array($groups)) {
            foreach($groups as $group => $roles) {
                if(isset($cached_groups[$group])) {
                    $model == $cached_groups[$group];
                } else {
                    $model = $this->requireById($group);
                    $cached_groups[$group] = $model;
                    $this->requireById($group)->roles()->detach();
                }
                
                $model->roles()->attach($roles);
            }
        }
        
    }
    
    public function getUserGroups()
    {
        return $this->model->orderBy('name')->pluck('name', 'id');
    }
}
