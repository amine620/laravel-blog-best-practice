<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use App\Http\Requests\CommentRequest;
use App\Mail\CommentedPost;
use App\Mail\CommentedPostMarkDown;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(CommentRequest $req,Post $post)
    {
      
        
       $comment= $post->comments()->create($req->validated()+['user_id'=>$req->user()->id]);

    //    $when=now()->addSeconds(10);
         
    //    Mail::to($post->user->email)
    //     // ->send(new CommentedPostMarkDown($comment)); waiting until mail sent
    //    // ->queue(new CommentedPostMarkDown($comment)) using queue
    //      ->later($when,new CommentedPostMarkDown($comment));

        event(new CommentEvent($comment));

        return back();
    }

    public function commentPage($id)
    {
        $post= Post::with(['comments.user','tags'])->find($id); 
        return view('commentPage', ['post' => $post]);
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return back();

    }
}
