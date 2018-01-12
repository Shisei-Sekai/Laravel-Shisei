<?php

namespace App\Http\Controllers;

use App\Post;
use App\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Role;
use App\User;
use App\Item;
use App\Channel;
use App\UserItem;

class UserController extends Controller
{
    private function getUserItems($userId){
        $items = UserItem::all()->where('user_id','=',$userId);
        $data = array();
        foreach($items as $index=>$userItem){
            $item = Item::find($userItem->item_id);
            if($item){
                $data[$index] = [
                    "name" => $item->name,
                    "icon" => $item->icon,
                    "description" => $item->description,
                ];
            }

        }
        return $data;
    }

    public function getUserPage(Request $r,$userName){
        $user = User::where('name','=',$userName)->first();
        if($user && Auth::user()){
            $role = Role::find($user->main_role);
            $userInfo = array(
                'name' => $user->name,
                'role' => array(
                    'name' => $role->name,
                    'color' => $role->color,
                ),
                'avatar' => $user->avatar,
                'owner' => Auth::user()['id'] == $user->id, //Check if you are requesting access to your user panel
                'items' => $this->getUserItems($user->id),
                'money' => $user->money,
                'exp' => $user->exp,
            );
            return view('user_panel',['user'=>$userInfo]);
        }
        else{
            return view('unauthorized');
        }

    }
    public function updateUserAvatar(Request $r,$userName){
        $user = Auth::user();
        $permission = $user && $user['name'] == $userName;
        $r->validate([
            'userAvatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);
        if(!$permission || !$r->isMethod('POST')){
            return redirect('/');
        }
        $headers = [
            'CLIENT-TOKEN' => env('POMF_CLIENT_TOKEN'),
            'CLIENT-SECRET' => env('POMF_SECRET_TOKEN'),
        ];
        $client = new Client(['headers'=>$headers]);


        $file = $r->file('userAvatar');

        //Get "base" directory
        $dir = getcwd();
        $separated = explode('/',$dir);
        unset($separated[count($separated)-1]);
        $dir = implode('/', $separated);

        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = $extension[count($extension)-1];

        $path = $file->storeAs(
            'temp',$userName.'_avatar.'.$extension
        );
        $path = $dir.'/storage/app/'.$path;

        $res = $client->request('POST',env('POMF_URL'),[
            'multipart'=>[
                [
                    'name'=>'file',
                    'contents'=>fopen($path,'r'),
                ]
            ]
        ]);

        $res = json_decode($res->getBody());

        //Update user avatar
        $user = User::where('name','=',$userName)->first();
        $user->avatar = $res->files[0]->url;
        $user->save();
        unlink($path); //Delete user image from local server
        return redirect('/');
    }

    public function loadUserItems($userName){
        $user = User::where('name','=',$userName)->first();
        if(!$user)
            return response()->json(['success'=>false]);
        return response()->json($this->getUserItems($user->id));
    }

    public function getUserLastMessages($userName){
        $user = User::where('name','=',$userName)->first();
        if(!$user)
            return response()->json(['success'=>false]);
        $messages = Post::where('user_id','=',$user->id)->orderBy('timestamp','desc')->limit(5)->get();
        $data = array();
        foreach($messages as $index=>$message){
            $thread = Thread::find($message->thread_id);
            $channel = Channel::find($thread->channel_id);
            array_push($data,[
                "text"=>$message->text,
                "thread"=>[
                    "id"=>$thread->id,
                    "name"=>$thread->title,
                ],
                "channel"=>[
                    "id"=>$channel->id,
                    "name"=>$channel->name,
                ],
            ]);
        }
        return response()->json($data);
    }
}
