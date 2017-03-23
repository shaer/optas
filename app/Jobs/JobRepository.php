<?php

namespace App\Jobs;

use App\Core\BaseRepository;
use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class JobRepository extends BaseRepository
{
    public function __construct(Job $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        $save_flag = true;
        $job_model = $this->getNew($data);
        $job_model->created_by = Auth::user()->id;
        $save_flag = parent::save($job_model);
        if(!$save_flag) return $save_flag;
        
        foreach($data['actions'] as $action) {
            $action_model = new Action();
            $action_model->fill($action);
            
            $triggriable_model = $action_model->getTriggerableType($action['action_type_id']);
            $triggriable_model->fill($action['triggerable']);
            $triggriable_model->save();
            $save_flag = parent::save($triggriable_model);
            if(!$save_flag) return $save_flag;
            
            $action_model->triggerable()->associate($triggriable_model);
            $action_model->job()->associate($job_model);
            $save_flag = parent::save($action_model);
            if(!$save_flag) return $save_flag;
        }
        
        return true;
    }
    
    public function fetch($id = false) {
        if($id) {
            return $this->model->with('actions.triggerable')->find($id);
        }
        
        return Job::with('actions.triggerable')->get();
    }
}