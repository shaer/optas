<?php
namespace App\Actions;

use App\Jobs\Job;

class ActionRunHandler {
    public function runActions($job_id) {
        $job = Job::with('actions','actions.triggerable')->get();
        
        foreach($job[0]->actions as $action) {
            $runner = $action->getTriggerableType()->getRunner();
            $runner->run($action);
        }
    }
}