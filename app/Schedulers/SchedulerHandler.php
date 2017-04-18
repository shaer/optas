<?php

namespace App\Schedulers;

class SchedulerHandler
{
    public static function getObject($type, $schedule) {
        switch ($type) {
            case "weekly":
                return new WeeklySchedule($schedule);
                break;
            case "spmd":
                return new DailySchedule($schedule);
                break;
            case "months":
                return new MonthlySchedule($schedule);
                break;
            case "everyday":
                return new DailySchedule($schedule);
                break;
            case "days":
                return new DateSchedule($schedule);
                
        }
    }
}


?>