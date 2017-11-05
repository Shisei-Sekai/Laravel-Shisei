@extends('layouts.base')
@section('content')
    <div class="container">
        <div class="row section-banner"></div>
        @if(isset($canEdit))
        <div class="row justify-content-center">
            <button type="button" class="btn post-button" id="toggleEdit">Seleccionar</button>
            <button type="button" class="btn post-button" id="deleteSelected">Borrar</button>
            <button type="button" class="btn post-button" id="moveSelected">Mover</button>
            <button type="button" class="btn post-button" id="pinSelected">Marcar</button>
        </div><br>
        @endif
        @if(isset($pinnedPost))
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-11 col-10">
                <div class="card sub-section">
                    <div class="card-header section-header"><h6 class="card-title">Pinned post</h6></div>
                    <div class="card-body">
                        <!-- every <li> is a post -->
                        <ul class="list-group sub-section flex-column">
                            <li class="list-group-item sub-section">
                                <div class="d-flex w-100 justify-content-between">
                                    <a class="mb-1" href="#">Post name</a>
                                    <small>
                                        <a href="#">Last message author</a><br><a class="description">Last post date</a>
                                    </small>

                                </div>
                                <p class="mb-1 description">This is the description of the post</p><br>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><br>
        @endif
        <!-- section post -->
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-11 col-10">
                <div class="card sub-section">
                    <div class="card-header section-header"><h6 class="card-title">{{$channelName}}</h6></div>
                    <div class="card-body">
                        <!-- Every <li> element is a post -->
                        <ul class="list-group sub-section flex-column">
                            @foreach($threads as $thread)
                            <li class="list-group-item sub-section" id="post1">
                                <div class="d-flex w-100 justify-content-between">
                                    <a class="mb-1" href="/{{$channelId}}/{{$thread['id']}}">{{$thread['title']}}</a>
                                    <small>
                                        <a href="/user/{{$thread['lastUser']}}">{{$thread['lastUser']}}</a><br><a class="description">{{$thread['lastDate']}}</a>
                                    </small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn post-button" id="newThreadButton">Nuevo tema</button>
                </div>
            </div>
        </div><br><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        let url = window.location.href.split('/');
        let channelId = url[url.length-1]? url[url.length-1]:url[url.length-2];
        $('#newThreadButton').click(function(){
            let url = document.URL;
            shortUrl = url.substring(0,url.lastIndexOf('/'));
            window.location.href = shortUrl + "/thread?channelId="+channelId;
        });
    </script>
@endsection