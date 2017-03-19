<?php

namespace App\Http\Controllers;

use App\Jobs\JobRepository;

class JobController extends \App\Core\CrudController
{
    public function __construct(JobRepository $job) {
        $this->repository  = $job;
        $this->route_name  = "jobs";
    }
}