@extends('layouts.app')
@section('content')


<link rel="stylesheet" href="{{ asset('css/login.css') }}" type="text/css">

<div id="logreg-forms" style="margin-top: 100px; margin-bottom: 180px">
<!-- LOGIN  -->  

<form method="POST" class="form-signin"  action="{{ route('login') }}" >
@csrf
<h5 class=" mb-3 " style="text-align: center; color:aliceblue"> سجل دخولك من خلال</h5> <br>
<div class="container ">
    <div class="col-md-12 text-center">
       <a href="auth/google/redirect"><button type="button" class="btn btn-danger">Google <i class="fab fa-google"></i></button></a>
    </div>
</div>
<br>
<p style="text-align:center; color:white"> أو  </p>
<div class="input-group">
<input id="email" type="text"class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="البريد الالكتروني" oninvalid="this.setCustomValidity('ادخل البريد الالكتروني')"
oninput="this.setCustomValidity('')">
@error('email')
<span class="invalid-feedback" role="alert">
<strong style="color: white;text-align:right">{{ $message }}</strong>
</span>
@enderror
</div>
<div class="input-group" >
<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
required autocomplete="current-password" placeholder="كلمة المرور" oninvalid="this.setCustomValidity('ادخل كلمة المرور')"
oninput="this.setCustomValidity('')">
@error('password')
<span class="invalid-feedback" role="alert">
<strong style="color: white;text-align:right">{{ $message }}</strong>
</span>
@enderror      
</div>
<div class="input-group">
<button class="btn btn-md btn-rounded btn-block form-control submit" type="submit"><i class="fas fa-sign-in-alt"></i> دخول</button>
</div>

<a href="#" id="forgot_pswd">هل نسيت كلمة المرور؟</a>
<hr>
<button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> تسجيل حساب جديد</button>
</form>
<!-- END LOGIN  -->  


<!-- RESET PASS  -->  
<form action="#" class="form-reset">
<input type="email" id="resetEmail" class="form-control" placeholder="عنوان البريد الالكترونى" required="" autofocus="">
<button class="btn btn-primary btn-block" type="submit">إعادة تعيين كلمة المرور</button>
<a href="#" id="cancel_reset"><i class="fas fa-chevron-double-right"></i> رجوع</a>
</form>
<!-- END RESET PASS  -->  

<!-- SIGNUP  --> 

<form  id="SignUp" class="form-signup" method="POST" action="">
@csrf


<input id="email" type="text" placeholder="أدخل البريد الإلكتروني"  class="form-control" name="email" >
<span style=" color: white"class="error-text email_err"></span>

<input id="password"  placeholder="أدخل كلمة المرور"  type="password" class="form-control" name="password"  autocomplete="كلمة المرور">
<span style=" color: white" class="error-text password_err"></span>

<input id="password-confirm"   placeholder="أدخل  تأكيد كلمة المرور"  type="password" class="form-control" name="password_confirmation"  autocomplete="تأكيد كلمة المرور ">

<div class="input-group">
<button type="submit" class="btn btn-primary btn-lg btn-block "><i class="fas fa-user-plus"></i> تسجيل</button>
</div>


<a href="#" id="cancel_signup"><i class="fas fa-chevron-double-right"></i> رجوع</a>
</form>

<!--END  SIGNUP  -->  

<br>

</div>


<script>
function toggleResetPswd(e){
e.preventDefault();
$('#logreg-forms .form-signin').toggle() // display:block or none
$('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
e.preventDefault();
$('#logreg-forms .form-signin').toggle(); // display:block or none
$('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
// Login Register Form
$('#logreg-forms #forgot_pswd').click(toggleResetPswd);
$('#logreg-forms #cancel_reset').click(toggleResetPswd);
$('#logreg-forms #btn-signup').click(toggleSignUp);
$('#logreg-forms #cancel_signup').click(toggleSignUp);
})


$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#SignUp').submit(function(e) {
e.preventDefault();

let formData = new FormData(this);
$('.username_err').text('');
$('.email_err').text('');
$('.password_err').text('');
$.ajax({
type:'POST',
url: '/signup',
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
window.location.href = "/profile";}
else{
$.each( msg.error, function( key, value ) {
$('.'+key+'_err').text(value);});}
}
</script>
@endsection






