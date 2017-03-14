<?php

namespace App\Http\Controllers\Management;

use App\Connections\ConnectionRepository;
use App\Connections\ConnectionTypeRepository;
use Illuminate\Http\Request;
use Redirect;
use App\Connections\Connection;

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
        
        return view('connections.index', [
            'connections'      => $connections,
            'connection_types' => $conn_types,
            'model'            => $this->repository->getModel(),
        ]);
    }
}
