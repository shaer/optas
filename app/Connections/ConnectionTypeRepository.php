<?php

namespace App\Connections;

use App\Core\BaseRepository;

class ConnectionTypeRepository extends BaseRepository
{
    public function __construct(ConnectionType $model)
    {
        $this->model = $model;
    }
    
    public function getConnectionTypes()
    {
        return $this->model->pluck('name', 'id');
    }
}