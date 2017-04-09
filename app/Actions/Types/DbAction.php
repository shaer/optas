<?php

namespace App\Actions\Types;

use App\Core\ModelValidationTrait;
use Illuminate\Database\Eloquent\Model;

class DbAction extends Model implements ActionType
{
    use ModelValidationTrait;
    
    protected $fillable = ['query','is_csv','connection_id'];
    
    protected function loadRules() {
        $this->rules = array(
            'query' => 'required',
            'is_csv' => 'required|in:"T","F"',
            'connection_id' => 'required|exists:connections,id',
        );
    }
    
    public function connection() {
        return $this->belongsTo('App\Connections\Connection');
    }
    
    public function actions()
    {
        return $this->morphMany('App\Actions\Action', 'triggerable');
    }
    
    public function getRunner() {
        return new QueryRunner();
    }
}







