<!doctype html>
<html lang="en">
<head>
    <title>Shisei Sekai admin panel</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Fancy colorpicker -->
    <link href="{{ asset('css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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


<!-- MODALS -->
<div class="container element-creation-modal" id="createRoleModal">
    <div class="row">
        <div class="col">
            <div class="card info text-white">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col justify-content-center">
                                <h4 class="card-title">Crear Rol</h4>
                                <form class="form-inline" role="form">
                                    <div class="form-group justify-content-center align-content-center">
                                        <select multiple class="form-control" id="createRolePermissions" style="height: 160px;border:none">
                                            <option value="1<<0">Admin</option>
                                            <option value="1<<1">Crear temas</option>
                                            <option value="1<<2">Borrar temas</option>
                                            <option value="1<<3">Mover temas</option>
                                            <option value="1<<4">Crear posts</option>
                                            <option value="1<<5">Borrar posts</option>
                                            <option value="1<<6">Editar posts</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <div class="form">
                                    <div class="form-group">
                                        <label for="createRoleName">Nombre:</label>
                                        <input type="text" class="form-control" id="createRoleName" placeholder="Nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="createRoleColorValue" class="col-form-label">Color</label>
                                        <div id="createRoleColor" class="input-group colorpicker-component">
                                            <input type="text" id="createRoleColorValue" class="form-control" />
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right" id="createRole">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container element-creation-modal" id="createCategoryModal">
    <div class="row">
        <div class="col">
            <div class="card info text-white">
                <div class="card-body">
                    <h4 class="card-title">Crear Categoría</h4>
                    <div class="row">
                        <div class="col">
                            <form>
                                <div class="form-group">
                                    <label for="createCategoryName">Nombre</label>
                                    <input type="text" class="form-control-lg" id="createCategoryName" placeholder="Título">
                                </div>
                                <div class="form-group">
                                    <label for="createCategoryDescription">Descript</label>
                                    <input type="text" class="form-control-lg" id="createCategoryDescription" placeholder="Título">
                                </div>
                                <div class="form-group">
                                    <label for="createCategoryImage">Imagen</label>
                                    <input type="text" class="form-control-lg" id="createCategoryImage" placeholder="Título">
                                </div>
                                <div class="form-group">
                                    <label for="createCategoryColorValue">Color</label>
                                    <div id="createCategoryColor" class="input-group colorpicker-component">
                                        <input type="text" id="createCategoryColorValue" class="form-control" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-left" id="createCategory">Crear</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container element-creation-modal" id="createItemModal">
    <div class="row">
        <div class="col">
            <div class="card info text-white">
                <div class="card-body">
                    <h4 class="card-title">Crear Item</h4>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="createItemName">Nombre</label>
                                <input type="text" class="form-control-lg" id="createItemName"/>
                            </div>


                            <div class="form-group">
                                <label for="createItemDescription">Descrip</label>
                                <input type="text" class="form-control-lg" id="createItemDescription"/>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="createItemBuyValue">Precio de compra</label>
                                <input type="number" class="form-control-lg" id="createItemBuyValue"/>
                            </div>


                            <div class="form-group">
                                <label for="createItemSellValue">Precio de venta</label>
                                <input type="number" class="form-control-lg" id="createItemSellValue"/>
                            </div>


                            <div class="form-group">
                                <label for="createItemIcon">Imagen</label>
                                <input type="text" class="form-control-lg" id="createItemIcon"/>
                            </div>
                        </div>

                    </div>
                    <button type="button" class="btn btn-primary" id="createItem">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container element-creation-modal" id="createVendorModal">
    <div class="row">
        <div class="col">
            <div class="card info text-white" >
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <h4 class="card-title">Crear vendedor</h4>
                            <div class="col">
                                <form>
                                    <div class="form-group">
                                        <label for="createVendorName">Nombre</label>
                                        <input type="text" class="form-control-lg" id="createVendorName" placeholder="Nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="createVendorDescription">Descript</label>
                                        <input type="text" class="form-control-lg" id="createVendorDescription" placeholder="Descripción">
                                    </div>
                                    <div class="form-group">
                                        <label for="createVendorImage">Imagen</label>
                                        <input type="text" class="form-control-lg" id="createVendorImage" placeholder="Imagen">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right" id="createVendor">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container element-creation-modal" id="createShopModal">
    <div class="row">
        <div class="col">
            <div class="card info text-white">
                <div class="card-body">
                    <h4 class="card-title">Crear Tienda</h4>
                    <div class="row">
                        <div class="col">
                            <form>
                                <div class="form-group">
                                    <label for="createShopName">Nombre</label>
                                    <input type="text" class="form-control-lg" id="createShopName" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="createShopDescription">Descript</label>
                                    <input type="text" class="form-control-lg" id="createShopDescription" placeholder="Descripción">
                                </div>
                                <div class="form-group" style="position:relative">
                                    <label for="createShopVendorSelect">Vendedo</label>
                                    <select class="form-control-lg" id="createShopVendorSelect" style="width:280px">

                                    </select>
                                </div>
                                <div class="form-check" style="margin-top: 15px">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="createShopIsActive">
                                        Activa
                                    </label>
                                </div>
                            </form>
                        </div>

                    </div>
                    <button type="button" class="btn btn-primary float-right" id="createShop">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                <p class="main-quantity" id="userQuantity">{{\App\User::count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Roles</span>
                                <p class="main-quantity" id="roleQuantity">{{\App\Role::count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Items</span>
                                <p class="main-quantity" id="itemQuantity">{{\App\Item::count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Tiendas</span>
                                <p class="main-quantity" id="shopQuantity">{{\App\Shop::count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Vendedores</span>
                                <p class="main-quantity" id="vendorQuantity">{{\App\Vendor::count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Afiliados</span>
                                <p class="main-quantity" id="affiliateQuantity">0</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Fichas de personaje</span>
                                <p class="main-quantity">0</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-white" style="margin-top: 30px">
                            <div class="card-box">
                                <span class="card-box-title">Fichas de combate</span>
                                <p class="main-quantity">0</p>
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
                        <div class="col">
                            <div class="card text-white" style="border:none;background: transparent">
                                <!-- Every li is a user -->
                                <ul class="list-group list-group-flush" style="border:none;margin-top: 20px" id="userList">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END USERS -->

            <!-- ROLES -->
            <div id="rolesSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" id="openRoleModal" style="margin-top: 5px">Crear rol</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card text-white" style="border:none;background: transparent">
                                <!-- Every li is a role -->
                                <ul class="list-group list-group-flush" style="border:none;margin-top: 20px" id="roleList">

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
                                <h4 class="card-box-title text-center" id="openItemModal"style="margin-top: 5px">Crear item</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="itemList">

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
                                <h4 class="card-box-title text-center" id="openVendorModal" style="margin-top: 5px">Crear vendedor</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card text-white" style="border:none;background: transparent">
                                <!-- Every li is a vendor -->
                                <ul class="list-group list-group-flush" style="border:none;margin-top: 20px" id="vendorList">
                                    <li class="list-group-item element" id="element1" style="">
                                        <div class="info" id="vendorInfo1">Vendor name<button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></div>
                                        <div class="card details" id="detailsvendors1">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col justify-content-center text-center">
                                                            <!-- Vendor name -->
                                                            <h4 class="card-title text-center">Vendor name</h4>
                                                            <!-- Vendor image -->
                                                            <img src="https://u.rindou.moe/Aztic_avatar.jpg" style="width: 150px;height: 150px;object-fit: cover;border-radius: 50%">
                                                        </div>
                                                        <div class="col">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="editVendorName">Nombre</label>
                                                                    <input type="text" class="form-control-lg" id="editVendorName" aria-describedby="emailHelp" placeholder="Título">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editVendorDescription">Descript</label>
                                                                    <input type="text" class="form-control-lg" id="editVendorDescription" aria-describedby="emailHelp" placeholder="Título">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editVendorImage">Imagen</label>
                                                                    <input type="text" class="form-control-lg" id="editVendorImage" aria-describedby="emailHelp" placeholder="Título">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END VENDORS -->

            <!-- SHOPS -->
            <div id="shopsSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" id="openShopModal" style="margin-top: 5px">Crear tienda</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="shopList">

                    </div>

                    <div class="container" id="shop-details">


                        <div class="row">
                            <div class="col">
                                <div class="card info text-white">
                                    <div class="card-body">
                                        <h4 class="card-title" id="shop-title">Shop title</h4>
                                        <div class="row">
                                            <div class="col">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="editShopName">Nombre</label>
                                                        <input type="text" class="form-control-lg" id="editShopName" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editShopDescription">Descript</label>
                                                        <input type="text" class="form-control-lg" id="editShopDescription" placeholder="Título">
                                                    </div>
                                                    <div class="form-group" style="position:relative">
                                                        <span>Actual: <b id="currentVendor"></b></span><br>
                                                        <label for="vendorSelect">Vendedo</label>
                                                        <select class="form-control-lg vendorSelect" id="shopEditVendorSelect" style="width:280px">

                                                        </select>
                                                        <button type="button" class="btn btn-dark" id="changeShopVendor" style="position:absolute;margin-left:5px">cambiar</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <div style="position:relative">
                                                    <h6 class="text-center">Items</h6>
                                                    <button type="button" class="float-right add-button" id="addItemToShopForm" data-placement="top" data-toggle="popover" data-title="add item" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                                </div>
                                                <div id="allItemShop" class="invisible" style="position:absolute">
                                                    <form class="form-inline" role="form">
                                                        <div class="form-group">
                                                            <select class="form-control mr-sm-2" id="shopItemToAdd">

                                                            </select>
                                                            <button type="button" class="btn btn-dark float-right add-item-to-shop-button" id="addItemToShop">Añadir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Every li is a item -->
                                                <div class="card info-list">
                                                    <ul class="list-group list-group-flush" id="shopItems">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary float-right edit-shop-button" id="editShop">Editar</button>
                                        <button type="button" class="btn btn-danger float-left" id="deleteShop">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END SHOPS -->

            <!-- CATEGORIES -->
            <div id="categoriesSection" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 text-white offset-md-9 offset-sm-6" style="margin-top: 30px">
                            <div class="card-box">
                                <h4 class="card-box-title text-center" id="openCategoryModal" style="margin-top: 5px">Crear categoría</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="categoriesList">

                    </div>
                    <!-- Details Modal -->
                    <div class="container" id="category-details">

                        <div class="row">
                            <!-- Preview -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card info text-white">
                                    <img class="card-img-top center" id="categoryPreviewImage" src="https://a.pomf.cat/ewfhqp.jpg" style="width:100%;height: 200px;object-fit: cover;object-position: center left">
                                    <div class="card-body">
                                        <h4 class="card-title" id="categoryPreviewTitle">Not anuncios</h4>
                                        <p class="card-text" id="categoryPreviewDescription">Esto es una categoría</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Details -->
                            <div class="col-md-9 col-sm-6">
                                <div class="card info text-white">
                                    <div class="card-body">
                                        <h4 class="card-title" id="categoryEditTitle">Anuncios</h4>
                                        <div class="row">
                                            <div class="col">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="editCategoryName">Nombre</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryName" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryDescription">Descript</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryDescription" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryImage">Imagen</label>
                                                        <input type="text" class="form-control-lg" id="editCategoryImage" placeholder="Título">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editCategoryColor">Color</label>
                                                        <div id="editCategoryColor" class="input-group colorpicker-component">
                                                            <input type="text" id="editCategoryColorValue" class="form-control" />
                                                            <span class="input-group-addon"><i></i></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <div style="position:relative">
                                                    <h6 class="text-center">Channels</h6>
                                                    <button type="button" class="float-right add-button" id="addChannelForm" data-placement="top" data-toggle="popover" data-title="add channel" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                                </div>
                                                <div id="createChannel" class="invisible" style="position:absolute">
                                                    <form class="form-inline" role="form">
                                                        <div class="form-group">
                                                            <label for="createChannelName">Nombre</label>
                                                            <input type="text" class="form-control-lg" id="createChannelName" placeholder="Título">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="createChannelDescription">Descripció</label>
                                                            <input type="text" class="form-control-lg" id="createChannelDescription" placeholder="Título">
                                                        </div>
                                                        <button type="button" class="btn btn-primary create-channel" id="createChannelButton">Crear</button>
                                                    </form>
                                                </div>
                                                <!-- Every li is a channel -->
                                                <div class="card info-list">
                                                    <ul class="list-group list-group-flush" id="categoryChannels">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary float-right" id="editCategory">Editar</button>
                                        <button type="button" class="btn btn-danger float-left" id="deleteCategory">Borrrar</button>
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
    $(document).ready(function(){
        let currentElementId = -1;
        let numberPattern = /\d+/g;
        $('.section').hide();
        $('#mainSection').fadeIn();
        $('.details').hide();
        let prev = "main";
        /** Change category **/
        $('.selector').click(function(){
            $('.popover').popover('hide');
            $('.element').remove();
            $('.item').remove();
            $('.shop').remove();
            $('.itemAvaliable').remove();
            //Hide the previous menu and show the current one
            let current = this.id;
            $("#"+prev+"Section").fadeOut(function(){
                //$("#"+current+"Section").fadeIn();
            });

            $("#"+prev).parent().toggleClass("active-item");
            //Replace the prev element
            prev = current;
            //Make the menu element active, so it looks fancy and blue
            $(this).parent().toggleClass("active-item");
            //Display the menu, after everything has loaded
            loadinfo(function(){
                $("#"+current+"Section").fadeIn();
            });
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

        /** User details **/
        $('#userList').on('click','.info',function(){
            let infoId = this.id.match(numberPattern);
            $('#details'+prev+infoId).toggle();
        });

        /** Roles details **/
        $('#roleList').on('click','.info',function(){
            let infoId = this.id.match(numberPattern);
            $('#details'+prev+infoId).toggle();
        });

        /** Vendor details **/
        $('#vendorList').on('click','.info',function(){
            let infoId = this.id.match(numberPattern);
            $('#details'+prev+infoId).toggle();
        });

        /** Show details of that shop **/
        $('#shopList').on('click','.shop',function(){
            $('.shop-item').remove();
            $('#overlay').css("display","block");
            $('#shop-details').css("top","20%");
            currentElementId = this.id.match(numberPattern)[0];
            $.ajax({
                url:'/admin/shops/info?id='+currentElementId,
                type:'GET',
                success:function(msg){
                    let info = msg.info;
                    $('#shop-title').text(info.name);
                    $('#editShopName').val(info.name);
                    $('#editShopDescription').val(info.description);
                    $('#currentVendor').text(info.vendor);
                    let items = msg.items;
                    $.each(items,function(index,element){
                        $('#shopItems').append(`<li class="list-group-item shop-item st" style="position:relative" id="shop${info.id}Item${element.id}">${element.name} <button type="button" class="float-right delete-button delete-shop-item-button"><i class="material-icons">clear</i></button></li>`)
                    });
                }
            });
        });

        /** Show details of that category **/
        $('#categoriesList').on('click','.category',function(){
            $('#overlay').css("display","block");
            /*$('#category-details').css("display","block");*/
            //Load category details
            currentElementId = this.id.match(numberPattern)[0];
            $('.channel').remove(); //Delete all previous channels
            console.log(currentElementId);
            $.ajax({
                url:'/admin/categories/details?id='+currentElementId,
                type:'GET',
                success:function(msg){
                    //Edit
                    $('#editCategoryImage').val(msg.image);
                    $('#editCategoryName').val(msg.name);
                    $('#editCategoryDescription').val(msg.description);
                    $('#editCategoryColor').colorpicker('setValue',msg.color);
                    //Preview
                    $('#categoryPreviewImage').attr('src',msg.image);
                    $('#categoryPreviewDescription').text(msg.description);
                    $('#categoryPreviewTitle').text(msg.name);

                }
            });
            //Get channels of that category
            $.ajax({
                url:'/admin/channels?categoryId='+currentElementId,
                type:'GET',
                success:function(msg){
                    $.each(msg,function(index,element){
                        $('#categoryChannels').append(`<li class="list-group-item st channel" style="position:relative" id="category${currentElementId}Channel${element.id}">${element.name}<button type="button" class="float-right delete-button delete-channel-button"><i class="material-icons">clear</i></button></li>`);
                    });
                }
            });
            $('#category-details').css("top","20%");

        });
        /** Hide that modal **/
        $('#overlay').click(function(){
            //$('#category-details').css("display","none");
            $('#category-details').css("top","-100%");
            $('.element-creation-modal').css("top","-100%");
            $('#shop-details').css("top","-100%");
            $('#overlay').css("display","none");
            $('.popover').popover('hide');
        });

        /** CREATE CATEGORY MODAL SECTION **/
        //Open the modal
        $('#openCategoryModal').click(function(){
            $('#createCategoryModal').css("top","20%");
            $('#createCategoryColor').colorpicker('setValue','#e61313');
            $('#overlay').css("display","block");
        });

        $('#createCategory').click(function(){
            let name = $('#createCategoryName').val();
            let description = $('#createCategoryDescription').val();
            let image = $('#createCategoryImage').val();
            let color = $('#createCategoryColorValue').val();
            //Make the ajax
            makeAjax('/admin/categories',{name:name,description:description,image:image,color:color},'post');
            //Hide the modal and overlay
            $('#overlay').css("display","none");
            $('#createCategoryModal').css("top","-100%");
        });
        /** END CREATE CATEGORY MODAL SECTION **/

        /** CREATE ROLE MODAL SECTION **/
        $('#openRoleModal').click(function(){
            $('#createRoleModal').css("top","20%");
            $('#createRoleColor').colorpicker('setValue','#e61313');
            $('#overlay').css("display","block");
        });

        $('#createRole').click(function(){
            let sum = 0;
            let name = $('#createRoleName').val();
            let color = $('#createRoleColorValue').val();
            $("select#createRolePermissions :selected").each(function () {
                sum += eval($(this).attr('value'));
            });
            let data = {name:name,permissions:sum,color:color};
            makeAjax('/admin/roles',data,'post');
            $('#overlay').css("display","none");
            $('#createRoleModal').css("top","-100%");

        });
        /** END CREATE ROLE MODAL SECTION **/

        /** CREATE ITEM MODAL SECTION **/

        $('#openItemModal').click(function(){
            $('#createItemModal').css("top","20%");
            $('#overlay').css("display","block");
        });

        $('#createItem').click(function(){
            let name = $('#createItemName').val();
            let description = $('#createItemDescription').val();
            let buyValue = $('#createItemBuyValue').val();
            let sellValue = $('#createItemSellValue').val();
            let icon = $('#createItemIcon').val();
            makeAjax('/admin/items',{name:name,description:description,buyValue:buyValue,sellValue:sellValue,icon:icon},'POST');
            $('#createItemModal').css("top","-100%");
            $('#overlay').css('display','none');
        });

        /** END CREATE ITEM MODAL SECTION **/


        /** CREATE VENDOR MODAL SECTION **/

        $('#openVendorModal').click(function(){
            $('#createVendorModal').css('top','20%');
            $('#overlay').css('display','block');
        });

        $('#createVendor').click(function(){
            let name = $('#createVendorName').val();
            let description = $('#createVendorDescription').val();
            let image = $('#createVendorImage').val();
            makeAjax('/admin/vendors',{name:name,description:description,image:image},'POST');
            $('#createVendorModal').css('top','-100%');
            $('#overlay').css('display','none');
        });
        /** END CREATE VENDOR MODAL SECTION **/

        /** CREATE SHOP MODAL SECTION **/

        $('#openShopModal').click(function(){
            $('.createShopVendor').remove();
            //Load all possible vendors
            $.ajax({
                url:'/admin/vendors/all',
                type:'GET',
                success:function(msg){
                    $.each(msg,function(index,element){
                        //console.log(element);
                        $('#createShopVendorSelect').append(`<option id="vendor${element.id}" class="createShopVendor">${element.name}</option>`);
                    });
                }
            });
            $('#createShopModal').css('top','20%');
            $('#overlay').css('display','block');
        });

        $('#createShop').click(function(){
            let name = $('#createShopName').val();
            let description = $('#createShopDescription').val();
            let active = $('#createShopIsActive').is(':checked');
            let vendorId = $('#createShopVendorSelect option:selected').attr('id').match(numberPattern)[0];
            makeAjax('/admin/shops',{name:name,description:description,active:active,vendorId:vendorId},'POST');
            $('#createShopModal').css('top','-100%');
            $('#overlay').css('display','none');
        });

        /** END CREATE SHOP MODAL SECTION **/
        function loadinfo(callback){
            console.log("loading");
            switch (prev){
                case "main":
                    console.log("loading main");
                    loadMain();
                    break;
                case "users":
                    console.log("loading users");
                    loadUsers();
                    break;
                case "categories":
                    console.log("loading categories");
                    $("#addChannelForm").popover({
                        html: true,
                        content: function() {
                            let html = $('#createChannel').html();
                            $('#createChannel').detach();
                            return html;
                        }
                    });
                    loadCategories();
                    break;
                case "vendors":
                    console.log("loading vendors");
                    loadVendors();
                    break;
                case "roles":
                    console.log("loading roles");
                    loadRoles();
                    break;
                case "items":
                    console.log("loading items");
                    loadItems();
                    break;
                case "shops":
                    console.log("loading shops");
                    $("#addItemToShopForm").popover({
                        html:true,
                        content:function(){
                            let html = $('#allItemShop').html();
                            $('#allItemShop').detach();
                            return html;
                        }
                    });
                    loadShops();
                    break;
            }
            if(callback)
                callback();
            $('.details').hide();
        }

        /** EDIT USER SECTION **/

        /** ADD ITEM **/
        $(document).on('click','.add-item-to-user',function(){
            let id = this.id.match(numberPattern)[0];
            let itemId = $("#itemToAdd"+id+" option:selected").attr('id').match(numberPattern)[0];
            let itemName = $("#itemToAdd"+id+" option:selected").text();
            makeAjax('/admin/items/user',{userId:id,itemId:itemId},'POST')
            $('#user'+id+"Items").append(`<li class="list-group-item st" style="position:relative" id="user${id}Item${itemId}">${itemName}<button type="button" class="float-right delete-button"><i class="material-icons">clear</i></button></li>`);

        });
        /** EDIT USER NAME **/
        $('#userList').on('click','.edit-username-button',function(){
            let id = $(this).attr('id').match(numberPattern)[0];
            let name = $('#user'+id+'Name').text();
            makeAjax('/admin/users',{id:id,name:name},'PUT');
            $('#userInfo'+id).text(name);
        });

        /** ADD ROLE **/
        $(document).on('click','.add-role-button',function(){
            let id = this.id.match(numberPattern)[0];
            let roleId = $("#roleToAdd"+id+" option:selected").attr('id').match(numberPattern)[1];
            let roleName = $("#roleToAdd"+id+" option:selected").text();
            makeAjax('/admin/roles/user',{roleId:roleId,userId:id},'POST');
            $('#user'+id+'Roles').append(`<li class="list-group-item st" style="position:relative" id="user${id}Role${roleId}">${roleName}<button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>`)
        });

        /** DELETE ROLE **/
        $(document).on('click','.delete-role-button',function(){
            let [userId,roleId] = $(this).parent().attr('id').match(numberPattern);
            makeAjax('/admin/roles/user',{roleId:roleId,userId:userId},'DELETE');
            $('#user'+userId+"Role"+roleId).remove();
        });

        /** DELETE ITEM **/
        $(document).on('click','.delete-item-button',function(){
            let [userId,itemId] = $(this).parent().attr('id').match(numberPattern);
            makeAjax('/admin/items/user',{itemId:itemId,userId:userId},'DELETE');
            $('#user'+userId+"Item"+itemId).remove();
        });

        /** END EDIT USER SECTION **/

        /** Load all user info to the "usersSection" div
         * First, it gets all the users and it's info
         * Second ajax, get's all user items
         * Then, append all user roles
         * The other two ajax, are for loading all items and user free roles (since you can't have a role more than once
         **/

        function loadMain(){
            $.ajax({
                url:'/admin/counts',
                type:'GET',
                success:function(info){
                    console.log(info);
                    $('#userQuantity').text(info.users);
                    $('#roleQuantity').text(info.roles);
                    $('#shopQuantity').text(info.shops);
                    $('#itemQuantity').text(info.items);
                    $('#vendorQuantity').text(info.vendors);
                }
            });
        }
        function loadUsers(page=1){
            $.ajax({
                url:'/admin/users?page='+page,
                type:'GET',
                success:function(msg){
                    console.log(msg);
                    $.each(msg.info,function(index,element){
                        $('#userList').append(
                            `<li class="list-group-item element" id="user${element.id}" style="">
                    <div class="info" id="userInfo${element.id}">${element.name}</div>
                    <div class="card details" id="detailsusers${element.id}">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col justify-content-center text-center">
                                        <div style="position:relative">
                                            <h4 class="user-name text-center" contenteditable id="user${element.id}Name">${element.name}</h4><button type="button" class="float-right edit-username-button edit-button" id="editName${element.id}" style="margin-top:-35px;margin-right:-33px"><i class="material-icons">edit</i></button>
                                        </div>
                                        <img src="${element.avatar}" style="width: 150px;height: 150px;object-fit: cover;border-radius: 50%">
                                        <h6 class="card-subtitle mb-2" style="margin-top: 10px;color:${element.main_role.color}">${element.main_role.name}</h6>
                                    </div>
                                    <div class="col" style="margin-top: 80px">
                                        <p id="user1Money">Dinero: ${element.money}</p>
                                        <p style="margin-top: -15px" id="user${element.id}Exp">Exp: ${element.exp}</p>
                                        <p style="margin-top: -15px" id="user${element.id}Messages">Mensajes: ${element.messageCount}</p>
                                    </div>
                                    <div class="col">
                                        <div id="user${element.id}PossibleRoles" class="invisible" style="position:absolute">
                                            <form class="form-inline" role="form">
                                                <div class="form-group">
                                                    <select class="form-control mr-sm-2" id="roleToAdd${element.id}">

                                                    </select>
                                                    <button type="button" class="btn btn-dark float-right add-role-button" data-dismiss="modal" id="addRoleToUser${element.id}">Añadir</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div style="position:relative">
                                            <h6 class="text-center">Roles</h6>
                                            <button type="button" class="float-right add-button" id="addRole${element.id}" data-placement="top" data-toggle="popover" data-title="add role" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                        </div>
                                        <div class="card info-list">
                                            <ul class="list-group list-group-flush" id="user${element.id}Roles">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div id="possibleItems${element.id}" class="invisible" style="position:absolute">
                                            <form class="form-inline" role="form">
                                                <div class="form-group">
                                                    <select class="form-control mr-sm-2" id="itemToAdd${element.id}">

                                                    </select>
                                                    <button type="button" class="btn btn-dark float-right add-item-to-user" id="addItemToUser${element.id}" >Añadir</button>
                                                </div>
                                             </form>
                                        </div>
                                        <div style="position:relative">
                                            <h6 class="text-center">Items</h6>
                                            <button type="button" class="float-right add-button" id="addItem${element.id}" data-placement="top" data-toggle="popover" data-title="add item" data-container="body" data-html="true"><i class="material-icons">add</i></button>
                                        </div>
                                        <div class="card info-list">
                                            <ul class="list-group list-group-flush" id="user${element.id}Items">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </li>`
                        );
                        //Get user items
                        $.ajax({
                            url:'/admin/items/user',
                            type:"GET",
                            data:{'id':element.id},
                            success:function(content){
                                $.each(content,function(index,item){
                                    $("#user"+element.id+"Items").append(`<li class="list-group-item st" style="position: relative" id="user${element.id}Item${item.id}">${item.name}<button type="button" class="float-right delete-button delete-item-button"><i class="material-icons">clear</i></button></li>`)
                                })
                            }
                        });
                        //Append all user roles
                        $.each(element.roles,function(index,role){
                            $('#user'+element.id+"Roles").append(`<li class="list-group-item st" style="position:relative" id="user${element.id}Role${role.id}">${role.name}<button type="button" class="float-right delete-button delete-role-button"><i class="material-icons">clear</i></button></li>`)
                        });
                        //Free roles
                        $.ajax({
                            url:'/admin/roles/user/free',
                            type:'GET',
                            data:{id:element.id},
                            success:function(content){
                                $.each(content,function(index,item){
                                    $("#roleToAdd"+element.id).append(`<option id="user${element.id}Role${+item.id}" class="userFreeRole">${item.name}</option>`);
                                    $("#addRole"+element.id).popover({
                                        html: true,
                                        content: function() {
                                            let html = $('#user'+element.id+'PossibleRoles').html();
                                            $('#user'+element.id+'PossibleRoles').detach();
                                            return html;
                                        }
                                    });
                                });
                            }
                        });
                        //All items
                        $.ajax({
                            url:'/admin/items/all',
                            type:'GET',
                            success:function(msg){
                                $.each(msg,function(index,item){
                                    $('#itemToAdd'+element.id).append(`<option id="item${item.id}" class="itemAvaliable">${item.name}</option>`);
                                });
                                $("#addItem"+element.id).popover({
                                    html:true,
                                    content:function(){
                                        let html = $('#possibleItems'+element.id).html();
                                        $('#possibleItems'+element.id).detach();
                                        return html;
                                    }
                                })
                            }
                        });
                        $('.details').hide();
                    });
                }
            });
        }

        /** EDIT ROLE SECTION **/
        /** EDIT ROLE **/
        $('#roleList').on('click','.edit-role-button',function(){
            let sum = 0; //Permission sum
            let id = this.id.match(numberPattern)[0];
            let name = $('#roleEditName'+id).val();
            let color = $('#editRole'+id+'ColorValue').val();
            $("select#role"+id+"Permissions :selected").each(function () {
                sum += eval($(this).attr('value'));
            });
            let data = {role_id:id,name:name,permissions:sum,color:color};
            makeAjax('/admin/roles',data,'put');


        });
        /** END EDIT ROLE **/
        function loadRoles(page=1){
            $.ajax({
                url:'/admin/roles?page='+page,
                type:'GET',
                success:function(msg){
                    $.each(msg.info,function(index,element){
                        $('#roleList').append(
                            `<li class="list-group-item element" id="role${element.id}">
                                <div class="info" id="rolesInfo${element.id}">${element.name}<button type="button" class="float-right delete-button delete-element"><i class="material-icons">clear</i></button></div>
                                <div class="card details" id="detailsroles${element.id}">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col justify-content-center">
                                                    <h4 class="card-title">${element.name}</h4>
                                                    <form class="form-inline" role="form">
                                                        <div class="form-group justify-content-center align-content-center">
                                                            <select multiple class="form-control" id="role${element.id}Permissions" style="height: 160px;border:none">
                                                               <option value="1<<0">Admin</option>
                                                               <option value="1<<1">Crear temas</option>
                                                               <option value="1<<2">Borrar temas</option>
                                                               <option value="1<<3">Mover temas</option>
                                                               <option value="1<<4">Crear posts</option>
                                                               <option value="1<<5">Borrar posts</option>
                                                               <option value="1<<6">Editar posts</option>
                                                            </select>
                                                         </div>
                                                    </form>
                                                </div>
                                                <div class="col">
                                                    <div class="form">
                                                        <div class="form-group">
                                                            <label for="roleEditName${element.id}" class="col-form-label">Nombre:</label>
                                                            <input type="text" class="form-control" id="roleEditName${element.id}" value="${element.name}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editRole${element.id}ColorValue" class="col-form-label">Color</label>
                                                            <div id="editRole${element.id}Color" class="input-group colorpicker-component .roleColor">
                                                                <input type="text" id="editRole${element.id}ColorValue" value="${element.color}" class="form-control" />
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary float-right edit-role-button" id="editRole${element.id}Button">Editar</button>
                                    </div>
                                </div>
                            </li>
`);

                        //Mark as selected current permissions
                        $('select#role'+element.id+'Permissions option').each(function(index){
                            this.selected = (element.permission[element.permission.length-index-1] === "1");
                        });
                        //Set role color
                        $('#editRole'+element.id+'Color').colorpicker();
                        //$('#editRole'+element.id+'Color').colorpicker('setValue',element.color);
                    });
                    $('.details').hide();
                }
            });
        }
        /** EDIT ITEMS SECTION **/
        /** EDIT ITEMS **/
        $('#itemList').on('click','.edit-item-button',function(){
            let id = this.id.match(numberPattern)[0];
            let name = $('#item'+id+'Name').text();
            let description = $('#item'+id+'Description').text();
            let buyValue = $('#item'+id+'BuyValue').val();
            let sellValue = $('#item'+id+'SellValue').val();
            let icon = $('#item'+id+'Icon').val();
            makeAjax('/admin/items',{id:id,name:name,description:description,buyValue:buyValue,sellValue:sellValue,icon:icon},'PUT');
            $('#item'+id+'IconPreview').attr('src',icon);
        });


        /** END EDIT ITEMS **/

        function loadItems(page=1){
            $.ajax({
                url:'/admin/items?page='+page,
                type:'GET',
                success:function(msg){
                    $.each(msg.info,function(index,element){
                        $('#itemList').append(
                            `<div class="col-md-3 col-sm-6 item" style="margin-top:5px;height:300px;overflow:auto">
                                <div class="card card-box text-white">
                                    <img class="card-img-top center" id="item${element.id}IconPreview" src="${element.icon}" style="width:42px;height:42px">
                                    <div class="card-body">
                                        <h4 class="card-title" contenteditable id="item${element.id}Name">${element.name}</h4>
                                        <p class="card-text" contenteditable id="item${element.id}Description">${element.description}</p>
                                        <label for="item${element.id}BuyValue"><b>Precio de compra</b></label>
                                        <input type="number" class="card-text" id="item${element.id}BuyValue" value="${element.buyValue}" style="background:inherit;border:none;color:white"></input>
                                        <label for="item${element.id}SellValue"><b>Precio de venta</b></label>
                                        <input type="number" class="card-text" id="item${element.id}SellValue" value="${element.sellValue}" style="background:inherit;border:none;color:white"></input>
                                        <label for="item${element.id}Icon"><b>Imagen</b></label>
                                        <input type="text" class="card-text" id="item${element.id}Icon" value="${element.icon}" style="background:inherit;border:none;color:white"></input>
                                        <button type="button" class="btn btn-primary edit-item-button" id="editItem${element.id}">Editar</button>
                                        <button type="button" class="btn btn-danger float-left delete-item-from-db-button" id="deleteItem${element.id}">Borrar</button>
                                    </div>
                                </div>
                            </div>`);
                    });
                }
            });
        }

        /** EDIT VENDORS SECTION **/

        $('#vendorList').on('click','.edit-vendor-button',function(){
            let id = this.id.match(numberPattern)[0];
            let name = $('#editVendor'+id+'Name').val();
            let description = $('#editVendor'+id+'Description').val();
            let image = $('#editVendor'+id+'Image').val();
            makeAjax('/admin/vendors',{id:id,name:name,description:description,image:image},'PUT');
            $('#vendor'+id+'ImagePreview').attr('src',image);
            $('#vendor'+id+'NamePreview').text(name);
        });

        /** END EDIT VENDORS**/

        function loadVendors(page=1){
            $.ajax({
                url:'/admin/vendors?page='+page,
                type:'GET',
                success:function(msg){
                    $.each(msg.info,function(index,element){
                        $('#vendorList').append(`
                            <li class="list-group-item element" id="vendor${element.id}" style="">
                                <div class="info" id="vendorInfo${element.id}">${element.name}<button type="button" class="float-right delete-button delete-element"><i class="material-icons">clear</i></button></div>
                                <div class="card details" id="detailsvendors${element.id}">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col justify-content-center text-center">
                                                    <h4 class="card-title text-center" id="vendor${element.id}NamePreview" >${element.name}</h4>
                                                    <img src="${element.image}" id="vendor${element.id}ImagePreview" style="width: 150px;height: 150px;object-fit: cover;border-radius: 50%">
                                                </div>
                                                <div class="col">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="editVendor${element.id}Name">Nombre</label>
                                                            <input type="text" class="form-control-lg" id="editVendor${element.id}Name" value="${element.name}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editVendorDescription">Descript</label>
                                                            <input type="text" class="form-control-lg" id="editVendor${element.id}Description" value="${element.description}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editVendor${element.id}Image">Imagen</label>
                                                            <input type="text" class="form-control-lg" id="editVendor${element.id}Image" value="${element.image}">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary edit-vendor-button float-right" id="editVendor${element.id}">Editar</button>
                                    </div>
                                </div>
                            </li>
                        `);
                    });
                    $('.details').hide();
                }
            });
        }

        /** EDIT SHOPS SECTION **/

        //Edit shop info
        $('#shopsSection').on('click','.edit-shop-button',function(){
            let name = $('#editShopName').val();
            let description = $('#editShopDescription').val();
            //let $('#currentVendor').text(info.vendor);
            makeAjax('/admin/shops',{id:currentElementId,name:name,description:description},'PUT');
            $('#editShopName').val(name);
            $('#editShopDescription').val(description);
        });

        //Change vendor
        $('#shopsSection').on('click','#changeShopVendor',function(){
            let vendor = $('#shopEditVendorSelect option:selected').attr('id');
            let vendorName = $('#shopEditVendorSelect option:selected').val();
            makeAjax('/admin/shops/vendor',{shopId:currentElementId,vendorId:vendor},'PUT');
            $('#currentVendor').text(vendorName);

        });

        //Add item

        $(document).on('click','#addItemToShop',function(){
            let itemId = $('#shopItemToAdd option:selected').attr('id').match(numberPattern)[0];
            let name = $('#shopItemToAdd option:selected').val();
            makeAjax('/admin/shops/item',{shopId:currentElementId,itemId:itemId},'POST');
            $('#shopItemToAdd').append(`<option id="item${itemId}" class="itemAvaliable">${name}</option>`);
            //$("#categoryChannels").append(`<li class="list-group-item st channel" style="position:relative" id="category${currentElementId}Channel${element.id}">${element.name}<button type="button" class="float-right delete-button delete-channel-button"><i class="material-icons">clear</i></button></li>`)
        });

        $('#shopsSection').on('click','.delete-shop-item-button',function(){
            let [shopId,itemId] = $(this).parent().attr('id').match(numberPattern);
            makeAjax('/admin/shops/item',{shopId:shopId,itemId:itemId},'DELETE');
            $('#shop'+shopId+'Item'+itemId).remove();
        });

        /** END EDIT SHOPS **/

        function loadShops(page=1){
            $('.itemAvaliable').remove();
            $('.possible-vendor').remove();
            $.ajax({
                url:'/admin/shops?page='+page,
                type:'GET',
                success:function(msg){
                    $.each(msg.info,function(index,element){
                        $('#shopList').append(`
                            <div class="col-md-3 col-sm-6 shop" style="margin-top: 5px;position:relative" id="shop${element.id}">
                                <div class="card card-box text-white">
                                    <div class="card-body">
                                        <h4 class="card-title">${element.name}</h4>
                                        <p class="card-text">${element.description}</p>
                                        <!--<a href="#" class="btn btn-primary">Editar</a>-->
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
            $.ajax({
                url:'/admin/vendors/all',
                type:'GET',
                success:function(msg){
                    $.each(msg,function(index,element){
                        //console.log(element);
                        $('.vendorSelect').append(`<option id="${element.id}" class="possible-vendor">${element.name}</option>`);
                    });
                }
            });
            //All items
            $.ajax({
                url:'/admin/items/all',
                type:'GET',
                success:function(msg){
                    $.each(msg,function(index,item){
                        $('#shopItemToAdd').append(`<option id="item${item.id}" class="itemAvaliable">${item.name}</option>`);
                    });
                }
            });
        }

        /** EDIT CATEGORY SECTION **/
        //ADD CHANNEL
        $(document).on('click','#createChannelButton',function(){
            let name = $('#createChannelName').val();
            let description = $('#createChannelDescription').val();
            let categoryId = currentElementId;
            makeAjax('/admin/channels',{name:name,description:description,categoryId:categoryId},'POST');
            //$("#categoryChannels").append(`<li class="list-group-item st channel" style="position:relative" id="category${currentElementId}Channel${element.id}">${element.name}<button type="button" class="float-right delete-button delete-channel-button"><i class="material-icons">clear</i></button></li>`)
        });

        //Delete channel
        $('#categoriesSection').on('click','.delete-channel-button',function(){
            let id = $(this).parent().attr('id');
            let channelId = id.match(numberPattern)[1];
            makeAjax('/admin/channels',{id:channelId},'DELETE');
            $("#"+id).remove();

        });

        //Edit category info
        $('#editCategory').click(function(){
            let name = $('#editCategoryName').val();
            let description = $('#editCategoryDescription').val();
            let color = $('#editCategoryColorValue').val();
            let image = $('#editCategoryImage').val();
            makeAjax('/admin/categories',{name:name,category_id:currentElementId,color:color,description:description,image:image},'PUT');
            $('#categoryPreviewTitle').text(name);
            $('#categoryPreviewImage').attr('src',image);
            $('#categoryEditDescription').text(description);

        });

        function loadCategories(page=1){
            $('.category').remove();
            $('#editCategoryColor').colorpicker();
            $.ajax({
                url:'/admin/categories?page='+page,
                type:'GET',
                success:function(msg){
                    $.each(msg.info,function(index,element){
                        $('#categoriesList').append(`
                            <div class="col-md-3 col-sm-6 category" style="margin-top:5px" id="category${element.id}">
                                <div class="card card-box text-white category-item">
                                    <img class="card-img-top center" src="${element.image}" style="width:100%;height: 200px;object-fit: cover;object-position: center left">
                                    <div class="card-body">
                                        <h4 class="card-title">${element.name}</h4>
                                        <p class="card-text">${element.description}</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                }
            });
        }

        $(document).on('click','.delete-element',function(){
            $('.details').hide();
            $('.element').remove();
            $('.item').remove();
            $('.shop').remove();
            $('.itemAvaliable').remove();
            let id = $(this).parent().attr('id').match(numberPattern)[0];
            makeAjax('/admin/'+prev,{id:id},'DELETE');
            loadinfo()
        });

        $('#itemList').on('click','.delete-item-from-db-button',function(){
            $('.element').remove();
            $('.item').remove();
            $('.shop').remove();
            $('.itemAvaliable').remove();
            let id = this.id.match(numberPattern)[0];
            makeAjax('/admin/'+prev,{id:id},'DELETE');
            loadinfo()
        });

        $('#deleteCategory').click(function(){
            $('.element').remove();
            $('.item').remove();
            $('.shop').remove();
            $('.itemAvaliable').remove();
            $('#category-details').css("top","-100%");
            $('#overlay').css("display","none");
            $('.popover').popover('hide');
            makeAjax('/admin/'+prev,{id:currentElementId},'DELETE');
            loadinfo()
        });

        $('#deleteShop').click(function(){
            $('.element').remove();
            $('.item').remove();
            $('.shop').remove();
            $('.itemAvaliable').remove();
            $('#shop-details').css("top","-100%");
            $('#overlay').css("display","none");
            $('.popover').popover('hide');
            makeAjax('/admin/'+prev,{id:currentElementId},'DELETE');
            loadinfo()
        });

        //Make an ajax (duh)
        function makeAjax(url,data,type){
            $.ajax({
                url:url,
                type:type,
                data:data,
                success:function(msg){
                    console.log(msg);
                },
                error:function(msg){
                    console.log(msg);
                }
            });
        }

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