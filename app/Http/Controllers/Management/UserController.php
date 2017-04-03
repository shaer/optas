<?php

namespace App\Http\Controllers\Management;

use App\Accounts\UserGroupRepository;
use App\Accounts\UserRepository;
use App\Accounts\UserGroup;
use Illuminate\Http\Request;
use Auth;

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
        $roles['edit']   = Auth::user()->hasRole("edit_" . $this->route_name);
        $roles['delete'] = Auth::user()->hasRole("delete_" . $this->route_name);

        return view('users.index', [
            'users'      => $users,
            'usergroups' => $usergroups,
            'model'      => $this->repository->getModel(),
            'can'        => $roles,
            
        ]);
    }

}