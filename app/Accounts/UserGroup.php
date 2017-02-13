<?php

namespace App\Accounts;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public function roles(){
        return $this->belongsToMany('Role');
    }
}
