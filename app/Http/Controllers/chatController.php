<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use LRedis;


class chatController extends Controller
{
    public function sendMessage(Request $r){
        if(!Auth::user()){
            return false;
        }
        $redis = LRedis::connection();
        $data = ['message'=>$r->input('message'),'user'=>$r->input('user')];
        $redis->publish('message',json_encode($data));
        return response()->json([]);
    }
}
