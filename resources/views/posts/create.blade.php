@extends('layouts.app')


@section('content')

<x-error-message></x-error-message>

    <h2 class="text-center text-secondary">add new post</h2>

    <form action="{{route('store')}}" class="form-group col-md-6 offset-3 mt-5"  method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control mt-2" placeholder="post title" name="title">
        <input type="text" class="form-control mt-2" placeholder="post description" name="description">
        <input type="file" class="form-control mt-2"  name="photo">
        <div class="form-group">
            <label for="my-select">categories</label>
            <select  class="form-control" name="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary form-control mt-2">save</button>
    </form>

@endsection