<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = "shops";
    protected $fillable = [
      'name','vendor_id','description','timestamp',
    ];
    public $timestamps = false;
}
