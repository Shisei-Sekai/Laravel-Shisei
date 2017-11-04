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
                        <button type="button" class="fa fa-pencil float-right message-options"></button>
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

    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script>
        //Hide all userinfo by default
        $(document).ready(function(){
            let numberPattern = /\d+/g;
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
            $('#newPostButton').click(function(){

                let text = $('#quickReplyInfo').val();
                console.log(text);
                let numbers = window.location.href.match(numberPattern);
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
        });
    </script>
@endsection