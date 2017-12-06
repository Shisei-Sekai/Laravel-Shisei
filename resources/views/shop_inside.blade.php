@extends('layouts.base_materialized')
@section('content')
    <!-- Nunito font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vollkorn+SC:700&amp;subset=cyrillic-ext" rel="stylesheet">
    <div class="section">
        <div class="container">
            <div class="row">
                <img src="{{$info['image']}}" class="circle" style="width:150px;height:150px;object-fit: cover">
                <span class="" style="font-family: 'Vollkorn SC', serif;">{{$info['shopName']}}</span>
                <span class="center" style="tex"></span>

            </div>

            <div class="">
                <ul class="collection hoverable">
                    @foreach($items as $item)
                        <li class="collection-item avatar" style="background: rgba(255,255,255,0.5)">
                            <img src="{{$item['icon']}}" alt="" class="circle">
                            <span class="title" style="color: black">{{$item['name']}}</span>
                            <p><br>
                                {{$item['description']}}
                            </p>
                            <br>
                            <p>
                                Precio:{{$item['buyValue']}}
                            </p><br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection