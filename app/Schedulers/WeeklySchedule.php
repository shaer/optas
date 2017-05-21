<?php

namespace App\Schedulers;

use App\Core\Exceptions\InvalidScheduleException;

class WeeklySchedule extends BaseScheduler
{
    const CRON_INDEX = 4; 
    private $weekdays = [0, 1, 2, 3, 4, 5, 6];

    protected function runBuilder($list, $should_run) {
        
        if(count(array_diff($list, $this->weekdays)) > 0) {
            throw new InvalidScheduleException();
        }
        
        if($should_run) {
            $days = array_intersect($this->weekdays, $list);
            return $this->_buildExpression(self::CRON_INDEX, $days);
        } else {
            $diff_days = array_diff($this->weekdays, $list);
            return $this->_buildExpression(self::CRON_INDEX, $diff_days);
        }
    }
}


