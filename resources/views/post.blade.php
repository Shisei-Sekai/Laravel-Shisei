@extends('layouts.base_materialized')
@section('content')
    <div class="section">
        <!-- Desktop/Tablet section -->
        @foreach($posts as $index=>$post)
        <div class="row">
            <div class="hide-on-med-and-down">
                <div id="info{{$index+1}}" class="col m2 center-align">
                    <img src="{{$users[$post['userId']]['avatar']}}" class="circle" style="width:150px;height:150px;object-fit: cover">
                    <div class="main-info sub-section">
                        <button type="button" class="userdrop right"  id="buttonMessage{{$index+1}}"><i class="material-icons arrowdown">keyboard_arrow_down</i></button>
                        <div class="user-name center">{{$users[$post['userId']]['name']}}</div>
                        <div class="user-info" id="userinfoMessage{{$index+1}}">
                            <!-- User role -->
                            <div class="user-details" style="text-align: center;color: {{$users[$post['userId']]['role']['color']}}">{{$users[$post['userId']]['role']['name']}}</div>
                            <!-- Messages ammount -->
                            <div class="user-details">Mensajes: <span class="ammout">{{$users[$post['userId']]['messages']}}</span></div>
                            <!-- Items -->
                            <div class="user-details">Dinero: <span class="ammount">{{$users[$post['userId']]['money']}}</span></div>
                            <!-- Exp -->
                            <div class="user-details">Exp: <span class="ammount">{{$users[$post['userId']]['exp']}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col m10">
                <div class="card-panel grey lighten-2 hoverable" style="border-radius:5px">

                    <div class="card-content">
                        <a class="card-title activator grey-text text-darken-4 dropdown-button" data-activates="options-dropdown{{$index+1}}"><i class="material-icons right">more_vert</i></a>
                        <ul id="options-dropdown{{$index+1}}" class="dropdown-content left">
                            @if($post['canEdit'])
                                <li><a href="#" id="editButton{{$post['id']}}" class="edit-button">Editar</a></li>
                                <li><a href="#">Borrar</a></li>
                                <li class="divider"></li>
                            @endif
                            <li><a href="#">Reportar</a></li>
                        </ul>
                        <div class="message-body" id="message{{$index+1}}">
                            {!! $post['text'] !!}
                        </div>
                    </div>
                    <div class="card-action hide-on-med-and-up">
                        <img src="{{$users[$post['userId']]['avatar']}}" class="circle" style="width:40px;height:40px;object-fit: cover;margin-top: 50px"><div class="user-name">{{$users[$post['userId']]['name']}}</div>
                    </div>

                </div>
            </div>


            <div class="hide show-on-small">
                <div class="col s12 m12">
                    <div class="card-panel teal hoverable" style="border-radius:5px">

                        <a class="card-title activator grey-text text-darken-4 dropdown-button" href="#" data-activates="options-dropdownM{{$index+1}}"><i class="material-icons right">more_vert</i></a>
                        <ul id="options-dropdownM{{$index+1}}" class="dropdown-content left">
                            @if($post['canEdit'])
                            <li><a href="#" id="editButtonM{{$post['id']}}" class="edit-button">Editar</a></li>
                            <li><a href="#">Borrar</a></li>
                            <li class="divider"></li>
                            @endif
                            <li><a href="#">Reportar</a></li>
                        </ul>
                        <div class="message-body mobile-message" id="messageMobile{{$index+1}}">
                            {!! $post['text'] !!}
                        </div>


                    </div>

                </div>
            </div>
        </div>
        @endforeach



    </div>

    <ul class="pagination center" id="pages">
    </ul>
    @auth
        <!-- Only authenticated people can see this -->
        <div class="section row-full teal white-text">
            <div class="row center">
                @if(!$isClosed)
                    <form class="col s10 center" method="post">
                        {{csrf_field()}}
                        <div class="row center">
                            <div class="input-field col s10 offset-s3">
                                <textarea id="quickReplyInfo" name="postText" class="materialize-textarea"></textarea>
                                <label for="quickReplyInfo" class="white-text">Respuesta</label>
                            </div>
                        </div>
                        <button class="btn left z-depth-0" type="submit" style="border: none;background: transparent">Enviar
                            <i class="material-icons right">send</i>
                        </button>
                        @if($canClose)
                            <button type="button" class="btn z-depth-0 right" id="change-status" style="border: none;background: transparent">cerrar
                                <i class="material-icons right">clear</i>
                            </button>
                        @endif
                    </form>
                @else
                    <form class="col s10 center" method="post">
                        <div class="row center">
                            <div class="input-field col s10 offset-s3">
                                <textarea id="quickReplyInfo" name="postText" class="materialize-textarea" disabled></textarea>
                                <label for="quickReplyInfo" class="white-text">Tema cerrado</label>
                            </div>
                        </div>
                        @if($canClose)
                            <button type="button" class="btn z-depth-0 right" id="change-status" style="border: none;background: transparent">Abrir
                                <i class="material-icons right">done</i>
                            </button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    @endauth

    <div id="editPostModal" class="modal modal-fixed-footer white">
        <div class="modal-content">
            <h5 class="center">Editar post</h5>
            <form class="col s12">
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="postText" class="materialize-textarea"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer blue">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" id="editPost">Editar</a>
        </div>
    </div>
    <script>hljs.initHighlightingOnLoad();</script>
    <script language="javascript" type="text/javascript">
        //Hide all userinfo by default
        $(document).ready(function(){
            let params = new URLSearchParams(window.location.search); //URL params
            let currentPage = params.has('page')? parseInt(params.get('page')):1; //Get track of current page
            $('.modal').modal(); //Load modal

            //Post quantity, duh
            let postQuantity = {{$quantity}};
            //Enable tabs in textareas
            let textareas = document.getElementsByTagName('textarea');
            let count = textareas.length;
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
            let limit = postQuantity%20? Math.floor(postQuantity/20)+1 : Math.floor(postQuantity/20);
            for(let i=1;i<=limit;i++){
                if(i === currentPage)
                    $('#pages').append('<li class="active"><a href="?page='+i+'">'+(i)+'</a></li>');
                else
                    $('#pages').append('<li class="waves-effect"><a href="?page='+i+'">'+(i)+'</a></li>');
            }

            let numberPattern = /\d+/g;
            let postId = 0;
            $('.user-info').hide();
            //If someone wants to know the message author info
            $('.userdrop').click(function(){
                console.log('clicked');
                let messageId = $(this).attr('id');
                let infoId = messageId.match(numberPattern);
                //Show or hide the message author info
                $('#userinfoMessage'+infoId).toggle();
            });/*
            $('.main-info').on("click",'.userdrop',function(){
                //Get the message id
                //let numberPattern = /\d+/g;
                console.log('clicked');
                let messageId = $(this).attr('id');
                let infoId = messageId.match(numberPattern);
                //Show or hide the message author info
                $('#userinfoMessage'+infoId).toggle();
            });*/
            //Edit post

            $('.edit-button').click(function () {
                postId = this.id.match(numberPattern)[0];
                $.ajax({
                    url:'/post?postId='+postId,
                    type:'get',
                    success:function(msg){
                        $('#postText').val(msg.content);
                        $('#editPostModal').modal('open');
                    }
                });
            });
            //Submit edit post
            $('#editPost').click(function(){
                let text = $('#postText').val();
                $.ajax({
                    url:'/post',
                    type:'PUT',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{text:text,postId:postId},
                    success:function(msg){
                        location.reload();
                    },
                    error:function(msg){
                        console.log(msg);
                    }
                });
            });
            hljs.configure({useBR: false});
            $('code').each(function(i, block) {
                hljs.highlightBlock(block);
            });

            //Dropdowns
            $('.dropdown-button').dropdown();

            @if($canClose)
            $('#change-status').click(function(){
                var href = location.href;
                let threadId = href.match(/([^\/]*)\/*$/)[1];
                $.ajax({
                    type:'PUT',
                    url:'/thread/alter',
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
                });
            });
            @endif

        });
    </script>
@endsection