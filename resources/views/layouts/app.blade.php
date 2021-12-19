
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Sidebar - Start Bootstrap Template</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://startbootstrap.github.io/startbootstrap-simple-sidebar/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('home')}}">home page</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('categories.create')}}">add new category</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('create')}}">add new post</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('categories.list')}}">categories list</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('list')}}">posts list</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <div class="dropdown-divider">
                                        </div>
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                        </a>
 
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                         @csrf
                                     </form>                           
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                 @yield('content')
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://startbootstrap.github.io/startbootstrap-simple-sidebar/js/scripts.js"></script>
    </body>
</html>
