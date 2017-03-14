<?php

namespace App\Accounts;

use App\Core\BaseModel;

class Role extends BaseModel
{
    protected $fillable = ['name', 'description'];
    
    protected $rules = [
        'name' => 'required',
    ];
}
