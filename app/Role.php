<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $appends = [
        'permission'
    ];
    protected $fillable = [
        'name','permission'
    ];
    public $timestamps = false;
    /**
     * returns an array with the permissions of that role
     */
    public function permissionsValues(){
        $names = [
            'edit post','delete post','create post','move thread','delete thread','create thread','admin'
        ];
        $binary = decbin($this->permission);
        $binary = substr("0000000",0,7 - strlen($binary)) . $binary;
        $values= array();
        for($i=0;$i<strlen($binary);$i++){
            $values[$names[$i]] = $binary[$i]? true:false;
        }
        return $values;
    }

}
