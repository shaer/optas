<?php

namespace App\Http\Controllers;

use App\Jobs\JobRepository;
use App\Connections\ConnectionRepository;
use App\Actions\ActionRepository;

class JobController extends \App\Core\CrudController
{
    private $action;
    private $connections;
    
    public function __construct(JobRepository $job, ActionRepository $action, ConnectionRepository $connection) {
        $this->repository  = $job;
        $this->route_name  = "jobs";
        $this->actions     = $action;
        $this->connections = $connection;
    }
    
    public function index(){
        $data         = $this->repository->fetch();
        $action_types = $this->actions->getActionTypes();
        $connections  = $this->connections->getConnections();
        
        return view($this->route_name . '.index', [
            'data'         => $data,
            'action_types' => $action_types,
            'connections'  => $connections,
            'model'        => $this->repository->getModel(),
        ]);
    }
    
    public function show($id) {
        return response()->json($this->repository->fetch($id));
    }
}