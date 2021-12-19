@extends('layouts.app')
@section('content')


<div class="container mt-5">
    <div class="card col-md-8 offset-2 ">
        <img style="width: 400px;height:200px" src="{{asset('storage/'.$post->photo)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->description}}</p>
          <a href="{{route('list')}}" class="btn btn-primary">go back</a>
        </div>
      </div>
</div>


@endsection
