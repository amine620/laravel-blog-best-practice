<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Traits\LikeTrait;
use Illuminate\Http\Request;

class UserLikeController extends Controller
{
    use LikeTrait;

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Request $req, User $user)
    {

       
        $this->likeTrait($user, $req->user()->id);

        return back();
    }
    public function destroy(User $user, $id)
    {
        // $like->delete();
        // dd($id);
        Like::find($id)->delete();
        return back();
    }
}
