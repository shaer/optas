<?php

namespace App\Connections;

use App\Core\BaseModel;

class Connection extends BaseModel
{
    protected $fillable = ['name', 'host', 'user', 'password', 'connection_type_id'];
    
    protected $rules = [
        'name'               => 'required',
        'host'               => 'required',
        'user'               => 'required',
        'connection_type_id' => 'required|exists:connection_types,id',
    ];
    
    public function connectionType(){
        return $this->belongsTo('App\Connections\ConnectionType');
    }
}
