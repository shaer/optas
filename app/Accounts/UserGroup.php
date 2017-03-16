<?php

namespace App\Accounts;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    
    use ModelValidationTrait;
    
    protected $fillable = ['name', 'description'];
    
    protected function loadRules() {
        $this->rules = array(
            'name' => 'required',
        );
    }
    
    public function roles(){
        return $this->belongsToMany('App\Accounts\Role');
    }
    
    public function hasRole($id){
        return !empty($this->roles->find($id));
    }
}
