<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    protected $fillable = [
        'name','buy_value','sell_value','icon','timestamp','type',
    ];
    public $timestamps = false;
}
