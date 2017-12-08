<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','money','avatar','signature'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rolesPermissions(){
        //Roles values
        $values = array();
        //Get all user roles
        $roles = UserRoles::all()->where('user_id','=',$this->id);
        //Travel all roles
        foreach($roles as $r){
            array_push($values,$r->roleInfo());
        }
        //Permissions of all roles of the user
        $per = array(
            'edit post'=>false,
            'delete post'=>false,
            'create post'=>false,
            'move thread'=>false,
            'delete thread'=>false,
            'create thread'=>false,
            'admin'=>false,
        );
        foreach ($values as $v){
            foreach ($v as $key=>$value){
                $per[$key] = $per[$key] || $value;
            }
        }
        //Return the permissions
        return $per;
    }

    public function isBlocked(){
        return $this->blocked_on && Carbon::now() >= $this->blocked_on;
    }
}
