<?php

namespace App\Core;

use Illuminate\Http\Request;
use Auth;

class CrudController extends  \App\Http\Controllers\Controller
{
    protected $repository;
    protected $route_name;

    protected function getRequiredRoles() {
        $roles['edit']   = Auth::user()->hasRole("edit_" . $this->route_name);
        $roles['delete'] = Auth::user()->hasRole("delete_" . $this->route_name);

        return $roles;
    }
    
    public function index(){
        $data = $this->repository->getAll();
        $roles = $this->getRequiredRoles();
        
        return view($this->route_name . '.index', [
            'data'  => $data,
            'model' => $this->repository->getModel(),
            'can'   => $roles,
        ]);
    }
    
    public function store(Request $request)
    {
        $data    = false;
        if($this->repository->save($request->except('_token')) === true){
            $status = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->repository->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function update(Request $request, $id) {
        $data    = false;
        if($this->repository->update($id, $request->except(['_method','_token'])) === true) {
            $status  = 200;
            $request->session()->flash('success', true);
        } else {
            $status = 400;
            $data   = $this->repository->getModel()->errors()->toArray();
        }
        
        return $this->sendJsonOutput($status, $data);
    }
    
    public function show($id) {
        return response()->json($this->repository->requireById($id));
    }
    
    public function destroy(Request $request, $id){
        $this->repository->delete($this->repository->requireById($id));
        return back();
    }
}