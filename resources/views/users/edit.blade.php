@extends('layouts.app')

@section('content')

    <x-error-message></x-error-message>

  <div class="card col-md-6 offset-3">
         @if ($user->image)

            <img class="rounded-circle" style="width: 200px;height:200px" src="{{ $user->image->url() }}"
              alt="...">
        @endif

      <form class="form-group" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
  
  
          <h5>select different avatar</h5>
          <input type="file" name="avatar" id="avatar" class="form-control mt-2">
  
  
          <label for="name">name</label>
          <input id="name" name="name" type="text" class="form-control mt-2">

          <label for="language">language</label>
          <select name="lang" id="language" class="form-control">
            @foreach (App\Models\User::LOCAL as $key=> $item)    
            <option value="{{$key}}" {{$user->lang==$key? "selected" : ""}}>{{$item}}</option>
            @endforeach
          </select>

  
          <button class="btn btn-primary form-control  mt-2">update</button>
          </div>
      </form>
  </div>
@endsection
