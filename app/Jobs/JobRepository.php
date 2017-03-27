<?php

namespace App\Jobs;

use App\Core\BaseRepository;
use App\Actions\Action;
use Illuminate\Support\Facades\Auth;
use App\Core\Exceptions\EntityNotFoundException;
use DB;

class JobRepository extends BaseRepository
{
    public function __construct(Job $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        DB::beginTransaction();
        $job_model = $this->getNew($data);
        $job_model->created_by = Auth::user()->id;
        if(!parent::save($job_model)) return false;
        
        foreach($data['actions'] as $key => $action) {
            $action_model = new Action();
            $action_model->fill($action);
            
            $triggriable_model = $action_model->getTriggerableType($action['action_type_id']);
            $triggriable_model->fill($action['triggerable']);

            if(!parent::save($triggriable_model)) {
                return ["actions", "[$key][triggerable]",  $triggriable_model];
            }
            
            $action_model->triggerable()->associate($triggriable_model);
            $action_model->job()->associate($job_model);
            if(!parent::save($action_model)) {
                return ["actions", "[$key]",  $action_model];
            }
                
        }
        DB::commit();
        return true;
    }
    
    public function update($id, $data) {
        $action_repository = resolve('App\Actions\ActionRepository');
        
        DB::beginTransaction();
        if(!parent::update($id, $data)) return false; 
        
        $job = parent::getById($id);
        
        //delete all actions if actions arary is emtpy
        //delete all actions that don't exists in the sent array
        
        foreach($data['actions'] as $key => $action) {
            //make sure that this action belongs to this job
            $action_id = substr($key, 7);
            $action_object = $job->actions()->find($action_id);
            if(!$action_object) {
                throw new EntityNotFoundException;
            }
                
            $action_object = $action_object->fill($action);
            if(!$action_repository->save($action_object)) {
                return ["actions", "[$key]", $action_object];
            }
            
            $triggrable = $action_object->triggerable->fill($action['triggerable']);
            if(!$action_repository->save($triggrable)) {
                return ["actions", "[$key][triggerable]",  $triggrable];
            }
        }

        DB::commit();
        return true;
    }
    
    public function fetch($id = false) {
        if($id) {
            return $this->model->with('actions.triggerable')->find($id);
        }
        
        return Job::with('actions.triggerable')->get();
    }
}