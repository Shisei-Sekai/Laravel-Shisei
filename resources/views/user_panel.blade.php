@extends('layouts.base_materialized')
@section('content')
    <div class="section row-full blue-grey darken-1">
        <div class="row">
            <div class="col s12 m12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title center">{{$user['name']}}</span>
                        <img src="{{$user['avatar']}}" class="circle" style="width:150px;height:150px;object-fit: cover">
                    </div>
                    <div class="card-action">
                        @if($user['owner'])
                            <form method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col s6 m6">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Cambiar avatar</span>
                                                <input type="file" name="userAvatar" id="uploadUserAvatar" placeholder="Cambiar avatar">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m6 s6">
                                        <button class="btn left z-depth-0" type="submit" style="border: none;background: transparent;margin-top: 40px">Cambiar</button>
                                    </div>
                                </div>
                                <div class="row">

                                </div>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection