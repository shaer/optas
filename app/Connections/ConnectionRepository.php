<?php

namespace App\Connections;

use App\Core\BaseRepository;
use Illuminate\Support\Facades\Crypt;

class ConnectionRepository extends BaseRepository
{
    public function __construct(Connection $model)
    {
        $this->model = $model;
    }
    
    public function save($data) {
        if(isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Crypt::encryptString($data['password']);
        }
        return parent::save($data);
    }
    
    public function update($id, $data) {
        if(empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Crypt::encryptString($data['password']);
        }
         return parent::update($id, $data);
    }
    
    public function getConnections() {
        return $this->model->orderBy('name')->pluck('name', 'id');
    }
}