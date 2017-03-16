<?php

namespace App\Accounts;

use App\Core\BaseRepository;
use DB;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        if(isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return parent::save($data);
    }
    
    public function update($id, $data) {
        if(empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
         return parent::update($id, $data);
    }
}