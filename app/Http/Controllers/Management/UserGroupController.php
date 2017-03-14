<?php

namespace App\Http\Controllers\Management;

use App\Accounts\UserGroupRepository;
use App\Accounts\RoleRepository;
use App\Accounts\UserGroup;
use Illuminate\Http\Request;
use Redirect;

class UserGroupController extends \App\Http\Controllers\Controller
{
    private $user_group;
    private $role;
    
    public function __construct(UserGroupRepository $user_group, RoleRepository $role) {
        $this->user_group  = $user_group;
        $this->role        = $role;
    }
    
    public function index(){
        $usergroups = $this->user_group->getAll();

        return view('usergroups.index', [
            'groups' => $usergroups,
            'model'  => $this->user_group->getModel(),
        ]);
    }
    
    public function store(Request $request)
    {
        $data    = false;
        if($this->user_group->save($request->except('_token'))){
            $status = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->user_group->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function update(Request $request, $id) {
        $data    = false;
        if($this->user_group->update($id, $request->except(['_method','_token']))) {
            $status  = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->user_group->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function show(UserGroup $usergroup) {
        return response()->json($usergroup);
    }
    
    public function destroy(Request $request, UserGroup $usergroup){
        $this->user_group->delete($usergroup);
        return redirect('/usergroups');
    }
    
    public function roles(Request $request) {
        $groups = $this->user_group->getGroups($request->id);
        $roles  = $this->role->getAll();
        
        return view('usergroups.roles', [
            'groups' => $groups,
            'roles'  => $roles,
        ]);
    }
    
    public function editRoles(Request $request) {
        $this->user_group->saveGroupRoles($request->input('roles'), $request->id);
        return back()->with('success', true);
    }
}