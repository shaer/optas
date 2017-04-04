<?php

namespace App\Actions\Types;

use DB;
use Symfony\Component\Process\Process;
use Storage;

class QueryRunner extends Runner
{
    public function run($triggrable) {
        
        $data = [
            "connection" => [
                    strtolower($triggrable->connection->connectionType->name),
                    $triggrable->connection->name,
                    $triggrable->connection->host,
                    $triggrable->connection->user,
                    $triggrable->connection->password,
                ],
            "query" => [
                    $triggrable->query,
                    $triggrable->is_csv,
                ],
        ];
        
        $filename = uniqid();
        
        Storage::disk('tmp')->put($filename, serialize($data));
    
        $process = new Process("../perl/scripts/execute_query.pl $filename");
        $process->run();
        while ($process->isRunning()) {
            // waiting for process to finish
        }

        echo $process->getOutput();
        
    }
}