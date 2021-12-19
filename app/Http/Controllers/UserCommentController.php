<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only("store");
    }

   public function store(CommentRequest $req,User $user)
   {
    
        $user->comments()->create($req->validated() + ['user_id' => $req->user()->id]);

        return back();
   }
}
