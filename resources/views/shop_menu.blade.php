@extends('layouts.base_materialized')
@section('content')
    <div class="section">
        <div class="container">
            <ul class="collection">
                <!-- Every <li> is a shop -->
                @foreach($shops as $shop)
                    <li class="collection-item avatar hoverable">
                        <a class="title" href="/shop/{{$shop['id']}}">{{$shop['name']}}</a>
                        <div class="secondary-content" style="margin-right:10px">
                            <span>{{$shop['description']}}</span><br>
                            <span>Dueño:{{$shop['vendor']}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection