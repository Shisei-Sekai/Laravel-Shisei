<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'text','thread_id','user_id'
    ];
    public $timestamps = false;
}
