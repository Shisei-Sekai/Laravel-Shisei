@extends('layouts.base')
@section('content')
    <div class="container">
        <div class="row card sub-section">
            <div class="card-header section-header"><h6 class="card-title">Crear tema</h6></div>
            <div class="card-body">
                <form action="/threads/{{$channelId}}" class="align-content-center" method="post">
                    {{csrf_field()}}
                    <!-- Channel info, cannot edit -->
                    <div class="form-group" style="background: #9d9daf;border-radius: 15px">

                        <input type="text" readonly class="form-control-plaintext" style="margin-left: 20px" id="channelName" value="{{$channelName}}">
                    </div>
                    <!-- Thread name -->
                    <div class="form-group text-center">
                        <label for="threadName">Nombre del tema</label>
                        <input type="text" class="form-control" id="threadTitle" name="threadTitle" style="background: #9d9daf;border-radius: 15px">
                    </div>

                    <div class="form-group text-center" style="border: 2px black;border-radius: 10px">
                        <label for="postText" class="text-center">Texto</label>
                        <textarea class="form-control" id="postText" name="postText" rows="10" style="background: white;border-radius: 15px"></textarea>
                    </div>
                    <button class="btn btn-dark">Crear tema</button>
                </form>
            </div>
        </div><br>
    </div>
    <script>
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
    </script>
@endsection