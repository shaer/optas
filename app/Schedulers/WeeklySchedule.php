<?php

namespace App\Schedulers;

class WeeklySchedule extends BaseScheduler
{
    const CRON_INDEX = 4; 
    private $weekdays = [0, 1, 2, 3, 4, 5, 6];

    protected function runBuilder($list, $should_run) {
        
        $days = array_intersect($this->weekdays, $list);

        if($should_run) {
            return $this->_buildExpression(self::CRON_INDEX, $days);
        }
        
        //N = weekday 1=Monday, 7=Sunday
        return $this->schedule->addConstrain("N", implode(",", $days));
    }
}


