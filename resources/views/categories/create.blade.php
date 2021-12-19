@extends('layouts.app')


@section('content')
    <h2 class="text-center text-secondary">add new category</h2>

    <form action="{{route('categories.store')}}" class="form-group col-md-6 offset-3 mt-5"  method="POST">
        @csrf
        <input type="text" class="form-control" placeholder="category name" name="name">
        <button class="btn btn-primary form-control mt-2">save</button>
    </form>

@endsection