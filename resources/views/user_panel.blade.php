@extends('layouts.base_materialized')
@section('content')
    <style>
        .item-details{
            background: black;
            color: white;
            position:absolute;
            display: none;
            max-width: 100%;
            width: 100%;
            border-radius: 5px;
            text-align: center;
        }
        li a:focus{
            outline:none;
        }
    </style>

    <div class="section row-full blue-grey darken-1">
        <div class="row">
            <div class="col s12 m12">
                <div class="card blue-grey darken-1 z-depth-0">
                    <div class="card-content white-text z-depth-0">
                        <div class="section">
                            <div class="row">
                                <div class="col s2 m2 center-align">
                                    <p class="card-title">{{$user['name']}}</p>
                                    <img src="{{$user['avatar']}}" class="circle center" style="width:150px;height:150px;object-fit: cover">
                                    <p style="color:{{$user['role']['color']}}">{{$user['role']['name']}}</p>
                                    <p>Dinero: {{$user['money']}}</p>
                                    <p>Experiencia: {{$user['exp']}}</p>
                                </div>
                                <div class="col s10 m10">
                                    <div class="container">
                                        <div class="row center-align">
                                            <nav class="nav-extended z-depth-0" style="background: transparent;border: none">
                                                <div class="nav-content center-align center">
                                                    <ul class="tabs tabs-transparent center-align center text-center">
                                                        <li class="tab center"><a class="active center" href="#items" id="user-items">Items</a></li>
                                                        <li class="tab center"><a class="center" href="#test2" id="last-messages">Ultimos mensajes</a></li>
                                                        <li class="tab center"><a href="#Badges" id="user-badges">Medallas</a></li>
                                                        <li class="tab center"><a href="#characterCard" id="character-card">Ficha de personaje</a></li>
                                                        @if($user['owner'])
                                                        <li class="tab center"><a href="#combatCard" id="combat-card">Ficha de combate</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                        <div class="row" id="menu-content" style="margin-top: 50px;overflow: auto;height: 200px">
                                            @foreach($user['items'] as $index=>$item)
                                                <div class="col loaded-element" style="position: relative">
                                                    <img src="{{$item['icon']}}" style="width:30px;height:30px;object-fit: cover" title="{{$item['name']}}" id="item{{$index}}" class="item">
                                                    <div id="item{{$index}}Details" class="item-details">
                                                        <p>{{$item['description']}}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-action">
                        @if($user['owner'])
                            <form method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col s6 m6">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Cambiar avatar</span>
                                                <input type="file" name="userAvatar" id="uploadUserAvatar" placeholder="Cambiar avatar">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m6 s6">
                                        <button class="btn left z-depth-0" type="submit" style="border: none;background: transparent;margin-top: 40px">Cambiar</button>
                                    </div>
                                </div>
                            </form>
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="chip">
                                        {{$error}}
                                        <i class="close material-icons">close</i>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        let numberPattern = /\d+/g; //Regex to get all numbers
        let href = location.href; //Current url
        let userName = href.match(/([^\/]*)\/*$/)[1]; //Get the username from the url
        let id = -1; //Default id is -1
        $(document).ready(function(){
            //Show item description
            $('.item').hover(function(){
                id = this.id.match(numberPattern)[0];
                $('#item'+id+'Details').css('display',"block");

            },
            function(){
                //Hide it's description
                $('#item'+id+'Details').css('display',"none");
            });
            /** Change tab **/
            $('.tab').click(function(){
                $('.loaded-element').remove();
                loadTab($(this).children().attr('id'))
            });
            //Process the tab select
            function loadTab(tab){
                let fn;
                let url = `/user/${userName}/`;
                switch(tab){
                    case "user-items":
                        fn = loadUserItems;
                        url += "getItems";
                        break;
                    case "last-messages":
                        fn = getUserLastMessages;
                        url += "getLastMessages";
                        break;
                    case "user-badges":
                        fn = getUserBadges;
                        url += "getBadges";
                        break;
                    case "character-card":
                        fn = getCharacterCards;
                        url += "getCharacterCards";
                        break;
                    case "combat-card":
                        fn = getCombatCard;
                        url += "getCombatCards";
                        break;
                }
                makeAjax(url,"GET").done(fn);
            }

            function loadUserItems(data){
                $.each(data,function(index,element){
                    $('#menu-content').append(` <div class="col loaded-element" style="position: relative">
                                                    <img src="${element.icon}" style="width:30px;height:30px;object-fit: cover" title="${element.name}" id="item${index}" class="item">
                                                    <div id="item${index}Details" class="item-details">
                                                        <p>${element.description}</p>
                                                    </div>
                                                </div>`)
                });
                console.log("working!");
            }

            function getUserLastMessages(data){
                $('#menu-content').append("<ul class=\"collection\" id=\"something\" style=\"background:transparent\"></ul>");
                $.each(data,function(index,element){
                    $('#something').append(`<li class="collection-item" style="background: transparent"><a href="/${element.channel.id}/${element.thread.id}">${element.channel.name}/${element.thread.name}</a></li>`);
                });
                console.log("Last messages");
            }

            function getUserBadges(data){
                console.log("Badges");
            }

            function getCharacterCards(data){
                console.log("Character cards");
            }

            function getCombatCard(data){
                console.log("Combat cards");
            }

            //makeAjax().done(function1)
            function makeAjax(url,type){
                return $.ajax({
                    url:url,
                    type:type,
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }


        });
    </script>
@endsection