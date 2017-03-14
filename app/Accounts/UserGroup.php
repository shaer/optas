<?php

namespace App\Accounts;

use App\Core\BaseModel;

class UserGroup extends BaseModel
{
    protected $fillable = ['name', 'description'];
    
    protected $rules = [
        'name' => 'required',
    ];
    public function roles(){
        return $this->belongsToMany('App\Accounts\Role');
    }
    
    public function hasRole($id){
        return !empty($this->roles->find($id));
    }
}
