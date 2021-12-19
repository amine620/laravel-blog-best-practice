<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Traits\LikeTrait;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    use LikeTrait;

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Request $req, Comment $comment)
    {

     
        $this->likeTrait($comment, $req->user()->id);

        return back();
    }
    public function destroy(Comment $comment, $id)
    {
       
        Like::find($id)->delete();
        return back();
    }
}
