<?php

namespace App\Jobs;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use ModelValidationTrait;
    
    protected $fillable = ['name','description','namespace','is_automated'];
    
    protected function loadRules() {
        $this->rules = array(
            'name' => 'required',
            'description' => '',
            'namespace' => 'required',
            'is_automated' => 'in:"T","F"',
            'created_by' => 'required|exists:users,id'
        );
    }
}


