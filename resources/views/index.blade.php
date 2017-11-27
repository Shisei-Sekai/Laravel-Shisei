@extends('layouts.base_materialized')
@section('content')
<div class="section row-full" id="categories">
    <div class="container">
        <!-- Tablet/desktop menu -->
        @foreach($categories as $category)
        <div class="row">
            <div class="col m12 s12 l12 xl12">
                <div class="card horizontal hoverable" style="background-color: {{$category['color']}}">
                    <div class="card-image category-image hide-on-small-only" style="width:320px">
                        <img class="activator panel-img" src="{{$category['image']}}" style="width:100%;height:100%;object-fit: cover">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4 center">{{$category['name']}}<i class="material-icons right">more_vert</i></span>
                            <p>{{$category['description']}}</p>
                        </div>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4 center">{{$category['name']}}<i class="material-icons right">close</i></span><br>
                        <ul class="collection" style="border:none">
                            @foreach($category['channels'] as $channel)
                            <li class="collection-item avatar" style="background: rgba(255,255,255,0.5)">
                                <i class="material-icons circle">folder</i>
                                <a href="{{$channel['id']}}" class="title" style="color: black">{{$channel['name']}}</a>
                                <p><br>
                                    {{$channel['description']}}
                                </p>

                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<div class="section row-full white" id="events">
    <div class="row center">
        @if(isset($events))
            <!-- SHOW EVENT -->
        @else
            <div class="col s4 m4 l4 xl4 offset-s4 offset-m4 offset-l4 offset-xl4">
                <i class="material-icons default-event-icon">explore</i>
                <h4>Eventos</h4>
                <p>En esta sección se mostrarán los eventos (siempre y cuando haya uno). Si puedes ver esto, es que no es así.
                    Los eventos son ocasiones especiales que tienen un tiempo límitado y que, ocasionalmente, tienen alguna
                    recompensa zukhulemta.
                </p>
            </div>
        @endif
    </div>
    <!--<h4 class="center">¡Vaya! parece que no hay ningún evento en desarrollo</h4>-->
</div>
@if(isset($affiliates))
<div class="section row-full red" id="affiliates">
    <h4 class="center">Por ahora, no hay afiliados, puedes ver los requisitos para serlo <a href="#">aquí</a></h4>
</div>
@endif

<footer class="page-footer row-full blue" style="margin-bottom: -50px">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Shisei Sekai</h5>
                <p class="grey-text text-lighten-4">This is a fan-made forum to role-play in the JoJo's Bizarre Adventures universe<br>
                I own neither the images showed here nor the JoJo's Bizarre Adventures series<br>
                All the credits goes to the respective authors</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Interest</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="https://github.com/Shisei-sekai/Laravel-Shisei">Github</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Contacto</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 Aztic. MIT License
        </div>
    </div>
</footer>
@endsection
