<!doctype html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('css/aos.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">

<link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}" type="text/css">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
    <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span  class="navbar-toggler-icon" style="">    <i class="fas fa-bars" style="color:rgb(255, 136, 136); font-size:28px;"></i>
    </span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <a class="nav-link" href="\"> الصفحة الرئيسية </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="\contact"> تواصل معنا  </a>
    </li>
    
    
    @guest
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
    </li>
    
    @else
    <li class="nav-item dropdown dropdown-menu-right">
    <a id="navbarDropdown" style="  font-family: Georgia, serif; color: #ffffff" class="nav-link dropdown-toggle" href="#" role="button"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    @php 
    $parts = explode("@", Auth::user()->email);
    echo $parts[0]; 
    @endphp
    </a>
    <div style="margin-right :10px;color:red" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
  
    <a class="dropdown-item" style="color: rgb(0, 0, 0)" href="/profile"> <i class="fas fa-user-circle"></i> الملف الشخصي  </a> 
    <hr class="dropdown-divider">
    <a style="color: red" class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i>  تسجيل خروج
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
    </form>
    </div>
    </li>
    @endguest
    </ul>
    </div>
    </div>
    </nav>

</div>
</div>
</div>
</div>
</div>



<div class="site-section">  @yield('content')
<div class="container">
  <hr class="dropdown-divider">


<footer>
<p style="text-align: center"> إعتراف <i class="fal fa-copyright"></i></p>
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
</body>
</html>


