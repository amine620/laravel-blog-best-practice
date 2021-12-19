@extends('layouts.master')
@section('content')


    <div class="container mt-5">
        <div class="card col-md-8 offset-2 ">
            <img style="width: 400px;height:200px" src="{{ asset('storage/' . $post->photo) }}" class="card-img-top"
                alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <x-block-tag :tags="$post->tags"></x-block-tag>
            </div>
        </div>


        <x-comment-form :action="route('storeComment', $post)"></x-comment-form>


        @foreach ($post->comments as $comment)
            {{-- display all comments --}}
            <div class="card mt-2">
                <div class="card-body">
                    <h2 class="card-title">

                        <x-user-date :user='$comment->user' :date='$comment->created_at->diffforhumans()'></x-user-date>

                    </h2>
                    {{ $comment->content }}
                </div>
                {{-- delete button --}}

                @auth
                    @if (Auth::user()->id == $comment->user_id)
                        <form class="my-2 ml-2" action="{{ route('deleteComment', $comment->id) }}" method='post'>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">delete</button>
                        </form>
                    @endif


                    {{-- like --}}
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



    </div>


@endsection
