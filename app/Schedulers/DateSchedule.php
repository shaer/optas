<?php

namespace App\Schedulers;

class DateSchedule extends BaseScheduler
{
    private $month_days;
    private $run_days;
    
    protected function runBuilder($list, $should_run) {
        if($should_run) {
            return $this->schedule->addConstrain("date_run", implode($list, ","));
        }
        
        $this->schedule->addConstrain("date_skip", $list);
    }
}


