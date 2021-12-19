@extends('layouts.app')

@section('content')
@if (session()->has('status'))
    {{session()->get('status')}}
@endif
    <div class="container-fluid mt-5">
        <div class="col-md-12">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">description</th>
                <th scope="col">category name</th>
                <th scope="col">author</th>
                <th scope="col">photo</th>
                <th scope="col">actions</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                
                <tr>
                  <th scope="row">{{$post->id}}</th>
                  <td>{{$post->title}}</td>
                  <td>{{$post->description}}</td>
                  <td>{{$post->category->name ?? ""}}</td>
                  <td>{{$post->user->name}}</td>

                  @if ($post->image)
                  <td><img style="width: 60px;height:60px" src="{{$post->image->url()}}" class="card-img-top" alt="...">
                  </td>
                  @endif

                  <td>                      
                    <form action="{{route('delete',$post->id)}}" method="post" class="d-flex">
                      @csrf
                      @method('DELETE')

                      @can('delete', $post)
                      <button class="btn btn-danger">delete</button>
                      @endcan

                      @cannot('delete',$post)
                        <span class="badge bg-danger">you can't delete this post</span>
                      @endcannot
                      
                      @can('update',$post)
                        <a href="{{route('edit',$post->id)}}" class="btn btn-warning">update</a>
                      @endcan

                        <a href="{{route('details',$post->id)}}" class="btn btn-secondary">show</a>

                      </form>
                  </td>
                    
                </tr>
                    
                @empty
                    <h2 class="text-secondary">no data found</h2>
                @endforelse
            </tbody>
          </table>
          {{-- {{$posts->links()}} --}}
        </div>
    </div>
@endsection