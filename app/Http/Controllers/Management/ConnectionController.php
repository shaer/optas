<?php

namespace App\Http\Controllers\Management;

use App\Connections\ConnectionRepository;
use App\Connections\ConnectionTypeRepository;
use Illuminate\Http\Request;
use Redirect;

class ConnectionController extends \App\Http\Controllers\Controller
{
    private $connection;
    private $conn_type;
    
    public function __construct(ConnectionRepository $connection, ConnectionTypeRepository $conn_type){
        $this->connection = $connection;
        $this->conn_type  = $conn_type;
    }
    
    public function index()
    {
        $connections = $this->connection->getAll();
        $conn_types  = $this->conn_type->getConnectionTypes();
        
        return view('connections.index', [
            'connections'      => $connections,
            'connection_types' => $conn_types,
            'model'            => $this->connection->getModel(),
        ]);
    }
    
    public function add(Request $request)
    {
        if($this->connection->save($request->except('_token'))){
            return Redirect::to('connections')->with('success', true);
        } else {
            $request->session()->flash('error', true);
            return $this->index();
        }
        
    }
}
