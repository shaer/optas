<?php

namespace App\Http\Controllers\Management;

use App\Accounts\UserGroupRepository;
use App\Accounts\RoleRepository;
use App\Accounts\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends \App\Core\CrudController
{
    private $role;

    public function __construct(UserGroupRepository $usergroup, RoleRepository $role) {
        $this->repository  = $usergroup;
        $this->role        = $role;
        $this->route_name  = "usergroups";
    }
    
    public function roles(Request $request) {
        $groups = $this->repository->getGroups($request->id);
        $roles  = $this->role->getAll();
        
        return view('usergroups.roles', [
            'groups' => $groups,
            'roles'  => $roles,
        ]);
    }
    
    public function editRoles(Request $request) {
        $this->repository->saveGroupRoles($request->input('roles'), $request->id);
        return back()->with('success', true);
    }
}