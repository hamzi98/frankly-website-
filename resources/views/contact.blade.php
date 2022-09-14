@extends('layouts.app')
@section('content')

<title>إعتراف | تواصل معنا </title>

<div class="container contact" style="margin-top: 100px">
<div class="row">
<div class="col-md-3">
<div class="contact-info">
<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
<h2>تواصل معنا</h2>
</div>
</div>
<div class="col-md-9">
<form id="conntact" method="POST"  class="contact-form" >
    @csrf
<div class="form-group">
<div class="col-sm-10">          
<input type="text" class="form-control" id="fullname" placeholder="الاسم " name="fullname">
<span class="text-danger error-text fullname_err"></span>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
<input type="email" class="form-control" id="email" placeholder=" البريد الإلكتروني" name="email">
<span class="text-danger error-text email_err"></span>
</div>

</div>
<div class="form-group">
<div class="col-sm-10">
<textarea class="form-control" name="message" rows="5" id="message" placeholder="الرسالة"></textarea>
<span class="text-danger error-text message_err"></span>
</div>

</div>
<div class="form-group">        
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">ارسال</button>
</div>

</div>
</div>
</div>
</div>
</div>

</div>



<script>

$.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
   $('#conntact').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
        $('.fullname_err').text('');
        $('.email_err').text('');
        $('.message_err').text('');
       $.ajax({
          type:'POST',
          url: 'send',
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
alert("تم ارسال الرسالة سيتم التواصل معك خلال 24 ساعة ");
        window.location.href = "/"
        }
        else{
        $.each( msg.error, function( key, value ) {
        $('.'+key+'_err').text(value);
        });
        }
        }
</script>



@endsection
