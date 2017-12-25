
<!doctype html>
<html lang="en">
<head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
    <style>
        body{
            background: #293a46;
            font-family: 'Roboto', sans-serif;
        }
        .st{
            border-radius: 10px;
            background: transparent;
            border: none;
        }
        .list-group-item:first-child.st{
            border-radius: 10px;
        }
        .active-item{
            background: #4f899d;
        }
        .card-box,
        .info,
        .chart-card{
            background: #364b57;
            padding: 5px;
            transition: .2s;
        }
        .card-box:hover{
            background: #205872;
            border: black;
            box-shadow: 2px 2px 2px 2px rgba(17, 12, 36, 0.1);
        }
        .card-box-title{
            font-size: 20px;
        }
        .main-quantity{
            text-align: right;
            margin-right: 30px;
            font-size: 30px;
            margin-bottom: -1px;
            font-weight: bold;
        }
        .section-button,
        .delete-button,
        .add-button{
            background: transparent;
            border: none;
            color:white;
        }
        .section-button:hover,
        .section-button:active,
        .section-button:focus,
        .delete-button:hover,
        .delete-button:active,
        .delete-button:focus,
        .add-button:hover,
        .add-button:active,
        .add-button:focus{
            outline: none;
        }
        .delete-button,
        .add-button{
            position:absolute;
            right:0;
        }
        .add-button{
            margin-top: -28px;
            margin-right:5px;
        }
        .element{
            background: #364b57;
            margin-top: 5px;
            position:relative;
        }
        .details{
            background: inherit;border: none;
        }
        .details:hover{
            background: #364b57;
        }
        .info-list{
            background: transparent;
            padding: 5px;
            min-height: 60px;
            border:none;
            max-height: 200px;
            overflow: auto;
        }
        ::-webkit-scrollbar {
            display: none;
        }
        li,
        li > button{
            cursor: pointer;
        }
        .form-control {
            width:120px;
        }
        .popover{
            max-width:1000px;
        }

        #category-details{
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 999; /* Sit on top */
            left: 10%;
            top: 20%;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            /*background-color: rgb(0,0,0); /* Fallback color */
            /*background-color: rgba(182, 182, 182, 0.4); /* white w/ opacity */
            transition: .2s;
        }
        .category-details-item{
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            /*width: 80%; /* Could be more or less, depending on screen size */
        }
        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 244, 246, 0.4);
            z-index: 1;
            transition: .2s;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark" role="navigation" style="background: transparent">
    <a class="navbar-brand" href="#">Shisei Sekai</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Foro<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card" style="background: transparent;border: none">
                <div class="card-body">
                    <span style="color: #17c9e0">Menú</span>
                    <ul class="list-group text-white" style="margin-top: 10px">
                        <li class="list-group-item st active-item"><button id="main" class="section-button selector">Principal</button></li>
                        <li class="list-group-item st"><button id="users" class="section-button selector">Usuarios</button></li>
                        <li class="list-group-item st"><button id="roles" class="section-button selector">Roles</button></li>
                        <li class="list-group-item st"><button id="categories" class="section-button selector">Categorias</button></li>
                        <li class="list-group-item st"><button id="affiliates" class="section-button selector">Afiliados</button></li>
                        <li class="list-group-item st"><button id="items" class="section-button selector">Items</button></li>
                        <li class="list-group-item st"><button id="vendors" class="section-button selector">Vendedores</button></li>
                        <li class="list-group-item st"><button id="shops" class="section-button selector">Tiendas</button></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-10">
            <!-- main Section -->
            <div id="mainSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Usuarios</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Roles</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Items</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Tiendas</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Vendedores</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Afiliados</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Fichas de personaje</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Fichas de combate</span>
                                <p class="main-quantity">50</p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <div class="col">
                            <div class="card" style="border: none">
                                <div class="card-body chart-card">
                                    <h4 class="card-title text-center text-white">Estadisticas</h4>
                                    <canvas id="myChart" width="300" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
            <!--  USERS -->
            <div id="usersSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear usuario</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card text-white" style="border:none;background: transparent">
                                <!-- Every li is a user -->
                                <ul class="list-group list-group-flush" style="border:none;margin-top: 20px">
                                    <li class="list-group-item element" id="element1" style="">
                                        <div class="info" id="userInfo1">User name<button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="detailsusers1">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col justify-content-center text-center">
                                                            <!-- User name -->
                                                            <h4 class="card-title text-center">User name</h4>
                                                            <!-- User Avatar -->
                                                            <img src="https://u.rindou.moe/Aztic_avatar.jpg" style="width: 150px;height: 150px;object-fit: cover;border-radius: 50%">
                                                            <!-- Main Role -->
                                                            <h6 class="card-subtitle mb-2" style="margin-top: 10px">Main Role</h6>
                                                            <!-- User Items -->
                                                        </div>
                                                        <div class="col" style="margin-top: 80px">
                                                            <p id="user1Money">Dinero: 50</p>
                                                            <p style="margin-top: -15px" id="user1Exp">Exp: 200</p>
                                                            <p style="margin-top: -15px" id="user1Messages">Mensajes: 700</p>
                                                        </div>
                                                        <div class="col">
                                                            <!-- POSSIBLE ROLES FORM -->
                                                            <div id="user1PossibleRoles" class="invisible" style="position:absolute">
                                                                <form class="form-inline" role="form">
                                                                    <div class="form-group">
                                                                        <select class="form-control mr-sm-2" id="roleToAdd1">

                                                                        </select>
                                                                        <button type="button" class="btn btn-dark float-right add-role-button" data-dismiss="modal" id="addRoleToUser1">Añadir</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div style="position:relative">
                                                                <h6 class="text-center">Roles</h6>
                                                                <button type="button" class="float-right add-button" id="addRole1" data-placement="top" data-toggle="popover" data-title="add role" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                                            </div>
                                                            <div class="card info-list">
                                                                <ul class="list-group list-group-flush" id="user1Roles">
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role1">Rol 1 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role2">Rol 2 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role3">Rol 3 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role4">Rol 4 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role5">Rol 5 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role6">Rol 6 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position:relative" id="user1Role7">Rol 7 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <!-- ITEMS FORM -->
                                                            <div style="position:relative">
                                                                <h6 class="text-center">Items</h6>
                                                                <button type="button" class="float-right add-button"><i class="material-icons">add</i></button>
                                                            </div>

                                                            <div class="card info-list">
                                                                <ul class="list-group list-group-flush" id="user1Items">
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item1">Item 1 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item2">Item 2 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item3">Item 3 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item4">Item 4 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item5">Item 5 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item6">Item 6 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                    <li class="list-group-item st" style="position: relative" id="user1Item7">Item 7 <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item element" id="element2">
                                        <div class="info" id="elementInfo2">Dapibus ac facilisis in <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="details2">
                                            <div class="card-body">
                                                <h4 class="card-title">User name</h4>
                                                <h6 class="card-subtitle mb-2 text-muted">Main Role</h6>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item element" id="element3">
                                        <div class="info" id="elementInfo3">Vestibulum at eros <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="details3">
                                            <div class="card-body">
                                                <h4 class="card-title">User name</h4>

                                                <h6 class="card-subtitle mb-2 text-muted">Main Role</h6>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ITEMS FORM, it's not necessary to copy it in every user, since you can add the same item multiple times -->
                <div id="possibleItems" class="invisible" style="position:absolute">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <select class="form-control mr-sm-2" id="itemToAdd">

                            </select>
                            <button type="button" class="btn btn-dark float-right" data-dismiss="modal" id="addItemToUser">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END USERS -->
            <!-- ROLES -->
            <div id="rolesSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear rol</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card text-white" style="border:none;background: transparent">
                                <!-- Every li is a role -->
                                <ul class="list-group list-group-flush" style="border:none;margin-top: 20px">
                                    <li class="list-group-item element" id="element1" style="">
                                        <div class="info" id="rolesInfo1">User name<button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="detailsroles1">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col justify-content-center text-center">
                                                            <!-- Role name -->
                                                            <h4 class="card-title text-center">Role name</h4>
                                                        </div>
                                                        <div class="col">
                                                            <!-- PERMISSIONS FORM-->
                                                            <div>
                                                                <form class="form-inline" role="form">
                                                                    <div class="form-group">
                                                                        <select multiple class="form-control mr-sm-2" id="role1Permissions">
                                                                            <option value="1<<0">Admin</option>
                                                                            <option value="1<<1">Crear temas</option>
                                                                            <option value="1<<2">Borrar temas</option>
                                                                            <option value="1<<3">Mover temas</option>
                                                                            <option value="1<<4">Crear posts</option>
                                                                            <option value="1<<5">Borrar posts</option>
                                                                            <option value="1<<6">Editar posts</option>
                                                                        </select>
                                                                        <button type="button" class="btn btn-dark float-right add-role-button" data-dismiss="modal" id="addRoleToUser1">Añadir</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item element" id="element2">
                                        <div class="info" id="elementInfo2">Dapibus ac facilisis in <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="details2">
                                            <div class="card-body">
                                                <h4 class="card-title">User name</h4>
                                                <h6 class="card-subtitle mb-2 text-muted">Main Role</h6>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item element" id="element3">
                                        <div class="info" id="elementInfo3">Vestibulum at eros <button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="details3">
                                            <div class="card-body">
                                                <h4 class="card-title">User name</h4>

                                                <h6 class="card-subtitle mb-2 text-muted">Main Role</h6>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROLES -->

            <!-- ITEMS -->
            <div id="itemsSection" class="section">
                <div class="container" >
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear item</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white">
                                <img class="card-img-top center" src="https://u.rindou.moe/fJOqFEkapkFhZ0a5YvRp.png" style="width:42px;height: 42px">
                                <div class="card-body">
                                    <h4 class="card-title">esfera</h4>
                                    <p class="card-text">Esto es la descripción del item.</p>
                                    <p class="card-text">Brillante, ¿no?</p>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white">
                                <img class="card-img-top center" src="https://u.rindou.moe/fJOqFEkapkFhZ0a5YvRp.png" style="width:42px;height: 42px">
                                <div class="card-body">
                                    <h4 class="card-title">esfera</h4>
                                    <p class="card-text">Esto es la descripción del item.</p>
                                    <p class="card-text">Brillante, ¿no?</p>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white">
                                <img class="card-img-top center" src="https://u.rindou.moe/fJOqFEkapkFhZ0a5YvRp.png" style="width:42px;height: 42px">
                                <div class="card-body">
                                    <h4 class="card-title">esfera</h4>
                                    <p class="card-text">Esto es la descripción del item.</p>
                                    <p class="card-text">Brillante, ¿no?</p>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white">
                                <img class="card-img-top center" src="https://u.rindou.moe/fJOqFEkapkFhZ0a5YvRp.png" style="width:42px;height: 42px">
                                <div class="card-body">
                                    <h4 class="card-title">esfera</h4>
                                    <p class="card-text">Esto es la descripción del item.</p>
                                    <p class="card-text">Brillante, ¿no?</p>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white">
                                <img class="card-img-top center" src="https://u.rindou.moe/fJOqFEkapkFhZ0a5YvRp.png" style="width:42px;height: 42px">
                                <div class="card-body">
                                    <h4 class="card-title">esfera</h4>
                                    <p class="card-text">Esto es la descripción del item.</p>
                                    <p class="card-text">Brillante, ¿no?</p>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <!-- END ITEMS -->

            <!-- AFFILIATES -->
            <div id="affiliatesSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear afiliado</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END AFFILIATES -->

            <!-- VENDORS -->
            <div id="vendorsSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear vendedor</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOPS -->
            <div id="shopsSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear tienda</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- CATEGORIES -->
            <div id="categoriesSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" style="margin-top: 5px">Crear categoría</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6" style="margin-top: 5px">
                            <div class="card card-box text-white category-item">
                                <img class="card-img-top center" src="https://a.pomf.cat/ewfhqp.jpg" style="width:100%;height: 200px;object-fit: cover;object-position: center left">
                                <div class="card-body">
                                    <h4 class="card-title">Anuncios</h4>
                                    <p class="card-text">Esto es una categoría</p>
                                    <p class="card-text">Inteligente, ¿no?</p
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details Modal -->
                    <div class="container" id="category-details">

                        <div class="row">
                            <!-- Preview -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card info text-white">
                                    <img class="card-img-top center" src="https://a.pomf.cat/ewfhqp.jpg" style="width:100%;height: 200px;object-fit: cover;object-position: center left">
                                    <div class="card-body">
                                        <h4 class="card-title">Anuncios</h4>
                                        <p class="card-text">Esto es una categoría</p>
                                        <p class="card-text">Inteligente, ¿no?</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Details -->
                            <div class="col-md-9 col-sm-6">
                                <div class="card info text-white">
                                    <div class="card-body">
                                        <h4 class="card-title">Anuncios</h4>
                                        <div class="row">
                                            <div class="col">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="editCategoryName">Nombre</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryName" aria-describedby="emailHelp" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryDescription">Descript</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryDescription" aria-describedby="emailHelp" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryImage">Imagen</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryImage" aria-describedby="emailHelp" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryColor">Color</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryColor" aria-describedby="emailHelp" placeholder="Título">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <div style="position:relative">
                                                    <h6 class="text-center">Channels</h6>
                                                    <button type="button" class="float-right add-button" id="addChannelForm" data-placement="top" data-toggle="popover" data-title="add channel" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                                </div>
                                                <!-- Every li is a channel -->
                                                <div class="card info-list">
                                                    <ul class="list-group list-group-flush" id="user1Roles">
                                                        <li class="list-group-item st" style="position:relative" id="user1Role1">Channel 1 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role2">Channel 2 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role3">Channel 3 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role4">Channel 4 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role5">Channel 5 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role6">Channel 6 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                        <li class="list-group-item st" style="position:relative" id="user1Role7">Channel 7 <button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-primary">Editar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CATEGORIES -->

        </div>
    </div>
</div>
<div id="overlay">
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script> <!-- Fancy charts -->
<script src="{{asset('js/bootstrap-colorpicker.min.js')}}"></script> <!-- Fancy colorpicker -->
<script>
    /*
    $(function () {
        $('[data-toggle="popover"]').popover()
    });*/
    $("#addRole1").popover({
        html: true,
        content: function() {
            return $('#user1PossibleRoles').html();
        }
    });

</script>
<script>
    $(document).ready(function(){
        let numberPattern = /\d+/g;
        $('.section').hide();
        $('#mainSection').fadeIn();
        $('.details').hide();
        let prev = "main";
        /** Change category **/
        $('.selector').click(function(){
            //Hide the previous menu and show the current one
            let current = this.id;
            $("#"+prev+"Section").fadeOut(function(){
                $("#"+current+"Section").fadeIn();
            });
            $("#"+prev).parent().toggleClass("active-item");
            prev = current;
            $(this).parent().toggleClass("active-item");
            /*
            console.log(this.id);
            console.log($(".active-item").children().attr("id"));
            */
        });
        /** Show details of each element **/
        $('.info').click(function(){
            let infoId = this.id.match(numberPattern);
            $('#details'+prev+infoId).toggle();
        });

        /** Show details of that category **/
        $('.category-item').click(function(){
            $('#overlay').css("display","block");
            $('#category-details').css("display","block");

        });
        /** Hide that modal **/
        $('#overlay').click(function(){
           $('#category-details').css("display","none");
           $('#overlay').css("display","none");
        });
    });
</script>
<script>
    /** Presentation chart **/
    var users = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(users, {
        type: 'line',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            datasets: [{
                label: 'Usuarios registrados',
                data: [12, 19, 3, 5, 2, 3,1,8,9,2,22,25],
                backgroundColor: [
                    'rgba(102, 178, 255, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(102,178,255,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Threads',
                data: [5, 2, 4, 7, 15, 18,6,4,3,1,17,99],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1

            },
            {
                label: 'Posts',
                data: [27, 56, 78, 65, 88, 9,86,81,70,65,40,37],
                backgroundColor: [
                    'rgba(128, 255, 0, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(128,255,0,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1

            }]

        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>


