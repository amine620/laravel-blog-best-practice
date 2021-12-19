@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="col-md-8 offset-2">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">actions</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                  <th scope="row">{{$category->id}}</th>
                  <td>{{$category->name}}</td>
                  <td>                      
                      <form action="{{route('delete',$category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>

                        <a href="{{route('edit',$category->id)}}" class="btn btn-warning">update</a>

                      </form>
                  </td>
                </tr>
                    
                @empty
                    <h2 class="text-secondary">no data found</h2>
                @endforelse
            </tbody>
          </table>
        </div>
    </div>
@endsection