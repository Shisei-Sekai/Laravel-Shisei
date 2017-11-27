@extends('layouts.base_materialized')
@section('content')
    <div class="section row-full" style="padding: 0;margin-top: -10px">
        <div class="col s12 m12 l12 xl12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Registro</span>
                    <form class="col s12 m12 l12 xl12" method="POST" action="{{route('register')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <label for="name">Nombre</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <label for="password">Contraseña</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <label for="password-confirm">Confirmar contraseña</label>
                                <input id="password-confirm" type="password" name="password_confirmation" required>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col s6 m6 l6 xl6">
                                <button class="btn left z-depth-0" type="submit" style="border: none;background: transparent">Register
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection