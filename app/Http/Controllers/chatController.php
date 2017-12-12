<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ChatMessage;
use LRedis;


class chatController extends Controller
{
    public function sendMessage(Request $r){
        if(!Auth::user()){
            return false;
        }
        $count = ChatMessage::count();
        if($count >= 20){
            $element = ChatMessage::all()->first();
            $element->delete();
        }
        $redis = LRedis::connection();
        $message = ChatMessage::create([
            'user'=>Auth::user()['name'],
            'message'=>$r->input('message'),
            'timestamp'=>Carbon::now(),
        ]);
        $message->save();
        $data = ['message'=>$r->input('message'),'user'=>$r->input('user')];
        $redis->publish('message',json_encode($data));
        return response()->json([]);
    }
}
