<?php

namespace App\Actions\Types;

use DB;
use Symfony\Component\Process\Process;
use Storage;
use App\Logs\ExecutionLog;

class QueryRunner extends Runner
{
    public function run($action) {
        $action->updateStatus("R");
        $log = ExecutionLog::initializeLog($action);
        
        $triggerable = $action->triggerable;
        
        $data = $this->loadTriggriableData($triggerable);
        
        $storage  = Storage::disk('output');
        $filename = uniqid();
        $tmp_filename = "tmp/" . $filename;
        $storage->put($tmp_filename, serialize($data));
        
        $result = $this->runQueryAction($filename, $log);
        
        if($result) {
            $action->updateStatus("S");
            if($storage->exists($tmp_filename)) {
                $storage->move($tmp_filename, "output/$filename.csv");
            }
        } else {
            $action->updateStatus("F");
        }

        return $result;
    }
    
    private function runQueryAction($filename, $log) {
        $process = new Process("../perl/scripts/execute_query.pl $filename");
        $process->run();

        if (!$process->isSuccessful()) {
            $message = $process->getErrorOutput();
            $status  = 'F';
        } else {
            $message = $process->getOutput();
            if ($message == "1") {
                $message = $filename;
            }
            $status  = 'S';
        }
        
        ExecutionLog::storeLog($log, [$status, $message]);
        
        return $process->isSuccessful();
    }
    
    private function loadTriggriableData($triggerable) {
        return $data = [
            "connection" => [
                    strtolower($triggerable->connection->connectionType->name),
                    $triggerable->connection->name,
                    $triggerable->connection->host,
                    $triggerable->connection->user,
                    $triggerable->connection->password,
                ],
            "query" => [
                    $triggerable->query,
                    $triggerable->is_csv,
                ],
        ];
        
    }
}