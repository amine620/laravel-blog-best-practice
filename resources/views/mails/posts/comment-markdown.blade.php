@component('mail::message')
    # some one comment your post





  @component('mail::panel')
     <a href="{{route('users.show',$comment->commentable->user)}}"> {{ $comment->commentable->user->name}}</a> said <a href="{{route('commentPage',$comment->commentable->id)}}">{{ $comment->content }}</a>  
 @endcomponent


  
         

    {{ config('app.name') }}
@endcomponent
