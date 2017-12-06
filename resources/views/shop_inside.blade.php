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
                <div class="row">
                    <ul class="collection" style="border:none">
                        @foreach($items as $item)
                            <li class="collection-item avatar hoverable" style="background: rgba(255,255,255,0.5);margin-top: 5px" id="item{{$item['id']}}">
                                <img src="{{$item['icon']}}" alt="" class="circle">
                                <span class="title" style="color: black">{{$item['name']}}</span>
                                <p><br>
                                    {{$item['description']}}
                                </p>
                                <br>
                                <p>
                                    Precio:{{$item['buyValue']}}
                                </p><br>

                                <a class="waves-effect waves-light btn modal-trigger secondary-content" style="color: white">Comprar</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            let numberPattern = /\d+/g;
            $(".secondary-content").click(function(){
                let itemId = $(this).parent().attr('id');
                itemId = itemId.match(numberPattern);
                $.ajax({
                    url:'/shop',
                    type:'POST',
                    data:{itemId:itemId},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(msg){
                        Materialize.toast('Item comprado!', 3000)
                    },
                    error:function(msg){
                        alert(msg.responseText);
                    }
                });
            });
        });
    </script>
@endsection