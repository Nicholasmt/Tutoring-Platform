@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div class="loader"></div>
<div id="app">
  <div class="main-wrapper main-wrapper-1">
    <div class="main-conten">
      <section class="section">
        <div class="container">
          <div class="row mt-5">
            <a href="{{ route('index')}}"><img class="ml-5" src="{{ asset('front/assets/img/logo.svg')}}" alt="logo"></a>
           <div class="col-md-12">
            <div class="ml-5">
              @include('back-layout.error')
              <div class="auth-header text-left">
              <h5 class="font-16 text-capitalize mt-5">Hi There!</h5>
              <p class="font-16">Kindly verify your email address in order to complete your registration. </p>
              <p class="font-16">If there’s anything you need, we’ll be here every step of the way. You can call any of our team experts at 07064711743</p>
              <p class="mt-4">Didn't get the email yet?</p>
              <div class="text-left">
                  <a href="{{ route('send-mail')}}" class="primary">Resend Link</a>
              </div>
            </div>
            <div class="mt-5 mb-5">
              <span class="font-16">Thanks, <br>
                The Olukotide Team</span>
            </div>
            
          </div>
        </div>
       </div>
      </div>
     </section>
    </div>
    <footer class="main-footer">
       <div class="float-left footer_margin">
         <span class="font-14 text-capitalize ">© 2023 Olukotide. Lagos, Nigeria</span>
      </div>
      <div class="float-right mr-5">
          <div class="row">
            <i class="fab fa-twitter ml-2"></i>
            <i class="fab fa-facebook ml-2"></i>
            <i class="fab fa-instagram ml-2"></i>
          </div>
        </div>
    </footer>
  </div>
  </div> 
<script src="{{ asset('back/assets/js/app.min.js')}}"></script>
<script src="{{ asset('back/assets/js/scripts.js')}}"></script>
<script src="{{ asset('back/assets/js/custom.js')}}"></script>
</body>

@endsection