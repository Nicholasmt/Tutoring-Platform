@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
<div class="loader"></div>
    <section class="section">
      <div class="container mt-4">
      <span class="auth-header">
			   <a href="{{ route('index')}}"><img class="text-left" src="{{ asset('front/assets/img/logo.svg')}}" alt="logo"></a>
		  </span>
	   <div class="row justify-content-center">
          <div class="col-12 col-md-6 col-md-6 col-lg-6 col-xl-5">
            <div class="card  mt-5">
              @include('back-layout.error')
              <div class="auth-header text-center mt-5">
                <h4 class="font-24">Log In to Olukotide</h4>
              </div>
              <div class="card-body">
			          <form method="POST" action="{{ route('teachers-auth')}}" class="needs-validation" novalidate="">
                  @csrf
				          <div class="form-group">
                    <input id="email" type="email" placeholder="Email address" class="form-control" name="email" autofocus required>
                      @error('email')
                        <div class="text-danger">{{$message}}</div>
                      @enderror
                     <div class="invalid-feedback">
                        Enter Email!
                     </div>
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" placeholder="Password"  class="form-control" name="password" tabindex="2" required>
                      @error('password')
                        <div class="text-danger">{{$message}}</div>
                      @enderror
                      <div class="invalid-feedback">
                        Enter Password!
                      </div>
                      <div class="float-right mr-2">
                        <a href="{{ route('forgot-password')}}" class="text-small btn">
                          Forgot Password?
                        </a>
                      </div>
                  </div>
                  <div class="form-group mt-5">
                    <button type="submit" class="primary btn-border btn-lg btn-block" tabindex="4">
                    Log in
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                   <div class="text-job text-muted font-14 mb-4">
                       <span><img src="{{ asset('back/assets/img/vectors/line 2.svg')}}" alt=""></span> Or 
                       <span><img src="{{ asset('back/assets/img/vectors/line 2.svg')}}" alt=""></span></div>
                 </div>
                <div class="row sm-gutters">
                <div class="col-md-12 mb-4">
                 <form action="{{ route('socialite')}}" method="POST">
                  @csrf
                  <input type="hidden" value="sign-in" name="type">
                   <button type="submit" name="google_btn" class="font-14 font-weight-bold btn-block btn btn-outline-secondary btn-lg socail_button">
                      <span class="mr-2"><img src="{{ asset('back/assets/img/icons/g-icon.png')}}" height="20" width="20" alt=""></span> Log in with Google
                  </button>
                  <button type="submit" name="facebook_btn" class="font-14 text-center text-white btn btn-info btn-block btn-lg mt-3">
                      <i class=""></i><span class="fab fa-facebook mr-2"></span>  Log in with Facebook
                  </button>
                  </form>
                </div>
                </div><hr>
              <div class="mt-2 text-muted text-center mb-4">
                Don't have an account? <a href="{{ route('choose-profile')}}" class="text-danger">Sign up</a>
            </div>
            </div>
           </div>
        </div>
      </div>
      <div class="text-left ml-4 text-black mt-5">
        <p><a target="_blank" >{{date('Y')}} &copy; Olukotide. All rights reserved.</i></a></p>
      </div>
    </section>
   
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('back/assets/js/custom.js')}}"></script>
</body>

@endsection