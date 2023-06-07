@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app" class="signin-decs">
<div class="loader"></div>
  <div class="row">
     <div class="col-md-7">
        <section class="">
           <div class="container mt-5">
              <div class="card-body ml-4">
                <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
                <div class="text-right" style="margin-top:-6%">
                  <!-- <a href="{{ route('teachers-sign-up')}}" class="btn"><i class="fas fa-angle-left"></i> back</a> -->
                </div>
                 <div class="mt-5 auth-header">
                  <h1>What gives more clicks on your Profile on Olukotide?</h1>
                  <p class="">Your first impression matters! Create a profile that will stand out from the crowd on Olukotide.</p>
                </div>
                <div class="row mt-5">
                <div class="col-md-4">
                  <div class="">
                      <i class="fa fa-clock wrap-padding"></i>
                  </div>
                   <p class="icon-size">Take your time when creating your profile to ensure that it is exactly what you want.</p>
                  </div>
                  <div class="col-md-4">
                    <div class="">
                        <i class="fa fa-stamp wrap-padding"></i>
                    </div>
                    <p class="icon-size">Clearly state your professional qualifications to attract more employment. </p>
                  </div>
                  <div class="col-md-4">
                  <div class="">
                      <i class="fa fa-user wrap-padding"></i>
                  </div>
                    <p class="icon-size">Attach a face to the name! Upload a headshot that clearly displays your face. </p>
                  </div>
               </div>
               <div class="text-left mt-5">
                  <!-- <a href="{{ route('teachers-form2')}}" class="btn btn-primary btn-lg " tabindex="4">Continue</a> -->
                  <a href="{{ route('teachers-step-wizard')}}" class="btn btn-primary btn-lg " tabindex="4">Continue</a>
               </div>
            </div>
          </div>
       </section>
    </div>
    <div class="col-md-5 bg-white">
         <section class="section">
            <div class="container mt-5"> 
              <div class="car mt-5">
                <div class="card-body">
                 <div class="ml-5">
                   <img src="{{ asset('back/assets/img/icon-wrap/wrap-2.png')}}" alt="image">
                </div>
                <div class="icon-warp">
                  <img src="{{ asset('back/assets/img/icon-wrap/wrap-1.png')}}" alt="image">
                </div>
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
</body>

@endsection