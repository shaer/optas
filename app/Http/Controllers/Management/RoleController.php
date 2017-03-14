<?php

namespace App\Http\Controllers\Management;

use App\Accounts\RoleRepository;

class RoleController extends \App\Core\CrudController
{
    private $role;
    
    public function __construct(RoleRepository $role) {
        $this->repository  = $role;
        $this->route_name  = "roles";
    }
}