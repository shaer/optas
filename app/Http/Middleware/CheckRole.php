<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helper;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = false)
    {
        if($role) {
            $authorized = $request->user()->hasRole($role);
        } else {
            $authorized = $this->generic_check($request);
        }
        
        if(!$authorized) {
            if($request->ajax()) {
                return response('Unauthorized Access.', 401);
            } else {
                session()->put('error', 'You are not authorized to access this page.');
                return redirect("home");
            } 
        }
        
            
        return $next($request);
    }
    
    private function generic_check($request)
    {
        $segments = $request->segments();
        $method   = $request->method();
        $action   = array_pop($segments);
        $user     = $request->user();
        
        if(is_numeric($action)) {
            $action = array_pop($segments);
        }

        $method_dict = [
            "GET"    => "View",
            "POST"   => "Add",
            "PATCH"  => "Edit",
            "DELETE" => "Delete",
        ];
        
        //Ex: View Connections
        $required_role = Helper::tokenize($method_dict[$method] . "_" .$action);
        
        return $user->hasRole($required_role);
    }
}
