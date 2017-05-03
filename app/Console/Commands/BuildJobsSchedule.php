<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\JobRepository;

class BuildJobsSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:build';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the daily schedule of all jobs';
    
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
        $this->repository->calculateJobRunTime();
    }
}
