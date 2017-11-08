
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Shisei Sekai Forum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('img/favicon.ico') }}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
<div id="wrapper">

    <!-- Sidebar  -->
    <div class="overlay"></div>
    <nav class="fixed-top navbar-toggleable-md navbar-inverse bg-inverse" id="sidebar-wrapper" role="navigation">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a class="nav-link active" href="#">
                    Shisei Sekai
                </a>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
            </li>
            <li>
                <a class="nav-link" href="https://discord.gg/Bgg5z8P">Discord server</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                    @guest
                        Usuario
                    @endguest
                </a>
                <!--<span class="caret"></span>-->
                <ul class="dropdown-menu" role="menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class="dropdown-header">Tus cosas de usuario</li>
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
    </nav>

    <!-- Page content -->
    <div class="page-content-wrapper">
        <button type="button" class="hamburger hamburger--slider" id="wrapperButton" data-toggle="offcanvas">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
</div>
<!-- Header -->
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="header"></div>
    </div>
</div>

<br>
@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>-->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>