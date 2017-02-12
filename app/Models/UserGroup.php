<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }
}
