<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function sendJsonOutput($status, $data = false) {
        $output['status']     = $status;
        $output['data']       = $data;
        $output['is_success'] = $status >= 200 && $status < 300;

        return response()->json($output);
    }
}
