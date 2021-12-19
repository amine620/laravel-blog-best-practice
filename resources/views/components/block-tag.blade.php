
@foreach ($tags as $tag)

<span class="badge badge-info"><a style="color: white" href="{{route('posts-by-tags',['id'=>$tag->id])}}"> #{{$tag->name}}</a></span>
    
@endforeach
