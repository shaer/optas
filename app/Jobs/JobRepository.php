<?php

namespace App\Jobs;

use App\Core\BaseRepository;
use Illuminate\Support\Facades\Auth;

class JobRepository extends BaseRepository
{
    public function __construct(Job $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        $model = $this->getNew($data);
        $model->created_by = Auth::user()->id;

        return parent::save($model);
    }
}