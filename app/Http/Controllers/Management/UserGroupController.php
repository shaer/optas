<?php

namespace App\Http\Controllers\Management;

use App\Accounts\UserGroupRepository;
use App\Accounts\RoleRepository;
use App\Accounts\UserGroup;
use Illuminate\Http\Request;
use Auth;

class UserGroupController extends \App\Core\CrudController
{
    private $role;

    public function __construct(UserGroupRepository $usergroup, RoleRepository $role) {
        $this->repository  = $usergroup;
        $this->role        = $role;
        $this->route_name  = "usergroups";
    }
    
    protected function getRequiredRoles() {
        $roles = parent::getRequiredRoles();
        $roles['view_roles'] = Auth::user()->hasRole("view_assigned_roles_to_usergroups");
        return $roles;
    }
    
    public function roles(Request $request) {
        $groups = $this->repository->getGroups($request->id);
        $roles  = $this->role->getAll();
        
        return view('usergroups.roles', [
            'groups'   => $groups,
            'roles'    => $roles
        ]);
    }
    
    public function editRoles(Request $request) {
        $this->repository->saveGroupRoles($request->except('_token'));
        return back()->with('success', true);
    }
}