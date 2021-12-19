<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostTagController extends Controller
{
    public function index($id)
    {
       

        return view('home',[
            
            'posts'=>Tag::find($id)->posts()->PostWithUserCommentsTagsImage()->get(),
           
        ]);
    }
}
