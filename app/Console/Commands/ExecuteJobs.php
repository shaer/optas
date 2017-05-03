<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\Job;
use App\Jobs\JobRepository;
use Symfony\Component\Process\Process;
use App\Actions\ActionRunHandler;

class ExecuteJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:execute {jobId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute jobs as per their current schedule time';

    
    private $repository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(JobRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        if($this->argument('jobId') == "all") {
            $date = date("Y-m-d");
            $jobs = Job::where([
                    ['job_status', '<>', 'R'],
                    ['is_automated', 'T']
                ])->whereRaw("date(next_run_date) = '$date'")->get();
            
            foreach($jobs as $job) {
                $process[$job->id] = new Process("php artisan jobs:execute {$job->id}");
                $process[$job->id]->start();
            }
            
            if(!empty($process)) {
                foreach($process as $key => $single) {
                    while ($single->isRunning()) {
                        usleep(50000);
                    }
                    unset($process[$key]);
                }
            }
            
            return;
            
        } else {
            $action = new ActionRunHandler();
            var_dump($action->runActions($this->argument('jobId')));
        }
    }
}
