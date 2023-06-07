@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
    <section class="section">
      <div class="container mt-4">
      <span class="auth-header">
			   <a href="{{ route('index')}}"><img class="text-left" src="{{ asset('front/assets/img/logo.svg')}}" alt="logo"></a>
		  </span>
	   <div class="row">
          <div class="col-12 col-md-6 offset-sm-2 col-md-6 offset-md-4 col-lg-6 offset-lg-3 col-xl-5 offset-xl-4">
            <div class="card mt-5">
              @include('back-layout.error')
              <div class="auth-header text-center mt-4">
                <h4> Olukotide Super Admin Login</h4>
              </div>
              <div class="card-body mt-5">
			    <form method="POST" action="{{ route('olukotide-admins.store')}}" class="needs-validation" novalidate="">
                  @csrf
				  <div class="form-group">
                    <input id="email" type="email" placeholder="Email address" class="form-control" name="email"  autofocus>
                    <div class="invalid-feedback">
                  </div>
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" placeholder="Password"  class="form-control" name="password" tabindex="2">
                 </div>
                  <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Sign in
                    </button>
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