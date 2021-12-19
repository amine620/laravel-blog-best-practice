@extends('layouts.app')


@section('content')
    <h2 class="text-center text-secondary">update category</h2>

    <form action="{{route('categories.update',$category->id)}}" class="form-group col-md-6 offset-3 mt-5"  method="POST">
        @csrf
        @method('PUT')
        <input type="text" class="form-control" placeholder="category name" name="name" value="{{$category->name}}">
        <button class="btn btn-secondary form-control mt-2">save</button>
    </form>

@endsection