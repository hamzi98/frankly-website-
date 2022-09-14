@extends('layouts.app')
@section('content')
<title>إعتراف | ادخال الاسم </title>

@if (empty(Auth::user()->username))

<link rel="stylesheet" href="{{ asset('css/username.css') }}" type="text/css">
<form id="AddUserName" action="" method="post">
@csrf
<div style="margin-top:200px;margin-bottom:240px" class="container">
<div class="row">
<div class="col-md-8 col-offset-4">
<div  class="text-input">
<input type="text" name="username" id="username" placeholder="ادخل اسم المستخدم ">
<label for="username">اسم المستخدم</label>
</div>
</div>
<div class="container ">
<div class="col-md-12 text-center">
<input type="submit" value="حفظ">
<span style=" color: white"  class="error-text username_err"></span>
</div>
</div>
</div>
</div>
</form>
<script>


$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

$('#AddUserName').submit(function(e) {
e.preventDefault();
let formData = new FormData(this);
$('.username_err').text('');
$.ajax({
type:'POST',
url: 'AddUserName',
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
window.location.href = "/profile"
}
else{
$.each( msg.error, function( key, value ) {
$('.'+key+'_err').text(value);
});
}
}
</script>

@else
@php
header("Location: " . URL::to('/profile'), true, 302);
exit();
@endphp
@endif
@endsection
