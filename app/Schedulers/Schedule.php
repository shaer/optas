<?php

namespace App\Schedulers;

class Schedule
{
    private $expression = "0 0 * * *";
    private $constrains;
    private $job;
    private $raw_schedule;
    
    
    public function save(){
        $model               = $this->getJob();
        $model->raw_schedule = $this->getRawSchedule();
        $model->schedule     = $this->getExpression();
        $model->save();
        
        $constrains = [];
        
        if(empty($this->getAllConstrains()))
            return;
            
        foreach($this->getAllConstrains() as $key => $value) {
            $constrains[] = [
                    "job_id" => $this->getJob()->id,
                    "key"    => $key,
                    "value"  => $value
                ];
        }
        
        ScheduleConstrain::insert($constrains);
    }
    
    public function getJob() {
        return $this->job;
    }
    
    public function setJob($job) {
        $this->job = $job;
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


