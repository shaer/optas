<?php

namespace App\Accounts;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use ModelValidationTrait;
    
    protected $fillable = ['name', 'description'];
    
    protected function loadRules() {
        $this->rules = array(
            'name' => 'required',
        );
    }
}
