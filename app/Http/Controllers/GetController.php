<?php

namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use App\Post;
use App\Role;
use App\Thread;
use App\User;
use App\UserRoles;
use App\ChatMessage;

//use Genert\BBCode\BBCode;
use Golonka\BBCode\BBCodeParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetController extends Controller
{

    private function getCategoryChannels($categoryId){
        $data = array();
        $categories = Channel::all()->where('category_id','=',$categoryId);
        foreach ($categories as $index=>$c){
            $data[$index] = array(
                "id" => $c->id,
                "name" => $c->name,
                "slug" => $c->slug,
                "description" =>$c->description,
            );
        }
        return $data;
    }
    /**
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $r){
        $data = array(
            "quantity" => Category::count(),
            "info" => array(),
        );
        $res = Category::all();
        //Organize all categories
        foreach ($res as $d){
            //$data["info"][$d->id] = array("id"=>$d->id,"name"=>$d->name,"channels"=> $this->getCategoryChannels($d->id));
            $data["info"][$d->id] = array(
                "id" => $d->id,
                "name"=>$d->name,
                "color"=>$d->color,
                "description"=>$d->description,
                "image"=>$d->image,
            );
        }
        return response()->json($data);
    }

    /**
     * Get all channels of determined category
     * @param $categoryId
     * @return array
     */
    public function getChannels(Request $r){
        $data = array();
        $categoryId = $r->input('categoryId');
        $categories = Channel::all()->where('category_id','=',$categoryId);
        foreach ($categories as $index=>$c){
            $data[$index] = array(
                "id" => $c->id,
                "name" => $c->name,
                "slug" => $c->slug,
                "description" =>$c->description,
            );
        }
        return $data;
    }

    /**
     * Get all threads of desired channel in chunks of 15
     * @param $channelId
     * @param $page
     * @return array
     */
    private function getThreads($channelId,$page){
        $data = array();
        $threads = Thread::where('channel_id','=',$channelId)->offset(($page-1)*15)->limit(15)->get();
        foreach ($threads as $r){
            $lastUserPost = Post::where('thread_id','=',$r->id)->orderBy('timestamp','desc')->first();
            $user = User::find($lastUserPost->user_id);
            array_push($data,array(
                "id" => $r->id,
                "userId" => $r->user_id,
                "title" => $r->title,
                "slug" => $r->slug,
                "pinned" => $r->pinned,
                "lastUser" => $user->name,
                "lastDate" => $lastUserPost->timestamp,
            ));
        }
        return $data;
    }

    /**
     * Get all posts of desired thread in chunks of 15
     * @param $threadId
     * @param $page
     * @return array
     */

    public function getPosts($channelId,$threadId,$page){
        $data = array(
            'posts' => array(),
            'users' => array(),
        );
        //$parser = new BBCode();
        $parser = new BBCodeParser();
        $posts = Post::where('thread_id','=',$threadId)->orderBy('id','asc')->offset(($page-1)*20)->limit(20)->get();
        //For each post, find all users participating and get post text
        foreach ($posts as $p){
            //No repeat users in the array
            if(!array_key_exists($p->user_id,$data['users'])){
                $user = User::find($p->user_id);
                $role = Role::find($user->main_role);
                $data['users'][$p->user_id] = array(
                    "id" => $user->id,
                    "avatar" => $user->avatar,
                    "money" => $user->money,
                    "signature" => $user->signature,
                    "name" => $user->name,
                    "messages" => Post::where('user_id','=',$user->id)->count(),
                    "exp" => $user->exp,
                    'role' => array(
                        'name' => $role->name,
                        'color' => $role->color,
                    ),
                );
            }
            //Edit post permission
            $userId = Auth::user()? Auth::user()['id'] : 0;
            $canEdit = Auth::user() && ($userId == $p->user_id || Auth::user()->rolesPermissions()['edit post']);
            //Get text
            $text = $p->text;
            //No script execute thx
            $text = str_replace('<','&lt;',$text);
            $text = str_replace('>','&gt;',$text);
            //BBcode parser
            //$text = $parser->convertToHtml($text);
            $text = $parser->parse($text);
            //Push to array
            array_push($data['posts'],array(
                'userId'=> $p->user_id,
                'id' => $p->id,
                'text' => $text,
                'canEdit'=>$canEdit,
            ));
        }
        return $data;
    }

    /**
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $r){
        $data = array(
            "quantity" => User::count(),
            "info" => array(),
        );
        $page = $r->has('page') ? $r->input('page') : 1;
        $result = DB::table('users')->offset(($page-1)*20)->limit(20)->orderBy('id','asc')->get();
        foreach ($result as $r){
            $data["info"][$r->id] = array(
                "id" => $r->id,
                "name" => $r->name,
                "avatar" => $r->avatar,
                "signature" => $r->signature,
                "money" => $r->money,
            );
        }
        return response()->json($data);
    }

    /**
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoles(Request $r){
        $data = array(
            "quantity" => Role::count(),
            "info" => array(),
        );
        $page = $r->has('page') ? $r->input('page') : 1;
        $result = DB::table('roles')->offset(($page-1)*5)->limit(5)->orderBy('id','asc')->get();
        foreach ($result as $r){
            $binary = decbin($r->permission);
            $binary = substr("0000000",0,7 - strlen($binary)) . $binary;
            $data["info"][$r->id] = array(
                "id" => $r->id,
                "name" => $r->name,
                "permission" => $binary,
                "color" => $r->color,
            );
        }
        return response()->json($data);
    }

    public function getUserRoles(Request $r){
        $data = array();
        $userId = $r->input('id');
        //Get all roles of the user
        $roles = UserRoles::all()->where('user_id','=',$userId);
        foreach($roles as $index=>$rol){
            $role = Role::find($rol->role_id);
            $data[$index] = array(
                "id" => $role->id,
                "name" => $role->name,
            );
        }
        return $data;
    }

    public function getUserNotAssignedRoles(Request $r){
        $data = array();
        $userId = $r->input('id');
        //Get all roles
        $roles = DB::table('roles')->select('id')->get()->toArray();
        foreach ($roles as $key=>$r){
            $roles[$key] = $r->id;
        }

        //Get all user roles
        $userRoles = DB::table('user_roles')->select('role_id')->where('user_id','=',$userId)->get()->toArray();
        foreach ($userRoles as $key=>$r){
            $userRoles[$key] = $r->role_id;
        }

        //Get all unused roles
        $unused = array_diff($roles,$userRoles);
        foreach($unused as $index=>$free){
            $role = Role::find($free);
            $data[$index] = array(
                "id"=>$role->id,
                "name"=>$role->name,
            );
        }
        return response()->json($data);
    }

    public function renderThreadPage(Request $r,$channelId,$threadId){
        $page = $r->has('page') ? $r->input('page') : 1;
        $posts = $this->getPosts($channelId,$threadId,$page);
        $thread = Thread::find($threadId);
        $canClose = Auth::user() ? Auth::user()->rolesPermissions()['admin'] : false;
        $count = Post::where('thread_id','=',$threadId)->count();
        return view("post",['posts'=>$posts['posts'],'users'=>$posts['users'],'threadName'=>$thread->title,'quantity'=>$count,'isClosed'=>$thread->is_closed,'canClose'=>$canClose]);
    }

    public function createMainPage(Request $r){
        $categories = Category::all();
        $chat = ChatMessage::all();
        $data = array();
        $chatMessages = array();
        foreach($categories as $index=>$category){
            array_push($data,array(
                "id" => $category->id,
                "name" => $category->name,
                "channels"=> $this->getCategoryChannels($category->id),
                "image"=>$category->image,
                "description"=>$category->description,
                "color"=>$category->color,
            ));
        }
        foreach ($chat as $message){
            array_push($chatMessages,[
                'name'=> $message->user,
                'message'=>$message->message
            ]);
        }
        return view('index',["categories"=>$data,"messages"=>$chatMessages]);
    }

    public function createChannelPage(Request $r,$channelId){
        $total = Thread::where("channel_id",'=',$channelId)->count();
        $canClose = Auth::user() ? Auth::user()->rolesPermissions()['admin'] : false;
        $channel = Channel::find($channelId);
        $page = $r->has('page')? $r->input('page'):1;
        $threads = $this->getThreads($channelId,$page);
        return view('channel',['threads'=>$threads,'quantity'=>$total,"channelName"=>$channel->name,"channelId"=>$channelId,"isClosed"=>$channel->is_closed,"canClose"=>$canClose]);
        //return response()->json(["success"=>true]);
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
            );
            return view('user_panel',['user'=>$userInfo]);
        }
        else{
            return view('unauthorized');
        }

    }

    public function getPostText(Request $r){
        if(!$r->ajax()){
            return redirect('/');
        }
        $post = Post::find($r->input('postId'));
        return response()->json(['success'=>true,'content'=>$post->text]);
    }
}
