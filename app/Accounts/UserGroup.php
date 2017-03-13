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
        return $this->belongsToMany('Role');
    }
}
