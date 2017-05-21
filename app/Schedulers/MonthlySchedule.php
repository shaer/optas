<?php

namespace App\Schedulers;

use App\Core\Exceptions\InvalidScheduleException;

class MonthlySchedule extends BaseScheduler
{
    const CRON_INDEX = 3; 
    private $months;

    protected function runBuilder($list, $should_run) {
        $this->months = range(1,12);
        
        if(count(array_diff($list, $this->months)) > 0) {
            throw new InvalidScheduleException();
        }
        
        if($should_run) {
            $run_months = array_intersect($this->months, $list);
            return $this->_buildExpression(self::CRON_INDEX, $run_months);
        } else {
            $diff_months = array_diff($this->months, $list);
            return $this->_buildExpression(self::CRON_INDEX, $diff_months);
        }
    }
}


