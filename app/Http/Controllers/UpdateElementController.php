<?php

namespace App\Http\Controllers;

use App\Channel;
use App\User;
use App\Category;
use App\Role;
use App\UserRoles;
use App\Post;
use App\Thread;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;

class UpdateElementController extends Controller
{
    public function createRole(Request $r){
        $role = new Role();
        $role->name = $r->input('name');
        $role->permission = $r->input('permissions');
        $role->color = $r->input('color');
        $role->save();
        return response()->json(['success'=>true]);
    }

    public function updateRole(Request $r){
        $role = Role::find($r->input("role_id"));
        $role->permission = $r->input('permissions');
        $role->name = $r->input('name');
        $role->color = $r->input('color');
        $role->save();
        return response()->json(['success'=>true]);
    }

    public function updateCategory(Request $r){
        $category = Category::find($r->input("category_id"));
        $category->name = $r->input('name');
        $category->description = $r->input('description');
        $category->color = $r->input('color');
        $category->image = $r->input('image');
        $category->save();
        return response()->json(['success'=>true]);
    }

    //Bind a channel to some category
    public function bindChannel(Request $r){
        return false;
    }

    public function updateUser(Request $r){
        $userId = $r->input('id');
        $newName = $r->input('name');
        $user = User::find($userId);
        $user->name = $newName;
        $user->save();
        return response()->json(["success"=>true]);
    }

    public function addRoleToUser(Request $r){
        $roleId = $r->input('roleId');
        $userId = $r->input('userId');
        $userRole = new UserRoles();
        $userRole->user_id = $userId;
        $userRole->role_id = $roleId;
        $userRole->save();
        return response()->json(["success"=>true]);
    }

    public function editUserMainRole(Request $r){
        $roleId = $r->input('roleId');
        $userId = $r->input('userId');
        $user = User::find($userId);
        $user->main_role = $roleId;
        $name = $user->name;
        $user->save();
        return response()->json(["success"=>true,"user"=>$name]);
    }

    /**
     * Edit a post
     * requires "edit post" permission or being the post author
     */
    public function editPost(Request $r){
        $postId = $r->input('postId');
        $userId = Auth::user()? Auth::user()['id'] : 0;
        $post = Post::where('id','=',$postId)->first();
        $postAuthor = $post['user_id'];
        if(!Auth::user() || !$r->isMethod('PUT') || ($userId != $postAuthor && !Auth::user()->rolesPermissions()['edit post'])){
            return response()->json(['success'=>false,'reason'=>'you can\'t edit that post']);
        }
        //Find the post with that id, replace the text and save it again
        $post->text = $r->input('text');
        $post->save();
        return response()->json(['success'=>true]);
    }


    public function alterThreadStatus(Request $r){
        $permission = Auth::user() ? Auth::user()->rolesPermissions()['admin'] : false;
        if(!$permission)
            return response('Not allowed to do that',401);
        $thread = Thread::find($r->input('id'));
        $thread->is_closed = !$thread->is_closed;
        $thread->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Alters the status of a channel (open/closed)
     * @param Request $r
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function alterChannelStatus(Request $r){
        $permission = Auth::user() ? Auth::user()->rolesPermissions()['admin'] : false;
        if(!$permission)
            return response('Not allowed to do that',401);
        $channel = Channel::find($r->input('id'));
        $channel->is_closed = !$channel->is_closed;
        $channel->save();
        return response()->json(['success'=>true]);
    }

    /**
     * move a thread to another channel
     * requires "move thread" permission
     */
    public function moveThread(Request $r){
        $permission = Auth::user() ? Auth::user()->rolesPermissions()['move thread'] : false;
        $exists = Channel::where("id","=",$r->input("newId"))->count();
        if(!$exists || !$permission){
            return response()->json(["success"=>false]);
        }
        $thread = Thread::find($r->input("threadId"));
        $thread->channel_id = $r->input("newId");
        $thread->save();
    }


}
