@extends('layouts.base')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 col-10 col-sm-11">
            <div class="card sub-section">
                <div class="card-header" style="text-align: center"><h6 class="card-title">User name</h6></div>
                <!-- navigation -->
                <ul class="nav justify-content-center sub-section">
                    <li class="nav-item">
                        <span class="nav-link" href="#">Información</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" href="#">Ficha de personaje</span>
                    </li>
                    <!-- Privado -->
                    <li class="nav-item">
                        <span class="nav-link" href="#">Ficha de combate</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" href="#">Medallas</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" href="#">Inventario</span>
                    </li>
                    <!-- fin de lo privado -->

                </ul>
                <!-- content -->
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6 col-6 col-sm-6">
                            <div class="user-avatar" "><img class="user-avatar circular-image" src="{{$user['avatar']}}"><br></div>
                            <span>{{$user['name']}}</span><br>
                            <span style="color:{{$user['role']['color']}}">{{$user['role']['name']}}</span>
                        </div>
                        @if($user['owner'])
                            <form id="user" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="uploadUserAvatar">Cambiar avatar</label>
                                    <input type="file" name="userAvatar" id="uploadUserAvatar" class="form-control-file"><br>
                                    <button class="btn btn-dark" type="submit">submit</button>
                                </div>

                            </form>
                        @endif
                        <!--
                        <div class="col-md-6 col-6 col-sm-6">
                            <br><br>
                            <span>Badges</span><br>
                            <span>b1</span>
                            <span>b1</span>
                            <span>b1</span>
                            <span>b1</span>
                            <span>b1</span>
                            <br><br>
                            <span>Items</span><br>
                            <span>I1</span>
                            <span>I2</span>
                            <span>I3</span>
                            <span>I4</span>
                            <span>I5</span>
                            <br>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
@endsection