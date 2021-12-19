@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row" style="margin-top:30px">
            <div class="col-md-8">

                <div class="row">

                    @foreach ($posts as $post)




                        <div class="card col-md-4 mt-2">

                            {{-- component part --}}
                            @if ($post->created_at->diffInHours() < 1)

                                <x-badge-tag type='success'>
                                    New
                                </x-badge-tag>

                            @else
                                <x-badge-tag type='dark'>
                                    old
                                </x-badge-tag>
                            @endif

                            @if ($post->image)

                                <img style="width: 200px;height:200px" src="{{ $post->image->url() }}"
                                    class="card-img-top" alt="...">
                            @endif

                            <div class="card-body">
                                <h3 class="card-title">{{ $post->user->name }}</h3>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->description }}</p>
                                <a href="{{ route('commentPage', $post->id) }}" class="btn btn-primary">see
                                    details</a>
                                <br>

                                <x-user-date :date='$post->created_at->diffforhumans()' :user="$post->user">
                                </x-user-date>

                                <br>
                                <span class="text-secondary">{{ trans_choice('plural', $post->comments->count()) }}</span>
                                <br>
                                {{-- tags --}}
                                <x-block-tag :tags="$post->tags"></x-block-tag>
                            </div>

                            {{-- like --}}
                            @auth

                                @if ($post->likes()->where('likeable_id', $post->id)->where('user_id', Auth::user()->id)->first())

                                <x-like-button 
                                :count="$post->likes->count()"
                                status='unlike'  
                                :action="route('posts.likes.destroy', [$post, $post->likes()->first()->id])">
                                </x-like-button>

                                @else

                                <x-like-button 
                                :count="$post->likes->count()"
                                status='like'  
                                :action="route('posts.likes.store',$post)">
                                </x-like-button>

                                @endif

                            @endauth



                        </div>

                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                {{-- most commented post --}}

                <h2 class="text-center text-secondary">{{ __('most_comment') }}</h2>
                <x-most-active>
                    @foreach ($mostCommentedPosts as $most)

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">

                                <a href=""> {{ $most->title }}</a>
                                <p>
                                    <x-badge-tag type="success">{{ $most->comments_count }} comment</x-badge-tag>
                                </p>
                            </li>
                        </ul>
                    @endforeach
                </x-most-active>

                {{-- most active users --}}

                <h2 class="text-center text-secondary">{{ __('most_active_users') }}</h2>
                <x-most-active :users="collect($mostActiveUsers)->pluck('name')"></x-most-active>

                {{-- active users last month --}}

                <h2 class="text-center text-secondary">{{ __('most_active_users_last_months') }}</h2>
                <x-most-active :users="collect($activeUsersLastMonth)->pluck('name')">
                </x-most-active>



            </div>
        </div>
    </div>

@endsection
