@extends('layouts.base_materialized')
@section('content')
    <div class="section">
        <div class="container">
            <ul class="collection">
                <!-- Every <li> is a shop -->
                @foreach($shops as $shop)
                    <li class="collection-item avatar hoverable blue-grey darken-1">
                        <a class="title" href="/shop/{{$shop['id']}}">{{$shop['name']}}</a>
                        <div class="secondary-content" style="margin-right:10px">
                            <span class="white-text">{{$shop['description']}}</span><br>
                            <span class="white-text">Dueño:{{$shop['vendor']}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection