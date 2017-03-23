<?php

namespace App\Actions;

use App\Core\BaseRepository;
use DB;

class ActionRepository extends BaseRepository
{
    public function __construct(Action $model)
    {
        $this->model = $model;
    }
    
    
    public function getActionTypes() {
        return ActionType::orderBy('name')->pluck('name', 'id');
    }
}