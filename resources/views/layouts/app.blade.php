<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- logo --}}
    <link rel="icon" type="png/image" href="images/logo/logo.png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Raleway" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        
        .navbar-collapse {
            max-height: calc(100vh - 60px);
            overflow-y: auto; }
       .logo{
           width:30px;
           height:30px;
       }
        .app_name{
            font-size:22px;
            font-weight:600;
        }
        
        /*.banner-caption{
            border:1px solid #666;
            background:rgba(128,128,128,0.5);
            border-radius:10px;
        }*/
        header.masthead {
        height: 100vh;
        min-height: 500px;
        background:linear-gradient(to bottom, rgba(255,255,255, 0.1) 0%, rgba(128,128,128,0.5) 100%), url('images/cover1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        }
        /*.carousel-item {
            height: 65vh;
            min-height: 500px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-color:#8DB8A0;
            position:relative;
        }*/
       
        /*.movie-info{
            border:2px solid #fff;
            width:150px;
            color:#fff;
            transition: width .20s ease-out;
        }
        .movie-info:hover{
            color:#eee;
            width:120px;
        }*/
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="images/logo/logo.png" alt="..." class="d-inline-block align-top logo">
                    <span class="app_name">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Movies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cinemas">Cinemas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                    <a class="dropdown-item" href="#">Your Tickets</a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        {{-- <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; Your Website</small>
            </div>
        </footer> --}}
    </div>
</body>
</html>
