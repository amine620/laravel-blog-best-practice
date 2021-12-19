
      @if ($status=='unlike')
          
      <form action="{{$action}}" method="post"
          id="like-form">
          @csrf
          @method('DELETE')
          <button style="border: none;background-color:white;float:right">
              <i class="fa fa-thumbs-up mb-2 text-danger"></i>
          </button>
          
         <span>({{$count}}) like</span>
      </form>

      @else

      <form action="{{ $action }}" method="post" id="like-form">
          @csrf
          <button style="border: none;background-color:white;float:right">
              <i class="fa fa-thumbs-up mb-2 text-info"></i>
          </button>

          <span>({{$count}}) like</span>

      </form>
          
      @endif
