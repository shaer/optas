<?php

namespace App\Connections;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use ModelValidationTrait;
    
    protected $fillable = ['name', 'host', 'user', 'password', 'connection_type_id'];
    
    protected function loadRules() {
        $this->rules = array(
            'name'               => 'required',
            'host'               => 'required',
            'user'               => 'required',
            'connection_type_id' => 'required|exists:connection_types,id',
        );
    }
    
    public function connectionType(){
        return $this->belongsTo('App\Connections\ConnectionType');
    }
}
