<?php

namespace App\Http\Controllers\Management;

use App\Connections\ConnectionRepository;

class ConnectionController extends \App\Http\Controllers\Controller
{
    private $connection;
    
    public function __construct(ConnectionRepository $connection){
        $this->connection = $connection;
    }
    
    public function index()
    {
        var_dump($this->connection->requireById(1));
    }
}
