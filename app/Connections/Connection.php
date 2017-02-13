<?php

namespace App\Connections;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    public function connectionType(){
        return $this->belongsTo('App\Connections\ConnectionType');
    }
}
