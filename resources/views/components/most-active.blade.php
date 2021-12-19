
 @if (empty(trim($slot)))
     @foreach ($users as $user)
         <ul class="list-group list-group-flush">
             <li class="list-group-item">

                 <a href=""> {{ $user }}</a>

             </li>
         </ul>
     @endforeach
 @else
     {{ $slot }}
 @endif
