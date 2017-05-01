<?php

namespace App\Jobs;

use App\Core\BaseRepository;
use App\Actions\Action;
use Illuminate\Support\Facades\Auth;
use App\Core\Exceptions\EntityNotFoundException;
use DB;
use App\Schedulers\SchedulerHandler;
use App\Schedulers\Schedule;

class JobRepository extends BaseRepository
{
    public function __construct(Job $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        DB::beginTransaction();
        $this->model = $this->getNew($data);
        $this->model->created_by = Auth::user()->id;
        
        if(!parent::save($this->model)) return false;
        
        if(isset($data['scheduler']) && !empty(isset($data['scheduler']))) {
            $this->_processSchedulerData($data['scheduler']);
        }
        
        if(isset($data['actions']) && !empty(isset($data['actions']))) {
            $output = $this->_saveActions($data['actions'], $this->model, false);
            
            if($output !== true) {
                return $output;
            }
        }
        
        DB::commit();
        return true;
    }
    
    public function update($id, $data) {

        DB::beginTransaction();
        if(!parent::update($id, $data)) return false; 
        
        $this->model = parent::getById($id);
        
        if(isset($data['scheduler']) && !empty(isset($data['scheduler']))) {
            $this->_processSchedulerData($data['scheduler']);
        }
        
        if(empty($data['actions'])) {
            $this->model->actions()->delete();
        } else {
            $provided_actions = array_column($data['actions'], "id");
            $current_actions  = $this->model->actions()->pluck('id')->toArray();
            $items_to_delete  = array_diff($current_actions, $provided_actions);
            
            if(!empty($items_to_delete)) {
                DB::table('actions')->whereIn('id', $items_to_delete)->delete(); 
            }
            
            $output = $this->_saveActions($data['actions'], true);
            if($output !== true) {
                return $output;
            }
        }

        DB::commit();
        return true;
    }
    
    private function _processSchedulerData($scheduler){
        $schedule = new Schedule();
        foreach($scheduler as $key => $single) {
            if(isset($single['exists']) && $single['exists'] == "T") {
                $object = SchedulerHandler::getObject($key, $schedule);
                $object->build($single);
            }
        }

        $schedule->setJob($this->model);
        $schedule->setRawSchedule(serialize($scheduler));
        return $schedule->save();
    }
    
    private function _saveActions($actions, $is_udpate = false) {
        $action_repository = resolve('App\Actions\ActionRepository');
        
        foreach($actions as $key => $action) {
            //sometimes when we are updating a job, w need to add new actions.
            $is_new_action = !$is_udpate;
            //load action model from job if update.
            if($is_udpate) {
                $action_update = true;
                $action_id = $action['id'];
                $action_model = $this->model->actions()->find($action_id);
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
                $action_model->job()->associate($this->model);
            }
        
            if(!$action_repository->save($action_model)) {
                return ["actions", "[$key]", $action_model];
            }
        }
        
        return true;
    }
    
    public function fetch($id = false) {
        if($id) {
            $model = $this->model->with('actions.triggerable')->find($id);
            if(isset($model->raw_schedule)) {
                $model->scheduler = unserialize($model->raw_schedule);
            }
            return $model;
        }
        
        return Job::with('actions.triggerable')->get()->keyBy("id");
    }
}