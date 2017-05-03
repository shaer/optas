<?php
namespace App\Actions;

use App\Jobs\Job;
use Carbon\Carbon;

class ActionRunHandler {
    public function runActions($job_id) {
        $job = Job::with('actions','actions.triggerable')->find($job_id);
        $job->started_at = Carbon::now();
        $job->updateStatus("R");
        $status = "S";
        
        foreach($job->actions as $action) {
            $runner = $action->getTriggerableType()->getRunner();
            if(!$runner->run($action)) {
                $status = "F";
                break;
            }
        }
        
        $job->ended_at = Carbon::now();
        $job->updateStatus($status);
        
        //TO-DO: retrieve job next run schedule.
        
        return $status == "S";
    }
}