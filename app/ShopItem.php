<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    protected $table = "shop_items";
    protected $fillable = [
        'shop_id', 'item_id'
    ];
    public $timestamps = false;
}
