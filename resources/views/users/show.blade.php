@extends('layouts.master')

@section('content')


  
    <div class="card col-md-6 offset-3">
        @if ($user->image)

            <img class="rounded-circle" style="width: 200px;height:200px" src="{{ $user->image->url() }}"
              alt="...">
        @endif

        <div class="card-body">
            <h5 class="card-title">{{$user->name}}</h5>
            <h5 class="card-title">{{$user->email}}</h5>
          
            @can('update', $user)
                <a href="{{ route('users.edit', $user) }}">edit</a>
            @endcan
        </div>
                   @if ($user->likes()->where('likeable_id', $user->id)->where('user_id', Auth::user()->id)->first())

                        <x-like-button 
                            :count="$user->likes->count()"
                            status='unlike' 
                            :action="route('users.likes.destroy', [$user, $user->likes()->first()->id])">
                        </x-like-button>

                    @else

                      <x-like-button 
                            :count="$user->likes->count()"
                        status='like' 
                        :action="route('users.likes.store',$user)">
                      </x-like-button>

                    @endif
    </div>
    <x-comment-form :action="route('users.comments.store', $user)"></x-comment-form>

     @foreach ($user->comments as $comment)

          {{-- display all comments  --}}
      <div class="card mt-2">
        <div class="card-body">

          <x-block-tag :tags="$comment->tags"></x-block-tag>

          <h2 class="card-title">

            <x-user-date :user='$comment->user' :date='$comment->created_at->diffforhumans()'></x-user-date>

          </h2>
          {{$comment->content}}
        </div>
         {{-- delete button --}}

         @auth

         @if(Auth::user()->id==$comment->user_id)
             <form class="my-2 ml-2" action="{{route('deleteComment',$comment->id)}}" method='post'>
               @method('DELETE')
               @csrf
               <button class="btn btn-danger">delete</button>
             </form>
         @endif


          @if ($comment->likes()->where('likeable_id', $comment->id)->where('user_id', Auth::user()->id)->first())

                      <x-like-button 
                        :count="$comment->likes->count()"
                          status='unlike' 
                          :action="route('comments.likes.destroy', [$comment, $comment->likes()->first()->id])">
                      </x-like-button>

                    @else

                      <x-like-button 
                        :count="$comment->likes->count()"
                        status='like' 
                        :action="route('comments.likes.store',$comment)">
                      </x-like-button>

                    @endif
          @endauth

      </div>

     

      @endforeach
@endsection
