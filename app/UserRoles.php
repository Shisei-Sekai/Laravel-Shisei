<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    public $timestamps = false;
    protected $fillable = [
        'user_id','role_id'
    ];
    //Returns the permission of the current role
    /**
     * @return mixed
     */
    public function roleInfo(){
        return Role::find($this->role_id)->permissionsValues();
    }
}
