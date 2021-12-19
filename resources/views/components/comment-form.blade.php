   @auth

       <form action="{{$action}}" class="fomr-group col-md-8 offset-2 mt-2" method="POST">
           @csrf
           <input type="text" class="form-control" name="content" placeholder="comment..">
           <button class="btn btn-secondary form-control mt-2">add comment</button>
       </form>

   @else
       <a href="{{ route('login') }}" class="class btn btn-primary">go to login</a>
   @endauth
