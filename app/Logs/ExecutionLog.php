<?php

namespace App\Logs;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExecutionLog extends Model
{
    public static function storeLog($log, $data){
        $log->ended_at = Carbon::now();
        $log->status   = $data[0];
        $log->output   = $data[1];
        $log->save();
    }
    
    public static function initializeLog($action) {
        $log = new ExecutionLog();
        $log->started_at = Carbon::now();
        $log->action_id  = $action->id;
        $log->job_id     = $action->job_id;
        
        return $log;
    }
}
