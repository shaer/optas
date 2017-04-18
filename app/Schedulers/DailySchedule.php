<?php

namespace App\Schedulers;

class DailySchedule extends BaseScheduler
{
    const CRON_INDEX = 2; 
    private $month_days;
    private $run_days;
    
    protected function runBuilder($list, $should_run) {
        $this->month_days = range(1,31);
        
        $days = array_intersect($this->month_days, $list);
        
        if($should_run) {
            if(empty($days)) {
                $days = "*";
            }
            
            return $this->_buildExpression(self::CRON_INDEX, $days);
        }
        
        //j for month day
        return $this->schedule->addConstrain("j", implode(",", $days));
    }
}


