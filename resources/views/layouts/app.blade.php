<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    {{-- logo --}}
    <link rel="icon" type="png/image" href="images/logo/logo.png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Raleway" rel="stylesheet">
    
    {{-- <link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css"> --}}
	
    <!-- Styles -->
    
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
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
        
        .bg-dark-blue{
            background-color:#407A79;
        }
        #sticky-footer {
            flex-shrink: none;
        }
        #contact-us a:hover{
            color:#ABD2DE;
        }
        #to-top {
            position: fixed;
            right: 20px;
            bottom: 30px;
            z-index: 999;
            padding:8px 12px;
            margin: 0;
            border: 0;
            border-radius: 5px;
            background:#7BC7C6;
        }
        a#to-top:hover{
            -webkit-transform: translateY(-10px);
            -webkit-transition: all .8s ease;
        }
        a#to-top:hover i{
            color:#7A4F4C;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo/logo.png')}}" alt="..." class="d-inline-block align-top logo">
                    <span class="app_name">{{ config('app.name', 'Ticket') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/movies">Movies</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#contact-us">Contact</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="">Profile</a>
                              
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{ route('logout') }}" 
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
        <footer  class="bg-dark text-white-50 footer">
            <div class="container text-center">
                <small>Copyright &copy;YCTB</small>
            </div>
        </footer>
        <a href="#app" id="to-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>
    @stack('vue')
</body>
</html>
