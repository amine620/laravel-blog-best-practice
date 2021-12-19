<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::where('user_id',Auth::user()->id)->paginate(2);
       return view('categories.index',['categories'=>$categories]);
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required'
        ]);
         
        $category=new Category();
        $category->name=$req->name;
        $category->user_id=Auth::user()->id;
        $category->save();

        return redirect('categories/categories_list');
    }


    public function edit($id)
    {
      $category=Category::findOrFail($id);
        return view('categories.edit',['category'=>$category]);

    }

    public function update(Request $req,$id)
    {
        $req->validate([
            'name'=>'required'
        ]);

        $category=Category::findOrFail($id);
        $category->name=$req->name;
        $category->user_id=Auth::user()->id;
        $category->save();
        return redirect('categories/list');


    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('categories/list');

    }
}
