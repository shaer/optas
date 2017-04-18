<?php

namespace App\Schedulers;

class Schedule
{
    private $expression = "* * * * *";
    private $constrains;
    private $job_id;
    private $raw_schedule;
    
    
    public function save(){
        $job_repository      = resolve('App\Jobs\JobRepository');
        $model               = $job_repository->getById($this->getJobId());
        $model->raw_schedule = $this->getRawSchedule();
        $model->schedule     = $this->getExpression();
        $model->save();
        
        $constrains = [];
        foreach($this->getAllConstrains() as $key => $value) {
            $constrains[] = [
                    "job_id" => $this->getJobId(),
                    "key"    => $key,
                    "value"  => $value
                ];
        }
        
        ScheduleConstrain::insert($constrains);
    }
    
    public function getJobId() {
        return $this->job_id;
    }
    
    public function setJobId($id) {
        $this->job_id = $id;
    }
    
    public function getRawSchedule() {
        return $this->raw_schedule;
    }
    
    public function setRawSchedule($data) {
        $this->raw_schedule = $data;
    }
    
    public function getExpression() {
        return $this->expression;
    }
    
    public function setExpression($expression) {
        $this->expression = $expression;
    }
    
    public function addConstrain($key, $value) {
        $this->constrains[$key] = $value;
    }
    
    public function getAllConstrains() {
        return $this->constrains;
    }
    
    public function checkConstrain($key) {
        return isset($this->constrains[$key]);
    }
}


