@extends('layouts.base')
@section('content')
    <div class="container">
        @if(isset($importantNotice))
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-11 col-10">
                <div class="card">
                    <div class="card-header"><h6 class="card-title">Noticias importantes</h6></div>
                </div>
            </div>
        </div>
        <br>
        @endif
        @foreach($categories as $category)
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-11 col-10">
                <div class="card sub-section">
                    <div class="card-header section-header"><h6 class="card-title">{{$category['name']}}</h6></div>
                    <div class="card-body">
                        <ul class="list-group sub-section flex-column">
                            @foreach($category['channels'] as $channel)
                            <li class="list-group-item sub-section">
                                <div class="d-flex w-100 justify-content-between">
                                    <a class="mb-1" href="{{$channel['id']}}">{{$channel['name']}}</a>
                                    <small><a href="#">Last message thread</a><br><a class="description">Last post date</a></small>
                                </div>
                                <p class="mb-1 description">{{$channel['description']}}</p><br>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div><br>
        @endforeach
    </div>
@endsection