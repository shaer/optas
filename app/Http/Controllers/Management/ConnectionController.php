<?php

namespace App\Http\Controllers\Management;

use App\Connections\ConnectionRepository;
use App\Connections\ConnectionTypeRepository;
use Illuminate\Http\Request;
use Redirect;
use App\Connections\Connection;

class ConnectionController extends \App\Http\Controllers\Controller
{
    private $connection;
    private $conn_type;
    
    public function __construct(ConnectionRepository $connection, ConnectionTypeRepository $conn_type){
        $this->connection = $connection;
        $this->conn_type  = $conn_type;
    }
    
    public function index(Request $request)
    {
        $connections = $this->connection->getAll();
        $conn_types  = $this->conn_type->getConnectionTypes();
        
        return view('connections.index', [
            'connections'      => $connections,
            'connection_types' => $conn_types,
            'model'            => $this->connection->getModel(),
        ]);
    }
    
    public function store(Request $request)
    {
        $data    = false;
        if($this->connection->save($request->except('_token'))){
            $status = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->connection->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function update(Request $request, $id) {
        $data    = false;
        if($this->connection->update($id, $request->except(['_method','_token']))) {
            $status  = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->connection->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function show(Request $request, Connection $connection) {
        return response()->json($connection);
    }
}
