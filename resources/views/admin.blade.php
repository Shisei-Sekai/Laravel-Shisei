<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
</head>
<body style="background: #fff0fc">

<nav class="navbar navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="#">Admin panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Forum<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
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
<br>

<!-- lateral panel -->
<div class="container">
    <div class="row">
        <!-- Selecting type panel -->
        <div class="col-md-2 col-6 col-sm-4">
            <div class="card card-dark bg-dark text-white panel-card">
                <div class="card-header text-center">
                    Menu
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark"><button id="users" class="section-button selector">Usuarios</button></li>
                        <li class="list-group-item bg-dark"><button id="roles" class="section-button selector">Roles</button></li>
                        <li class="list-group-item bg-dark"><button id="categories" class="section-button selector">Categorias</button></li>
                        <li class="list-group-item bg-dark"><button id="affiliates" class="section-button selector">Afiliados</button></li>
                        <li class="list-group-item bg-dark"><button id="character_cards" class="section-button selector">Fichas de personaje</button></li>
                        <li class="list-group-item bg-dark"><button id="combat_cards" class="section-button selector">Fichas de combate</button></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Content info -->
        <div class="col-md-10 col-6 col-sm-8">
            <div class="card card-dark bg-dark text-white">
                <div class="card-header text-center bg-dark">
                    Contenido
                    <button type="button" class="fa fa-plus float-right section-button" data-toggle="modal" id="createButton"></button>
                </div>
                <div class="card-body bg-dark">
                    <ul class="list-group list-group-flush" id="dbInfo">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="">
        <ul class="pagination justify-content-end" id="pages">
            <li class="page-item bg-dark" id="prev">
                <a class="page-link bg-dark" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item" id="next">
                <a class="page-link bg-dark" href="#">Next</a>
            </li>
        </ul>
    </nav>

    <!-- CREATE ROLE MODAL -->
    <div class="modal fade" id="modalroles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModal">Crear rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<form id="crearRolForm">-->
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="roleCreationName">
                    </div>
                    <div class="form-group">
                        <label for="createRoleColorValue" class="col-form-label">Color</label>
                        <div id="createRoleColor" class="input-group colorpicker-component .roleColor">
                            <input type="text" id="createRoleColorValue" value="" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Permisos:</label>
                        <!--<textarea class="form-control" id="message-text"></textarea>-->
                        <label for="desiredPermissions">Selecciona uno o muchos</label>
                    </div>

                   <!--</form>-->
                    <select multiple class="form-control" id="desiredPermissions">
                        <option value="1<<0">Admin</option>
                        <option value="1<<1">Crear temas</option>
                        <option value="1<<2">Borrar temas</option>
                        <option value="1<<3">Mover temas</option>
                        <option value="1<<4">Crear posts</option>
                        <option value="1<<5">Borrar posts</option>
                        <option value="1<<6">Editar posts</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="createRol" data-dismiss="modal">Crear</button>
                </div>
            </div>
        </div>
    </div>


    <!-- EDIT ROLE MODAL -->
    <div class="modal fade" id="modalEditroles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Editar rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="roleEditName">
                    </div>
                    <div class="form-group">
                        <label for="editRoleColorValue" class="col-form-label">Color</label>
                        <div id="editRoleColor" class="input-group colorpicker-component .roleColor">
                            <input type="text" id="editRoleColorValue" value="" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="form-group">

                        <label for="message-text" class="col-form-label">Permisos:</label>
                        <label for="desiredPermissionsEdit">Selecciona uno o muchos</label>
                    </div>

                    <select multiple class="form-control" id="desiredPermissionsEdit">
                        <option value="1<<0">Admin</option>
                        <option value="1<<1">Crear temas</option>
                        <option value="1<<2">Borrar temas</option>
                        <option value="1<<3">Mover temas</option>
                        <option value="1<<4">Crear posts</option>
                        <option value="1<<5">Borrar posts</option>
                        <option value="1<<6">Editar posts</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="editRol" data-dismiss="modal">Editar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CREATE CATEGORY MODAL -->
    <div class="modal fade" id="modalcategories" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Crear categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="categoryCreationName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="createCategory" data-dismiss="modal">Crear</button>
                </div>
            </div>
        </div>
    </div>
    <!-- EDIT CATEGORY MODAL -->
    <div class="modal fade" id="modalEditcategories" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModal">Editar categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-inline my-2 my-lg-0 justify-content-center">
                        <label for="recipient-name" class="col-form-label mr-sm-1">Nombre:</label>
                        <input type="text" class="form-control mr-sm-2" id="categoryEditName">
                    </div>
                    <br>
                    <div class="form-inline my-2 my-lg-0 justify-content-center">
                        <label for="recipient-name" class="col-form-label mr-sm-1">Descripcion</label>
                        <input type="text" class="form-control mr-sm-2" id="categoryEditDescription">
                    </div>
                    <br>
                    <div class="form-inline my-2 my-lg-0 justify-content-center">
                        <label for="recipient-name" class="col-form-label mr-sm-1">Imagen</label>
                        <input type="text" class="form-control mr-sm-2" id="categoryEditImage">
                    </div>
                    <br>
                    <div class="form-inline my-2 my-lg-0 justify-content-center">
                        <label for="editCategoryColorValue" class="col-form-label">Color</label>
                        <div id="editCategoryColor" class="input-group colorpicker-component CategoryColor">
                            <input type="text" id="editCategoryColorValue" value="red" class="form-control" />
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary bg-dark float-right" id="editCategoryInfo" data-dismiss="modal">Editar</button>
                    <br><br>
                    <ul class="nav justify-content-center" style="background: #908c90">
                        <li class="nav-item">
                            <span class="nav-link active">Crear channel</span>
                        </li>
                    </ul>
                    <br>

                    <!-- Create a channel div -->
                    <div>
                        <form class="form-inline my-2 my-lg-0">
                            <label for="recipient-name" class="col-form-label mr-sm-1">Nombre:</label>
                            <input type="text" class="form-control mr-sm-2" id="channelCreationName"><br>
                        </form><br>
                        <button type="button" class="btn btn-primary float-right" id="createChannel" data-dismiss="modal">Crear</button>
                        <form class="form-inline my-2 my-lg-0">
                            <label for="recipient-name" class="col-form-label mr-sm-1">Descript:</label>
                            <input type="text" class="form-control mr-sm-2" id="channelDescripionCreate">
                        </form>

                    </div><br>
                    <ul class="nav justify-content-center" style="background: #908c90">
                        <br>
                        <li class="nav-item" id="editCategorySection">
                            <a class="nav-link" href="#">Channels</a>
                        </li>
                    </ul><br>
                    <!-- List all category channels -->
                    <div>
                        <ul class="list-group list-group-flush " id="listChannels">

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!--<button type="button" class="btn btn-primary" id="editCategory" data-dismiss="modal">Editar</button>-->
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE USER MODAL (name and assign roles) -->
    <div class="modal fade" id="modalEditusers" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- User name edit -->
                    <form class="form-inline my-2 my-lg-0 justify-content-center">
                        <label for="recipient-name" class="col-form-label mr-sm-1">Nombre:</label>
                        <input type="text" class="form-control mr-sm-2" id="userName">
                        <button type="button" class="fa fa-pencil float-right section-button" id="editUserName"></button>
                    </form><br>
                    <ul class="nav justify-content-center" style="background: #908c90">
                        <li class="nav-item">
                            <span class="nav-link" href="#">Añadir rol</span>
                        </li>
                    </ul><br>
                    <!-- list all possible roles -->
                    <div class="row">
                        <!-- Here will be all possible roles loaded from db -->
                        <div class="col">
                            <select class="form-control mr-sm-2" id="roleToAdd">

                            </select>
                        </div>
                        <button type="button" class="btn btn-dark float-right" data-dismiss="modal" id="addRoleToUser">Añadir</button>
                    </div>
                    <br>
                    <!-- List all user roles -->
                    <ul class="nav justify-content-center" style="background: #908c90">
                        <li class="nav-item">
                            <span class="nav-link" href="#">Roles</span>
                        </li>
                    </ul><br>
                    <ul class="list-group list-group-flush text-white bg-dark" id="userRoles">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/bootstrap-colorpicker.min.js')}}"></script>
<script>
    //Wait for DOM to load
    $(document).ready(function () {
        $(function() {
            $('#createRoleColor').colorpicker();
            $('#editRoleColor').colorpicker();
        });
        //Keep track of the last category
        let prev = undefined;
        //Keep track of current id (changes when you click in a element loaded from db)
        let elementId = 0;

        //Display elements
        function displayElements(id,page){
            $('.dbElement').remove();
            $('.number').remove();
            $.ajax({
                url:'/admin/'+id+'?page='+page,
                type:'get',
                success:function(msg){
                    //Append elements
                    $.each(msg.info,function(index,element){
                        /*$('#dbInfo').append('<li class="list-group-item bg-dark element" permission="'+element.permission+'" data-toggle="modal" data-target="#modalEdit'+prev+'"id="'+id+element.id+'"><span>'+element.name+'</span><button type="button" class="fa fa-trash float-right section-button deleteElement" id="deleteElementButton'+element.id+'"></button></li>');*/
                        $('#dbInfo').append('<li class="list-group-item bg-dark dbElement"><span class="element" permission="'+element.permission+'" data-toggle="modal" data-target="#modalEdit'+prev+'" id="'+id+element.id+'"color-info="'+element.color+'" description="'+element.description+'" image="'+element.image+'">'+element.name+'</span><button type="button" class="fa fa-trash float-right section-button deleteElement" id="deleteElementButton'+element.id+'"></button></li>');

                    });
                    //Generate pagination
                    for(let i=Math.floor(msg.quantity/20)+1;i>0;i--){
                        $('#prev').after('<li class="page-item"><a class="page-link bg-dark number" href="#">'+(i)+'</a></li>');
                    }

                }
            });
        }
        //When change category
        $('.selector').click(function () {
            if(prev)
                $("#"+prev).toggleClass('current');
            prev = this.id;
            $('#createButton').attr('data-target','#modal'+prev);
            $(this).toggleClass('current');
            displayElements(this.id,1);
        });

        //Click inside element loaded from db
        $('#dbInfo').on('click','.element',function(){
           //alert($(this).text());
            elementId = $(this).attr('id').split($('.current').attr('id'))[1];
            if($('.current').attr('id') === "roles"){
                //Give the "name" section the element name
                $('#roleEditName').val($(this).text());
                $('#editRoleColor').colorpicker('setValue',$(this).attr('color-info'));
                //Get the element permission
                let permission = $(this).attr('permission');
                //Generate the edit
                $("select#desiredPermissionsEdit option").each(function(index){
                    this.selected = (permission[permission.length-index-1] === "1");
                });
            }
            else if($('.current').attr('id') === "users"){
                //Remove roles from previous users, if any
                $('.userFreeRole').remove();
                $('.userRole').remove();
                //Set user name for edit/show
                $('#userName').val($(this).text());
                //Get user roles
                updateUserInfo();

            }
            else if($('.current').attr('id') === "categories"){
                $('#categoryEditName').val($(this).text());
                $('#editCategoryColor').colorpicker('setValue',$(this).attr('color-info'));
                $('#categoryEditImage').val($(this).attr('image'));
                $('#categoryEditDescription').val($(this).attr('description'));
                $('.categoryChannel').remove();
                $.ajax({
                    url:'/admin/channels',
                    type:'GET',
                    data:{categoryId:elementId},
                    success:function(msg){
                        console.log(msg);
                        $.each(msg,function(index,element){
                            $('#listChannels').append('<li class="list-group-item bg-dark categoryChannel"> <span>'+element.name+'</span> <button type="button" class="fa fa-trash float-right section-button deleteChannel" id="deleteChannelButton'+element.id+'" data-dismiss="modal"></button> <button type="button" class="fa fa-pencil float-right section-button" id="editChannelButton'+index+'"></button></li>')
                        });
                    },
                    error:function(msg){
                        console.log(msg);
                    }
                });
            }
        });

        $('#dbInfo').on('click','.deleteElement',function(){
            let currentSection = $('.current').attr('id');
            let currentId = $(this).attr('id').split('deleteElementButton')[1];
            makeAjax('/admin/'+currentSection,{id:currentId},'DELETE');
            console.log(currentSection);
            console.log(currentId);
        });

        //Handle click inside page selector
        $('#pages').on('click','.number',function(){
           displayElements($('.current').attr('id'),$(this).text());
        });

        //Create category button
        $('#createCategory').click(function(){
            let name = $('#categoryCreationName').val();
            makeAjax('/admin/categories',{name:name},'post');
        });
        //Edit category (change name)
        $('#editCategoryInfo').click(function(){
            let name = $('#categoryEditName').val();
            let color = $('#editCategoryColorValue').val();
            let description = $('#categoryEditDescription').val();
            let image = $('#categoryEditImage').val();
            console.log(color);
            makeAjax('/admin/categories',{name:name,category_id:elementId,color:color,description:description,image:image},'put');
        });

        //Delete role from user
        $('#userRoles').on('click','.deleteUserRole',function () {
            let roleId = $(this).attr('id');
            makeAjax('/admin/roles/user',{roleId:roleId,userId:elementId},'DELETE');
        });

        //Edit user name
        $('#editUserName').click(function(){
            let newName = $('#userName').val();
            console.log(newName);
            console.log(elementId);
            makeAjax('/admin/users',{id:elementId,name:newName},'PUT');

        });
        //Add role to user
        $('#addRoleToUser').click(function(){
           let roleId= $('#roleToAdd option:selected').attr('id');
           makeAjax('/admin/roles/user',{roleId:roleId,userId:elementId},'POST')
        });


        //Create role "form"
        $('#createRol').click(function(){
            let sum = 0;
            $("select#desiredPermissions :selected").each(function () {
                sum += eval($(this).attr('value'));
            });
            let name = $('#roleCreationName').val();
            let color = $('#createRoleColorValue').val();
            let data = {name:name,permissions:sum,color:color};
            makeAjax('/admin/roles',data,'post');
        });

        //Edit role (name and/or permissions)
        $('#editRol').click(function(){
            let sum = 0;
            $("select#desiredPermissionsEdit :selected").each(function () {
                sum += eval($(this).attr('value'));
            });
            let name = $('#roleEditName').val();
            let color = $('#editRoleColorValue').val();
            let data = {role_id:elementId,name:name,permissions:sum,color:color};
            makeAjax('/admin/roles',data,'put');
        });

        //Create channel for a category
        $('#createChannel').click(function(){
            console.log(elementId);
            let name = $('#channelCreationName').val();
            let description = $('#channelDescripionCreate').val();
            makeAjax('/admin/channels',{name:name,description:description,categoryId:elementId},'POST');
        });

        //Delete channel from a category
        $('#listChannels').on('click','.deleteChannel',function(){
           let channelId = $(this).attr('id').split('deleteChannelButton')[1];
           console.log(channelId);
           makeAjax('/admin/channels',{id:channelId},'DELETE');
        });

        //Make an ajax (duh)
        function makeAjax(url,data,type){
            $.ajax({
                url:url,
                type:type,
                data:data,
                success:function(msg){
                    console.log(msg);
                    displayElements($('.current').attr('id'),1);
                },
                error:function(msg){
                    console.log(msg);
                }
            });
        }

        //This will make 2 ajax request.
        //One for update user modal with possible assignable roles to users
        //
        function updateUserInfo(){
            $.ajax({
                url:'/admin/roles/user',
                type:"GET",
                data:{'id':elementId},
                success:function(msg){
                    console.log(msg);
                    //Travel all roles
                    $.each(msg,function(index,element){
                        console.log(element);
                        $('#userRoles').append('<li class="list-group-item bg-dark userRole"><span>'+element.name+'</span><button type="button" class="fa fa-trash float-right section-button deleteUserRole" id="'+element.id+'"></button></li>');
                    });
                },
                error:function(msg){
                    console.log(msg);
                }
            });
            //Get user possible roles
            $.ajax({
                url:'/admin/roles/user/free',
                type:"GET",
                data:{'id':elementId},
                success:function(msg){
                    console.log(msg);
                    //Travel all roles
                    $.each(msg,function(index,element){
                        console.log(element);
                        $('#roleToAdd').append('<option id="'+element.id+'" class="userFreeRole">'+element.name+'</option>');
                    });
                },
                error:function(msg){
                    console.log(msg);
                }
            });
        }
    });
</script>
</body>
</html>