<?php
namespace App\Core;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\MessageBag;

class BaseModel extends Model {
    protected $rules = [
        ];
    
    private $errors;
    
    public function __construct()
    {
        parent::__construct();
        $this->errors = new MessageBag();
    }

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        if ($v->fails()) {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
    
    public function errors()
    {
        return $this->errors;
    }
}