<!DOCTYPE html>
<html>
<head>
    <title>Shisei Sekai</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<!-- Mobile navbar -->
<div class="hide-on-med-and-up">
    <nav class="blue nav-mobile" style="">
        <div class="nav-wrapper">
            <span class="brand-logo">Shisei</span>
            <ul id="nav-mobile">
                <li class="left"><a href="/">home</a></li>
                <li class="right"><a class="dropdown-button" href="#" data-activates="dropdownMobile">
                        @auth
                            {{Auth::user()->name}}
                        @endauth
                        @guest
                            Usuario
                        @endguest
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="dropdownMobile" class="dropdown-content">
                        @guest
                            <li class="dropdown-item"><a href="{{route('login')}}">Log in</a></li>
                            <li class="dropdown-item"><a href="{{route('register')}}">Registro</a></li>
                        @endguest
                        @auth
                            <li class="dropdown-item"><a href="/user/{{Auth::user()->name}}">Mi perfil</a></li>
                            <li class="dropdown-item">
                                <a  class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

<ul id="dropdown2" class="dropdown-content">
    @guest
        <li class="dropdown-item"><a href="{{route('login')}}">Log in</a></li>
        <li class="dropdown-item"><a href="{{route('register')}}">Registro</a></li>
    @endguest
    @auth
            <li class="dropdown-item"><a href="/user/{{Auth::user()->name}}">Mi perfil</a></li>
            <li class="dropdown-item">
                <a  class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
    @endauth
</ul>
<!-- desktop navbar -->
<nav class="hide-on-small-only blue row-full" style="top:0">
    <div class="nav-wrapper">
        <span class="brand-logo center">Shisei Sekai</span>
        <ul id="nav" class="">
            <li><a href="/" style="color:white">Home</a></li>
            <li><a href="#"><a class="dropdown-button" href="#" data-activates="dropdown2" style="color:white">
                        @auth
                            {{Auth::user()->name}}
                        @endauth
                        @guest
                            Usuario
                        @endguest
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </a>
            </li>

            <li class="right"><a href="#contact" style="color:white">Contacto</a></li>
            <li class="right"><a href="http://github.com/Shisei-sekai/Laravel-Shisei" style="color:white">Github</a></li>
        </ul>

    </div>
</nav>

<body>


<div id="index-banner" class="header-image hide-on-med-and-down" style="background: url('https://a.pomf.cat/vpcrre.jpg');background-repeat: no-repeat;background-position: center center; background-size: cover"></div>

@yield('content')
</body>

</html>
