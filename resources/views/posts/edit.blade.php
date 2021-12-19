@extends('layouts.app')


@section('content')
    <h2 class="text-center text-secondary">update post</h2>

    <form action="{{route('update',$post->id)}}" class="form-group col-md-6 offset-3 mt-5"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" class="form-control mt-2" placeholder="post title" name="title" value="{{$post->title}}">
        <input type="text" class="form-control mt-2" placeholder="post description" name="description" value="{{$post->description}}">
        <input type="file" class="form-control mt-2"  name="photo">
        <div class="form-group">
            <label for="my-select">categories</label>
            <select  class="form-control" name="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-warning form-control mt-2">save</button>
    </form>
    <div class="card col-md-4 mt-2 offset-3">
        <img style="width: 400px;height:200px" src="{{$post->image->url()}}" class="card-img-top" alt="...">
      </div>

@endsection