<!doctype html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('css/aos.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">

<link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/post.css') }}" type="text/css">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<title>إعتراف | رسالة سرية </title>
</head>
<style>
a:hover {
   text-decoration: none;
}</style>
<body>
<div class="site-wrap">
<div class="site-mobile-menu">
<div class="site-mobile-menu-header">
<div class="site-mobile-menu-close mt-3">
<span class="icon-close2 js-menu-toggle"></span>
</div>
</div>
<div class="site-mobile-menu-body"></div>
</div> <!-- .site-mobile-menu -->    
<div class="site-navbar-wrap">
<div class="site-navbar">
<div class="container py-1">
<div class="row align-items-center">
<div class="col-10">
  <nav class="navbar   navbar-expand-md  top-nav" style="background-color: #000000;color:red">
    <div class="container">
    <a class="navbar-brand" href="\">
    <img src="{{asset('images\logo1.png')}}" width="150 px">
    </a>
    </div>
    </nav>
</div>
</div>
</div>
</div>
</div>
<div class="site-section">
    <div class="content" style="margin-bottom: 100px;margin-top: 110px">
      
      <div class="container ">
        <div class="col-md-12 text-center">
        @if(!empty($user->avatar))
            <div class="rounded-circle" style="background: url('{{$user->avatar}}') center center no-repeat;  text-align: center;width: 150px;height: 150px;background-size: cover;margin: auto;margin-top: 20px;margin-bottom: 30px; ">
        @else
        <div class="rounded-circle" style="background: url('{{asset('images/user.png')}}') center center no-repeat;  text-align: center;width: 150px;height: 150px;background-size: cover;margin: auto;margin-top: 20px;margin-bottom: 30px; ">
        @endif
        
        </div> <h4 style="color: white">{{ $user->username }}</h4>
        </div>
        </div>
    
        <div class="wrapper-1">
          <div class="wrapper-2">
            <h1 style="font-size: 20px">رسالة خاصة</h1>
           
            <form id="Message" action="" method="post">
                @csrf
                <div class="form-group">
                <textarea name="post" id="post" cols="30" rows="10" placeholder="أكتب هنا..."></textarea>
            </div>
            <span style=" color: white"  class="error-text post_err"></span>
<input type="hidden" name="number" value="{{ $number }}">
<input type="hidden" name="id" value="{{ $id }}">

                <div class="form-group"> 
                <input class="go-home" type="submit" value="إرسال">
            </div>
            </form>

        </div>
      </div>
      </div>


<div class="container">
  <hr class="dropdown-divider">


<footer>
<p style="text-align: center" > إعتراف <i class="fal fa-copyright"></i></p>
<div class="" style="text-align: center">
<a href="#"><i class="fab fa-facebook"></i></a>
<a href="#"><i class="fab fa-twitter"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
<a href="#"><i class="fab fa-dribbble"></i></a>
</div>

</div>
</footer>
</div>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

$('#Message').submit(function(e) {
e.preventDefault();
let formData = new FormData(this);
$('.post_err').text('');
$.ajax({
type:'POST',
url: '/SendMessagePrivate',
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
alert("تم إرسال الرسالة ");
window.location.href = "/profile"
}
else{
$.each( msg.error, function( key, value ) {
$('.'+key+'_err').text(value);
});
}
}
</script>

</body>
</html>


