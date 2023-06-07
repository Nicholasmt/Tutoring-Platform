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
                <h4 class="font-24">Reset Password</h4>
                <span class="font-12">Kindly input your New Password </span>
              </div>
              <div class="card-body">
			        <form method="POST" action="{{ route('reset')}}" class="needs-validation" novalidate="">
              @csrf
				       <div class="form-group">
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <input id="email" type="password" placeholder="New Password" class="form-control" name="new_password" required>
                   <div class="invalid-feedback">Enter New Password</div>
                    @error('new_passowrd')
                      <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <input id="email" type="password" placeholder="Confirm Password" class="form-control" name="confirm_password" required>
                  <div class="invalid-feedback">Enter Confirm Password</div>
                    @error('confirm_passowrd')
                      <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-5">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" name="reset" tabindex="4">Change password</button>
                </div>
               </form>
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