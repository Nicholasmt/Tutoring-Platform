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
            <a href="{{ route('index')}}">
              <img class="text-left" src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
             </a>
			    <p class="text-right  mt-text">Looking to teach? <span><a href="{{ route('teachers-sign-up')}}" class="font-14 font-weight-600"> Apply as teacher</a></span></p>
	   </span>
	   <div class="row justify-content-center">
          <div class="col-12 col-md-5 col-md-5 col-lg-5 col-xl-5">
            <div class="card mt-5 ">
             <div class="auth-header text-center mt-5 mb-2">
                <h4 class="font-24">Sign Up to get an excellent Teacher</h4>
              </div>
              <div class="card-body">
			    <form method="POST" class="needs-validation" novalidate="" action="{{ route('authstudents.store')}}" class="needs-validation" novalidate="">
            @csrf
				     <div class="row sm-gutters">
                  <div class="col-6">
                    <div class="form-group">
                      <input type="text" value="{{old('first_name')}}" name="first_name" placeholder="First Name" class="form-control" required="">
                      <div class="invalid-feedback">
                          What's Your first name?
                      </div>
                     </div>
                   
                  </div>
                  <div class="col-6">
				            <div class="form-group ">
                      <input type="text" value="{{old('last_name')}}" name="last_name" placeholder="Last Name" class="form-control" required="">
                      <div class="invalid-feedback">
                          What's Your last name?
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <input id="email" type="email" value="{{old('email')}}"  placeholder="Email address" class="form-control" name="email" tabindex="1" required>
                      <div class="invalid-feedback">
                        Enter a valid email
                      </div>
                      @error('email')
                        <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      choose a password for your account!
                    </div>
                  </div>
                  <div class="form-group font-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" value="on" id="remember-me" required @if(old('agree') == 'on')  checked="checked" @endif>
                      <label class="custom-control-label auth-header" for="remember-me">Yes, I understand and agree to the Olukotide <a href="{{ route('terms')}}" >Terms of Service</a>, including the <a href="{{ route('policy')}}" >User Agreement</a> and <a href="{{ route('policy')}}" class="">Privacy Policy</a></label>
                      <div class="invalid-feedback">
                       Agree to the Olukotide Terms of Service, including the User Agreement and Privacy Policy 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="primary btn-lg btn-block" tabindex="4">
                      Create my account
                    </button>
                  </div>
                </form>
                 <div class="text-center mt-4 mb-3">
                   <div class="text-job text-muted font-14 mb-4">
                       <span><img src="{{ asset('back/assets/img/vectors/line 2.svg')}}" alt=""></span> Or 
                       <span><img src="{{ asset('back/assets/img/vectors/line 2.svg')}}" alt=""></span></div>
                 </div>
                <div class="row sm-gutters">
                <div class="col-md-12">
                 <form action="{{ route('socialite')}}" method="POST">
                  @csrf
                  <input type="hidden" value="student" name="type">
                   <button type="submit" name="google_btn" class="font-weight-bold font-14 btn-block btn btn-outline-secondary btn-lg socail_button">
                      </i><span class="mr-2"><img src="{{ asset('back/assets/img/icons/g-icon.png')}}" height="20" width="20" alt=""></span> Sign Up with Google
                  </button>
                  <button type="submit" name="facebook_btn" class="text-center text-white btn btn-info btn-block btn-lg mt-3 font-14 font-weight-bold">
                      <i class=""></i><span class="fab fa-facebook mr-2"></span> Sign Up with Facebook
                  </button>
                 </form>
                </div>
                </div><hr>
             <div class="mt-2 text-muted text-center mb-4">
              Already have an account? <a href="{{ route('sign-in')}}" class="text-danger">Sign in</a>
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