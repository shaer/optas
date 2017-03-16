<?php

namespace App\Http\Controllers\Management;

use App\Accounts\UserGroupRepository;
use App\Accounts\UserRepository;
use App\Accounts\UserGroup;
use Illuminate\Http\Request;

class UserController extends \App\Core\CrudController
{
    private $usergroup;

    public function __construct(UserRepository $user, UserGroupRepository $usergroup) {
        $this->repository = $user;
        $this->usergroup  = $usergroup;
        $this->route_name = "users";
    }
    
    public function index()
    {
        $users       = $this->repository->getAll('name', false);
        $usergroups  = $this->usergroup->getUserGroups();

        return view('users.index', [
            'users'      => $users,
            'usergroups' => $usergroups,
            'model'      => $this->repository->getModel(),
            
        ]);
    }

}