<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public $table = "chat_messages";
    public $timestamps = false;
    protected $fillable = [
        'user','message','timestamp'
    ];
}
