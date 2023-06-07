@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div class="" id="app">
<div class="loader"></div>
    <section class="section">
      <div class="container mt-5">
        <div class="">
         <a href="{{ route('index')}}" ><img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo"></a> 
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-md-6 col-md-6 col-lg-6  col-xl-6">
            @include('back-layout.error')
             <div class="card mt-4 auth_flex">
              <div class="auth-header text-center mt-5">
                <h4 class="font-32">Join as a Teacher or Parent</h4>
              </div>
              <div class="card-body">
              <form action="{{ route('auths.create')}}">
               @csrf
               <div class="row sm-gutters">
                  <div class="col-md-6" >
                  <div class="card-body text-center">
                    <div class="chocolat-parent">
                      <div class="chocolat-image" title="Just an example">
                        <div id="checkboxes" value="3">
                         <input type="radio" name="chosen_profile" value="3" id="student"/>
                         <label class="whatever" for="student"> 
                           <img id="image_1" src="{{ asset('back/assets/img/icons/icon-1.svg')}}" alt="" class="mt-5">  
                           <img id="image_click_1" src="{{ asset('back/assets/img/icons/icon-1 - Copy.svg')}}" alt="" hidden class="mt-5">
                           <p class="mt-2 font-14 font-weight-600"> I am a Parent / Student </p>
                        </label>
                       </div>
                      </div>
                     </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="card-body text-center">
                     <div class="chocolat-parent">
                      <div class="chocolat-image" title="Just an example">
                      <div id="checkboxes" value="2">
                         <input type="radio" name="chosen_profile" value="2" id="teacher"/>
                         <label class="whatever" for="teacher"> 
                           <img id="image_2" src="{{ asset('back/assets/img/icons/icon-2.svg')}}" alt="" class="mt-5">
                           <img id="image_click_2" src="{{ asset('back/assets/img/icons/icon-2 - Copy.svg')}}" alt="" hidden class="mt-5">
                           <p class="mt-2 font-14 font-weight-600"> I am a Teacher </p>
                        </label>
                        </div>
                      </div>
                      </div>
                    </div>
                   </div>
                  </div>
                  <div class="text-center col-12">
                     <button id="sign-up-btn" type="submit" class="primary btn-block btn-lg ml-2" disabled>Sign up for free </button>
                  </div>
                  <div class="mt-3 mb-5 text-muted text-center">
                      Already have an account? <a href="{{ route('sign-in')}}" class="text-danger">Login</a>
                 </div>
                 </div>
                </form>
               </div>
             </div>
           </div>
        </div>
      </div>
      <div class="text-left ml-5 text-black mt-5">
        <p class="footer_margin"><a target="_blank" >{{date('Y')}} &copy; Olukotide. All rights reserved.</i></a></p>
     </div>
   </section>
</div>
  <!-- General JS Scripts -->
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('back/assets/js/custom.js')}}"></script>
  <script>

     $("body").on("click touchstart","#checkboxes", function(ev){
       let selected = $(this).attr("value");
        if(selected == 2)
        {
           $("#image_2").attr("hidden",true);
           $("#image_click_2").removeAttr("hidden");
           $("#image_click_1").attr("hidden",true);
           $("#image_1").removeAttr("hidden");
           $("#sign-up-btn").removeAttr("disabled");
        }
        else if(selected == 3)
        {
           $("#image_1").attr("hidden",true);
           $("#image_click_1").removeAttr("hidden");
           $("#image_click_2").attr("hidden",true);
           $("#image_2").removeAttr("hidden");
           $("#sign-up-btn").removeAttr("disabled");
        }
       
    });
  </script>
</body>

@endsection