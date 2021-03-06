<?php

namespace App\Http\Controllers;

use App\Jobs\JobRepository;
use App\Connections\ConnectionRepository;
use App\Actions\ActionRepository;
use Illuminate\Http\Request;
use Auth;

class JobController extends \App\Core\CrudController
{
    private $action;
    private $connections;
    private $request;
    
    public function __construct(Request $request, JobRepository $job, ActionRepository $action, ConnectionRepository $connection) {
        $this->repository  = $job;
        $this->route_name  = "jobs";
        $this->actions     = $action;
        $this->connections = $connection;
        $this->request     = $request;
    }
    
    public function index(){
        $data            = $this->repository->fetch();
        $action_types    = $this->actions->getActionTypes();
        $connections     = $this->connections->getConnections();
        $roles['edit']   = Auth::user()->hasRole("edit_" . $this->route_name);
        $roles['delete'] = Auth::user()->hasRole("delete_" . $this->route_name);
        $roles['add']    = Auth::user()->hasRole("add_" . $this->route_name);
        
        if($this->request->wantsJson()) {
            return $this->sendJsonOutput(200, [
                'jobs'         => $data,
                'action_types' => $action_types,
                'connections'  => $connections,
                'can'          => $roles,
            ]);
        }
        
        return redirect()->action('JobController@manage');
    }
    
    public function manage() {
        return view($this->route_name . '.index');
    }
    
    public function show($id) {
        return response()->json($this->repository->fetch($id));
    }
    
    public function store(Request $request)
    {
        $data    = $this->repository->save($request->except('_token'));
        if($data === true){
            return $this->sendJsonOutput(200, $this->repository->getModel());
        } else {
            $data = [$data[0], $data[1], $data[2]->errors()->toArray()];
            return $this->sendJsonOutput(400, $data);
        }
    }
    
    public function update(Request $request, $id) {
        $data = $this->repository->update($id, $request->except(['_method','_token']));
        if($data === true) {
            return $this->sendJsonOutput(200, $this->repository->getModel());
        } else {
            $data = [$data[0], $data[1], $data[2]->errors()->toArray()];
            return $this->sendJsonOutput(400, $data);
        }
        
        
    }
}