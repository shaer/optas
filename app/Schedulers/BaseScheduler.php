<?php

namespace App\Schedulers;

abstract class BaseScheduler
{
    protected $schedule;
    
    public function __construct($schedule) {
        $this->schedule = $schedule;
    }
    
    public function build($data) {
        $should_run = !isset($data['should_run']) || $data['should_run'] == "T";
        $list       = isset($data['list']) ? $data['list'] : [];
        return $this->runBuilder($list, $should_run);
    }
    
    protected abstract function runBuilder($list, $should_run);

    protected function _buildExpression($index, $expression){
        if(is_array($expression)) {
            $expression = implode(",", $expression);
        }
        
        $cron = explode(" ", $this->schedule->getExpression());
        $cron[$index] = $expression;
        
        return $this->schedule->setExpression(implode(" ", $cron));
    }
    
}

