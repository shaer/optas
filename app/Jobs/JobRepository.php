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
        
        $output = $this->_saveActions($data['actions'], $job_model, false);
        if($output !== true) {
            return $output;
        }
            
        DB::commit();
        return true;
    }
    
    public function update($id, $data) {

        DB::beginTransaction();
        if(!parent::update($id, $data)) return false; 
        
        $job = parent::getById($id);
        
        if(empty($data['actions'])) {
            $job->actions()->delete();
        } else {
            $provided_actions = array_map(function($key) { return substr($key, 7); }, array_keys($data['actions']));
            $current_actions  = $job->actions()->pluck('id')->toArray();
            $items_to_delete  = array_diff($current_actions, $provided_actions);
            
            if(!empty($items_to_delete)) {
                DB::table('actions')->whereIn('id', $items_to_delete)->delete(); 
            }
            
            $output = $this->_saveActions($data['actions'], $job, true);
            if($output !== true) {
                return $output;
            }
        }

        DB::commit();
        return true;
    }
    
    private function _saveActions($actions, $job, $is_udpate = false) {
        $action_repository = resolve('App\Actions\ActionRepository');
        
        foreach($actions as $key => $action) {
            //sometimes when we are updating a job, w need to add new actions.
            $is_new_action = !$is_udpate;
            //load action model from job if update.
            if($is_udpate) {
                $action_update = true;
                $action_id = substr($key, 7);
                $action_model = $job->actions()->find($action_id);
                if(!$action_model) {
                    $is_new_action = true;
                }
            } 
            
            if($is_new_action) {
                //else create new model
                $action_model = new Action();
            }
            
            $action_model = $action_model->fill($action);
            
            if($is_new_action) {
                $triggrable = $action_model->getTriggerableType();
            } else {
                $triggrable = $action_model->triggerable;
            }
        
            $triggrable->fill($action['triggerable']);
        
            if(!$action_repository->save($triggrable)) {
                return ["actions", "[$key][triggerable]",  $triggrable];
            }
            
            //if these are a new objects, add the associations
            if($is_new_action) {
                $action_model->triggerable()->associate($triggrable);
                $action_model->job()->associate($job);
            }
        
            if(!$action_repository->save($action_model)) {
                return ["actions", "[$key]", $action_model];
            }
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