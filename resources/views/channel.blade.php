@extends('layouts.base_materialized')
@section('content')
    <div class="section">
        <div class="container">
            <ul class="collection">
                @auth
                <li class="collection-item">
                    @if(!$isClosed)
                        <a class="waves-effect waves-light btn modal-trigger" href="#createPostModal" style="color: white">Crear post</a>
                        @if($canClose)
                        <a id="change-status" class="waves-effect waves-light btn modal-trigger" style="color: white">Cerrar</a>
                        @endif
                    @else
                        <a class="waves-effect waves-light btn modal-trigger disabled" href="#createPostModal" style="color: white">Cerrado</a>
                        @if($canClose)
                        <a id="change-status" class="waves-effect waves-light btn modal-trigger" style="color: white">Abrir</a>
                        @endif
                    @endif
                </li>
                @endauth
                <!-- Every <li> is a post -->
                @foreach($threads as $thread)
                <li class="collection-item avatar hoverable">
                    <!-- Post author avatar -->
                    <!--<img src="https://u.rindou.moe/Aztic_avatar.jpg" alt="" class="circle" style="object-fit: cover">-->
                    <!-- Post title -->
                    <a class="title" href="/{{$channelId}}/{{$thread['id']}}">{{$thread['title']}}</a>
                    <!-- Description?
                    <p>First Line <br>
                        Second Line
                    </p>-->
                    <!-- Last post user and date -->
                    <div class="secondary-content" style="margin-right:10px">
                        <a href="/user/{{$thread['lastUser']}}">{{$thread['lastUser']}}</a><br>
                        <span>{{$thread['lastDate']}}</span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>


        <ul class="pagination center" id="pages">
            <!--
            <li class="active"><a href="?page=1">1</a></li>
            <li class="waves-effect"><a href="?page=2">2</a></li>
            <li class="waves-effect"><a href="?page=3">3</a></li>
            <li class="waves-effect"><a href="?page=4">4</a></li>
            <li class="waves-effect"><a href="?page=5">5</a></li>
            <li class="waves-effect"><a href=""><i class="material-icons">chevron_right</i></a></li>-->
        </ul>
        <!-- Modal Structure -->
        <div id="createPostModal" class="modal modal-fixed-footer white">
            <div class="modal-content">
                <h5 class="center">Crear post</h5>
                <form class="col s12">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Título" id="threadTitle" type="text" class="validate">
                            <label for="threadTitle">Título del post</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="postText" class="materialize-textarea"></textarea>
                            <label for="postText">Texto</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer blue">
                <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
                <a class="modal-action modal-close waves-effect waves-green btn-flat" id="createPost">Crear</a>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
            let numberPattern = /\d+/g;
            //Thread management
            let params = new URLSearchParams(window.location.search);
            let currentPage = params.has('page')? parseInt(params.get('page')):1;
            let threadQuantity = {{$quantity}};
            let limit = threadQuantity%20? Math.floor(threadQuantity/20)+1 : Math.floor(threadQuantity/20);
            for(let i=1;i<=limit;i++){
                if(i === currentPage)
                    $('#pages').append('<li class="active"><a href="?page='+i+'">'+(i)+'</a></li>');
                else
                    $('#pages').append('<li class="waves-effect"><a href="?page='+i+'">'+(i)+'</a></li>');
            }

            $('.modal').modal();
            //Enable tabs in textareas
            var textareas = document.getElementsByTagName('textarea');
            var count = textareas.length;
            for(var i=0;i<count;i++){
                textareas[i].onkeydown = function(e){
                    if(e.keyCode==9 || e.which==9){
                        e.preventDefault();
                        var s = this.selectionStart;
                        this.value = this.value.substring(0,this.selectionStart) + "    " + this.value.substring(this.selectionEnd);
                        this.selectionEnd = s+'    '.length;
                    }
                }
            }
            $('#createPost').click(function(){
                let title = $('#threadTitle').val();
                let content = $('#postText').val();
                let numbers = window.location.href.split('?page')[0].match(numberPattern);
                let channelId = numbers[numbers.length-1];
                console.log(channelId);
                $.ajax({
                    url:'/'+channelId,
                    type:'POST',
                    data:{postText:content,threadTitle:title},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(msg){
                        location.reload();
                    },
                    error:function(msg){
                        console.log(msg);
                    }
                });
                console.log(channelId);
            });

            @if($canClose)
            $('#change-status').click(function(){
                var href = location.href;
                let threadId = href.match(/([^\/]*)\/*$/)[1];
                $.ajax({
                    type:'PUT',
                    url:'/channel/alter',
                    data:{id:threadId},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(){
                        location.reload();
                    },
                    error:function(msg){
                        console.log(msg);
                    }
                })
            });
            @endif
        });
    </script>

@endsection