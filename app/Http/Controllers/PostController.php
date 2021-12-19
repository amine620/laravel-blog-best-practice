<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Traits\GetFilePathTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use GetFilePathTrait;
    
    public function index()
    {

        $posts = Post::with(['category','user'])->get();

        return view('posts.index', ['posts' => $posts]);
    }

    function details($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.details', ['post' => $post]);
    }

    public function create()
    {
        $categories = Category::get();
        return view('posts.create', ['categories' => $categories]);
    }
    public function store(PostRequest $req)
    {

        $validateData = $req->validated();

        $validateData['user_id'] = $req->user()->id;

        $post= Post::create($validateData);

        if ($req->hasFile('photo')) {


            $path = $this->getPathTrait($req, 'images', 'photo');
           

            $post->image()->save(new Image(["path"=>$path]));

        }


        return redirect('posts/list');
    }


    function edit($id)
    {
        $post = Post::findOrFail($id);

        // method 1
        // if (Gate::denies('edit.post', $post)) {
        //     return abort(403, "you can't edit this post");
        // }

        // method 2
        $this->authorize('update', $post);

        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function update(Request $req, $id)
    {

        $post = Post::find($id);

        // method 1
        // if(Gate::denies('update.post',$post))
        // {
        //     return abort(403,'you cant update this post');
        // }

        // method 2
        $this->authorize('update', $post);

        $post->title = $req->title;
        $post->description = $req->description;
        $post->category_id = $req->category_id;
        $post->user_id = Auth::user()->id;
        if ($req->hasFile('photo')) {

            Storage::delete($post->image->path);

            $path = Storage::putFileAs(
                'images',
                $req->file('photo'),
                random_int(1, 100) . '.' . $req->file('photo')->guessExtension()
            );
            
            $post->image->path=$path;
            $post->image->save();
        }
        $post->save();
        return redirect('posts/list');
    }

    function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        Storage::delete($post->image->path);

        $post->delete();
        return redirect('posts/list');
    }



    function home()
    {
        $posts = Post::PostWithUserCommentsTags()->get();

     

        return view('home', [
            'posts' => $posts, 
        ]);
    }
}
