<?php

namespace App\Accounts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Core\ModelValidationTrait;

class User extends Authenticatable
{
    use Notifiable;
    use ModelValidationTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_group_id','status'
    ];
    
    public $userStatus = [
        1 => 'Active',
        2 => 'Pending Approval',
        3 => 'In Active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
        
    protected function loadRules() {
        $this->rules = array(
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $this->id,
            'status'        => 'required|in:' . implode(',', array_keys($this->userStatus)) . '',
            'user_group_id' => 'required|exists:user_groups,id',
        );
    }
    
    public function userGroup() {
        return $this->belongsTo('App\Accounts\UserGroup');
    }
    
    public function getStatus() {
        if(isset($this->userStatus[$this->status])) {
            return $this->userStatus[$this->status];
        }
        
        return "N/A";
    }

}
