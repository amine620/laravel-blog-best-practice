<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use App\Traits\GetFilePathTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   use GetFilePathTrait;

     public function __construct()
     {
        $this->middleware('auth');
        $this->authorizeResource(User::class,"user");
     }

 
 

   
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

 
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));

    }

   
    public function update(UpdateUser $req, User $user)
    {
        if ($req->hasFile('avatar')) {

            $path =$this->getPathTrait($req,'avatars','avatar');
            
            if($user->image)
            {
                $user->image->path=$path;
                $user->image->save();
            }
            else{

                $user->image()->save(Image::make(["path" => $path]));
            }
            
        }
        $user->lang=$req->lang;
        $user->save();
        return back();

    }

 
}
