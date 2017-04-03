<?php

namespace App\Http\Controllers\Management;

use App\Connections\ConnectionRepository;
use App\Connections\ConnectionTypeRepository;
use Illuminate\Http\Request;
use App\Connections\Connection;
use Auth;

class ConnectionController extends \App\Core\CrudController
{
    private $conn_type;
    
    public function __construct(ConnectionRepository $connection, ConnectionTypeRepository $conn_type){
        $this->repository = $connection;
        $this->conn_type  = $conn_type;
        $this->route_name = "connections";
    }
    
    public function index()
    {
        $connections = $this->repository->getAll();
        $conn_types  = $this->conn_type->getConnectionTypes();
        $roles['edit']   = Auth::user()->hasRole("edit_" . $this->route_name);
        $roles['delete'] = Auth::user()->hasRole("delete_" . $this->route_name);
        
        return view('connections.index', [
            'connections'      => $connections,
            'connection_types' => $conn_types,
            'model'            => $this->repository->getModel(),
            'can'              => $roles,
        ]);
    }
}
