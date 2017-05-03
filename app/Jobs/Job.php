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
    
    public function actions(){
        return $this->hasMany('App\Actions\Action');
    }
    
    public function schedule_constrains(){
        return $this->hasMany('App\Schedulers\ScheduleConstrain');
    }
    
    public function action_handlers()
    {
        return $this->hasManyThrough('App\Actions\Types\DbAction', 'App\Actions\Action');
    }
    //R = Running, F= Failure, S=Success, P=Pending
    public function updateStatus($status) {
        $this->job_status = $status;
        return $this->save();
    }
}


