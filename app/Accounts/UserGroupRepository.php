<?php

namespace App\Accounts;

use App\Core\BaseRepository;

class UserGroupRepository extends BaseRepository
{
    public function __construct(UserGroup $model)
    {
        $this->model = $model;
    }
}