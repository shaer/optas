<?php
namespace App\Core;

use Validator;
use Illuminate\Support\MessageBag;

trait ModelValidationTrait {
    protected $rules = [
        ];
    
    private $errors;
    
    protected function loadRules() {
        //do nothing
    }
    
    public function __construct()
    {
        parent::__construct();
        $this->errors = new MessageBag();
    }

    public function validate($data)
    {
        $this->loadRules();
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