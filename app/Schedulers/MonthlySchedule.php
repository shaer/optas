<?php

namespace App\Schedulers;

class MonthlySchedule extends BaseScheduler
{
    const CRON_INDEX = 3; 
    private $months;

    protected function runBuilder($list, $should_run) {
        $this->months = range(1,12);
        
        if($should_run) {
            $run_months = array_intersect($this->months, $list);
            return $this->_buildExpression(self::CRON_INDEX, $run_months);
        } else {
            $diff_months = array_diff($this->months, $list);
            return $this->_buildExpression(self::CRON_INDEX, $diff_months);
        }
        
        //n for months
        //return $this->schedule->addConstrain("n", implode(",", $run_months));
    }
}


