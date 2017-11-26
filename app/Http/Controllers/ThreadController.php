<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use App\Thread;
use App\Category;
use App\Channel;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller{

    // Create a post in a thread
    public function createPost(Request $r,$channelId,$threadId){
        //If there's no user or it's not a post request, return invalid
        $permission = Auth::user() && Auth::user()->rolesPermissions()['create post'];
        if(!$r->isMethod('post') || !$permission){
            //BE GONE
            return response()->json((array('success'=>false)));
        }
        $user = Auth::user();
        $text = $r->input('postText');

        //Create post object and fill the values
        $post = new Post();
        $post->text = $text;
        $post->user_id = $user['id'];
        $post->thread_id = $threadId;
        $post->timestamp = Carbon::now();
        $post->save();

        //Give the user a reward (EASY MONEY)
        //The relation is:
        //10 gold per post and 5 exp per every 100 characters of text (floor)
        //Probably will change this to use environment variables
        $legitText = preg_replace("/[^A-Za-z]/","",$text); //Only counting characters, neither specials nor newlines
        $total = strlen($legitText)/100;
        $user['money'] += 10;
        $user['exp'] += floor($total)*5;
        //$user['exp'] += round($total)*5; //Or maybe round up (?)
        $user->save();

        //return response()->json(array('success'=>true));
        return redirect()->back();
    }

    //Create a thread in a channel
    public function createThread(Request $r,$channelId){
        $permission = Auth::user() && Auth::user()->rolesPermissions()['create thread'];
        if(!$r->isMethod('post') || !$permission){
            //BE GONE THOT
            return response()->json((array('success'=>false)));
        }
        //Create a thread
        $thread = new Thread();
        //Get user id
        $thread->user_id = Auth::user()['id'];
        //Channel id
        $thread->channel_id = $channelId;
        //Title of the thread
        $thread->title = $r->input('threadTitle');
        //Make a slug
        $thread->slug = $this->makeSlug($r->input('threadTitle'));
        $thread->timestamp = Carbon::now()->toDateString();
        $thread->save();
        //Now create the 1st post of that thread
        $this->createPost($r,$channelId,$thread->id);
        //return response()->json(array('success'=>true));
        return redirect('/'.$channelId.'/'.$thread->id);

    }

    /**
     * Control the categories and channels
     * Since this will be done from an admin panel
     * obviously you'll need at least a role with admin permission to do this
     **/

    public function createCategory(Request $r){
        $category = new Category();
        $category->name = $r->input('name');
        $category->timestamp = Carbon::now();
        $category->save();
        return response()->json(array('success'=>true));
    }

    public function createChannel(Request $r){
        //You need to be admin to create categories and channels
        $channel = new Channel();
        $channel->name = $r->input('name');
        $channel->description = $r->input('description');
        $slug = $this->makeSlug($r->input('name'));
        $channel->slug = $slug;
        $channel->timestamp = Carbon::now();
        $channel->category_id = $r->input('categoryId');
        $channel->save();
        return response()->json(array('success'=>true));
    }

    //Make a slug from a string
    private function makeSlug($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }

}