@extends('layouts.app')
@section('content')
<title>إعتراف | الملف الشخصي </title>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<link rel="stylesheet" href="{{ asset('css/profile.css') }}" type="text/css">

<section class="container-fluid news-sec" style="margin-top: 50px">
    <div class="container" style="margin-bottom: 140px">

<div class="container ">
<div class="col-md-12 text-center">

<form id="update"  method="" enctype="multipart/form-data" action="" >
@csrf
<input  id="photo"  name="photo" type="file" style="visibility:hidden ">
<label for="photo" class="btn" style="position: relative; top:190px; color:rgb(255, 255, 255);background-color:black">تغيير الصورة<i class="fas fa-edit "    ></i></label>
<span class="text-danger error-text photo_err" style="background-color:rgb(255, 230, 230)"></span>
</form>
  


@if(!empty(Auth::user()->avatar))
<div class="rounded-circle" style="background: url('{{Auth::user()->avatar}}') center center no-repeat;  text-align: center;width: 150px;height: 150px;background-size: cover;margin: auto;margin-top: 20px;margin-bottom: 30px; ">
@Elseif(!empty(Auth::user()->image))
<div class="rounded-circle" style="background: url('{{asset('images/'.Auth::user()->image)}}') center center no-repeat;  text-align: center;width: 150px;height: 150px;background-size: cover;margin: auto;margin-top: 20px;margin-bottom: 30px; ">
</div>
@else
<div class="rounded-circle" style="background: url('{{asset('images/user.png')}}') center center no-repeat;  text-align: center;width: 150px;height: 150px;background-size: cover;margin: auto;margin-top: 20px;margin-bottom: 30px; ">
@endif
<br>
</div> <h4 style="color: white">{{ Auth::user()->username }}</h4>
</div>
</div>

        <div class="card" >
                <div class="card-body">
                    <button class="btn btn-success" onclick="myFunction()">نسخ الرابط</button>
                    <input type="text" disabled value="http://127.0.0.1:8000/MessagePrivate/{{ Auth::user()->id}}/{{Auth::user()->randomNumber }}" id="myInput">
               @csrf
                </div>
            </div>
        
        <div class="row">
            <div class="col">
                <h4>البريد الخاص بك</h4>
            </div>

        </div><!--.row-->
        <hr style="border-color:red">
        <div class="row">
           

@if($posts->isEmpty())
<div class="col-md-6" style="">
    <div class="card" >
        <div class="card-body">
            <h6 class="card-subtitle mb-2" >لايوجد رسائل</h6>
        </div>
    </div>
</div>

@endif
@foreach ($posts as $item)

            <div class="col-md-6">
            <a href="\delete\{{$item->id}}">  <i class="fas fa-trash-alt"> </i> حذف</a>

                <div class="card">
                    
                    <div class="card-body">
                        <span class="badge  " style="font-size: 16px">{{$item->created_at->format('d/m/Y   H:i') }}</span>
                        <h6 class="card-subtitle mb-2">{{$item->body}}</h6>
                    </div>
                </div>
                <hr style="border-color:#01a2e5">
            </div>
@endforeach

            <!--.col-->
        </div>
      <!--  <div class="row">
            <div class="col text-left">
                <a href="#" class="text-danger small">مشاهده تمام اخبار</a>
            </div>
        </div>-->
    </div>
</section>

<script>
function myFunction() {

var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  navigator.clipboard.writeText(copyText.value);
    alert("تـم نسخ الرابط ");

}


$(document).on('ready', function(){
  $('#photo').on('change', function(){
    $('#update').submit();
  });
});




        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
   $('#update').submit(function(e) {
       e.preventDefault();

       let formData = new FormData(this);
        $('.photo').text('');
       $.ajax({
          type:'POST',
          url: '/EditeImage',
           data: formData,
           contentType: false,
           processData: false,
           success: function(data) {
        printMsg(data);
        }
        });
        }); 
        function printMsg (msg) {
        if($.isEmptyObject(msg.error)){
            alert("تــم تحديث بياناتك بنجاح ");
        window.location.href = "/profile"
        }
        else{
        $.each( msg.error, function( key, value ) {
        $('.'+key+'_err').text(value);
        });
        }
        }




</script>

@endsection
