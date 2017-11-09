@extends('layouts.base')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
        <!-- Every row is a message -->
        <!-- Template like {% for i in message %} -->
        @foreach($posts as $index=>$post)
        <div class="row justify-content-center">
            <div id="info{{$index+1}}">
                <img class="user-avatar circular-image" src="{{$users[$post['userId']]['avatar']}}">
                <div class="main-info sub-section">
                    <div class="user-name">{{$users[$post['userId']]['name']}}</div><button type="button" class="fa fa-caret-down userdrop float-right" href="#" id="buttonMessage{{$index+1}}"></button>
                    <div class="user-info" id="userinfoMessage{{$index+1}}">
                        <!-- User role -->
                        <div class="user-details" style="text-align: center;color: {{$users[$post['userId']]['role']['color']}}">{{$users[$post['userId']]['role']['name']}}</div>
                        <!-- Messages ammount -->
                        <div class="user-details">Mesajes: <a class="ammout">{{$users[$post['userId']]['messages']}}</a></div>
                        <!-- Items -->
                        <div class="user-details">Dinero: <a class="ammount">{{$users[$post['userId']]['money']}}</a></div>
                        <!-- Badges -->
                        <div class="user-details">Exp: <a class="ammount">{{$users[$post['userId']]['exp']}}</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-8 col-sm-8">
                <div class="card sub-section">
                    <div class="card-header sub-section">
                        <h8><a href="">{{$threadName}}</a></h8>
                        <button type="button" class="fa fa-bolt float-right message-options"></button>
                        <button type="button" class="fa fa-trash float-right message-options"></button>
                        <button type="button" class="fa fa-pencil float-right message-options edit-button" id="editPost{{$post['id']}}"></button>
                    </div>
                    <div class="card-body">
                        <div class="message-body" id="message{{$index+1}}">
                            {!! $post['text'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        @endforeach

        <!-- Pagination -->
        <nav aria-label="">
            <ul class="pagination justify-content-end" id="pages">
                <!--
                <li class="page-item bg-dark" id="prev">
                    <a class="page-link bg-dark" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item" id="next">
                    <a class="page-link bg-dark" href="#" tabindex="+1">Next</a>
                </li>-->
            </ul>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-10 col-8 col-sm-8 quickReplySection">
                <div class="card sub-section">
                    <div class="card-header sub-section">
                        <h8>Respuesta rápida</h8>
                    </div>
                    <div class="card-body sub-section">
                        <form class="form-group">
                            <div id="quickReply">
                                <textarea class="form-control sub-section" id="quickReplyInfo" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn post-button" id="newPostButton">Enviar respuesta</button>
                </div>
            </div>
        </div><br><br>

        <!-- EDIT POST MODAL -->
        <div class="modal fade" id="modalEditPost" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg bg-dark" role="document">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Texto:</label>
                            <textarea type="text" class="form-control" id="postText"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="editPost" data-dismiss="modal">Editar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
        //Hide all userinfo by default
        $(document).ready(function(){
            //Enable tabs in textareas
            let postQuantity = {{$quantity}};
            console.log(postQuantity);
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
            }/*
            for(let i=Math.floor(postQuantity /20)+1;i>0;i--){
                $('#pages').after('<li class="page-item"><a class="page-link bg-dark number" href="?page='+i+'">'+(i)+'</a></li>');
            }*/
            let limit = postQuantity%20? Math.floor(postQuantity/20)+1 : Math.floor(postQuantity/20);
            for(let i=1;i<=limit;i++){
                $('#pages').append('<li class="page-item"><a class="page-link bg-dark number" href="?page='+i+'">'+(i)+'</a></li>');
            }

            let numberPattern = /\d+/g;
            let postId = 0;
            $('.user-info').hide();
            //If someone wants to know the message author info
            $('.userdrop').click(function(){
                //Get the message id
                //let numberPattern = /\d+/g;
                let messageId = $(this).attr('id');
                let infoId = messageId.match(numberPattern);
                //Show or hide the message author info
                $('#userinfoMessage'+infoId).toggle();
            });
            //Create post
            $('#newPostButton').click(function(){
                let text = $('#quickReplyInfo').val();
                let numbers = window.location.href.split('?page')[0].match(numberPattern);
                let channelId = numbers[numbers.length-2];
                let threadId = numbers[numbers.length-1];
                $.ajax({
                    url:'/'+channelId+'/'+threadId,
                    type:'POST',
                    data:{postText:text},
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
            });
            //Edit post
            $('.card-header').on('click','.edit-button',function(){
                postId = this.id.match(numberPattern);
                let text;
                $.ajax({
                    url:'/post?postId='+postId,
                    type:'get',
                    success:function(msg){
                        $('#postText').val(msg.content);
                        $('#modalEditPost').modal('show');
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
                    data:{'text':text,'postId':postId},
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
        });
    </script>
@endsection