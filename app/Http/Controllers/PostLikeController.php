<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Traits\LikeTrait;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    use LikeTrait;
    
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Request $req, Post $post)
    {

       
        $this->likeTrait($post, $req->user()->id);

        return back();
    }
    public function destroy(Post $post, $id)
    {
        // $like->delete();
        // dd($id);
        Like::find($id)->delete();
        return back();
    }
}
