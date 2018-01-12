<?php
namespace App\Http\Controllers;

use App\Category;
use App\Channel;
use App\Post;
use App\Role;
use App\Thread;
use App\UserRoles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CleanController
 * Manages de deletion of categories,
 * channels, threads and posts
 */

class CleanController extends Controller {

    /** Internal usage functions  */
    private function deleteChannelInside($channelId){
        $threads = Thread::all()->where('channel_id','=',$channelId);
        foreach ($threads as $t){
            $this->deleteThreadInside($t['id']);
        }
        Channel::find($channelId)->delete();
        return response()->json(array('success'=>true));
    }

    private function deleteThreadInside($threadId){
        $posts = Post::all()->where('thread_id','=',$threadId);
        foreach ($posts as $p){
            $this->deletePostInside($p['id']);
        }
        Thread::find($threadId)->delete();
        return true;
    }
    private function deletePostInside($postId){
        Post::find($postId)->delete();
        return true;
    }
    /**
     * delete a category
     * requires admin
     */
    public function deleteCategory(Request $r){
        $categoryId = $r->input('id');
        $channels = Channel::all()->where('category_id','=',$categoryId);
        //Delete every channel in that category
        foreach($channels as $c){
            $this->deleteChannelInside($c['id']);
        }
        Category::find($categoryId)->delete();
        return response()->json(array('success'=>true));
    }

    /**
     * delete a channel
     * requires admin
     */
    public function deleteChannel(Request $r){
        $channelId = $r->input('id');
        $threads = Thread::all()->where('channel_id','=',$channelId);
        foreach ($threads as $t){
            $this->deleteThread($r,$t['id']);
        }
        Channel::find($channelId)->delete();
        return response()->json(array('success'=>true));
    }

    /**
     * delete a thread
     * requires "delete thread" permission
     */
    public function deleteThread(Request $r){
        $threadId = $r->input('id');
        $posts = Post::all()->where('thread_id','=',$threadId);
        foreach ($posts as $p){
            $this->deletePost($r,$p['id']);
        }
        Thread::find($threadId)->delete();
        return true;
    }

    /**
     * delete a thread
     * requires "delete post" permission
     */
    public function deletePost(Request $r){
        $postId = $r->input('id');
        Post::find($postId)->delete();
        return true;
    }


    public function deleteRoleFromUser(Request $r){
        $roleId = $r->input('roleId');
        $userId = $r->input('userId');
        $role = UserRoles::where(["role_id"=>$roleId,"user_id"=>$userId])->get()->first();
        $role->delete();
        return response()->json(['sucess'=>true]);
    }

    public function deleteUser(Request $r){
        $userId = $r->input('id');
        $user = User::find($userId);
        $user->delete();
        return response()->json(["success"=>true]);
    }

    public function deleteRole(Request $r){
        if(!$r->isMethod('DELETE')){
            return response()->json(['success'=>false,'error'=>"invalid method"]);
        }
        $roleId = $r->input('id');
        $role = Role::find($roleId);
        $role->delete();
        return response()->json(["success"=>true]);
    }
}