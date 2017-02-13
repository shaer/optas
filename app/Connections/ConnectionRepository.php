<?php

namespace App\Connections;

use App\Core\BaseRepository;

class ConnectionRepository extends BaseRepository
{
    public function __construct(Connection $model)
    {
        $this->model = $model;
    }
    
}