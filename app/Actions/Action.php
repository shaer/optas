<?php

namespace App\Actions;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    
    protected $fillable = ['action_type_id', 'name'];

    use ModelValidationTrait;

    protected function loadRules() {
        $this->rules = array(
            'action_type_id' => 'required|exists:action_types,id',
            'job_id' => 'required|exists:jobs,id',
        );
    }
    
    public function job()
    {
        return $this->belongsTo('App\Jobs\Job');
    }
    
    public function triggerable()
    {
        return $this->morphTo();
    }
    
    public function getTriggerableType() {
        switch ($this->action_type_id) {
            case 1:
                return new Types\DbAction();
                break;
                
            
            default:
                throw new Exception("Not Implemented");
                break;
        }
    }
    
    public function updateStatus($status) {
        $this->action_status = $status;
        return $this->save();
    }
}





