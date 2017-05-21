<?php

namespace App\Accounts;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use ModelValidationTrait;
    
    protected $fillable = ['name', 'description', 'machine_name'];
    
    protected function loadRules() {
        $this->rules = array(
            'name' => 'required|unique:roles,name,' . $this->id,
            'machine_name' => 'required',
        );
    }
}
