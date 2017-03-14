<?php

namespace App\Accounts;

use App\Core\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}