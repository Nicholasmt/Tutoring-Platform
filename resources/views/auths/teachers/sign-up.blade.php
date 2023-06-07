@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
<div class="loader"></div>
 <div class="row signin-decs">
     <div class="col-md-7">
        <section class="signin-decs">
           <div class="container mt-5">
              <div class="card-body ml-4 mt-5 sign_up_marging">
              <a href="{{ route('index')}}">
                  <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
                </a>
                 <div class="mt-5 auth-header">
                  <h1 class="font-56">Start making money while <br> doing what you love</h1>
                  <p class="mt-4 font-19 font-weight-400">Create a free account and get put yourself out there for parents/students to find you. No payment needed. Trusted by over 4,000 professionals.</p>
                </div>
                <div class="">
                </div>
                  <div class="card-body mt-5">
                     <div class="row">
                     <div class="col-md-5">
                        @foreach ($users->chunk(3) as $group)
                         @foreach ($group as $user)
                          @php
                             $users_infos = App\Models\PersonalInformation::where(['user_id'=>$user->id])->get(); 
                            @endphp
                            @foreach ($users_infos as $users_info)
                              @if ($users_info->profile_photo !== null)
                              <figure class="avatar star-review">
                                <img src="{{ asset($users_info->profile_photo)}}" alt="...">
                             </figure>
                              @endif
                              @endforeach
                           @endforeach
                        @endforeach
                       </div>
                       <div class="col-lg-5">
                        <span class="ml-2 text-warning rating_margin"> <i class="fa fa-star"></i></span>
                        <span class="ml-1 text-warning rating_margin"> <i class="fa fa-star"></i></span>
                        <span class="ml-1 text-warning rating_margin"> <i class="fa fa-star"></i></span>
                        <span class="ml-1 text-warning rating_margin"> <i class="fa fa-star"></i></span>
                        <span class="ml-1 text-warning rating_margin"> <i class="fa fa-star"></i></span>
                        <p class="ml-2">From 200+ reviews</p>
                      </div>
                    </div>
                   </div>
                 </div>
            </div>
          </section>
      </div>
      <div class="col-md-5 bg-white">
         <section class="sectio">
            <div class="container mt-5"> 
              <div class="auth-header text-right">
                   <p class="ml-4">Looking for a teacher? <span><a href="{{ route('parent-sign-up')}}" class="font-14 font-weight-600 mr-5">Sign up here</a></span></p>
               </div>
               <!-- @include('back-layout.error') -->
               <div style="max-width:97%" class="card mt-5">
                 <div class="card-body">
                  <div class="auth-header text-center mt-5">
                    <h4>Sign Up to teach what you love</h4>
                  </div>
                   <form method="POST" action="{{ route('authteachers.store')}}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row sm-gutters mt-5">
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
                       <input id="email" type="email" value="{{old('email')}}" placeholder="Email address" class="form-control" name="email" required>
                     <div class="invalid-feedback">
                      Enter a valid email.
                     </div>
                      @error('email')
                        <div class="text-danger"> {{$message}} </div>
                      @enderror
                   </div>
                   
                   <div class="form-group mt-5">
                       <input id="phone" type="number" value="{{old('phone')}}" placeholder="Phone Number" class="form-control" name="phone" required>
                     <div class="invalid-feedback">
                      Enter phone number.
                     </div>
                    </div>

                   <div class="form-group">
                    <div class="d-block"></div>
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
                  <input type="hidden" value="teacher" name="type">
                   <button type="submit" name="google_btn" class="font-14 font-weight-bold btn-block btn btn-outline-secondary btn-lg socail_button">
                      </i><span class="mr-2"><img src="{{ asset('back/assets/img/icons/g-icon.png')}}" height="20" width="20" alt=""></span> Sign Up with Google
                  </button>
                  <button type="submit" name="facebook_btn" class="font-14 font-weight-bold text-center text-white btn btn-info btn-block btn-lg mt-3">
                      <i class=""></i><span class="fab fa-facebook mr-2"></span> Sign Up with Facebook
                  </button>
                  </form>
                </div>
                 </div>
                </div><hr>
                <div class="mt-2 text-muted text-center mb-4">
                  Already have an account? <a href="{{ route('sign-in')}}" class="text-danger">Sign in</a>
                </div>
              </div>
             </div>
            </section>
          </div>
       </div>
    </div>
   <!-- General JS Scripts -->
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('back/assets/js/custom.js')}}"></script>
  <script src="{{ asset('front/assets/js/form.js')}}"></script>
</body>

@endsection