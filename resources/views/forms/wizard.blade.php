@section('head')

<link rel="stylesheet" href="{{ asset('back/assets/bundles/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<link href="{{ asset('front/assets/css/multiform.css')}}" rel="stylesheet" id="bootstrap">
<script defer src="{{ asset('back/assets/js/alpine.js')}}"></script>
 
<!-- <link rel="stylesheet"href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css"> -->
 
@livewireStyles
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
  <div class="loader"></div>
    <section class="section">
      <div class="container mt-5">
        <div class=" ">
          <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
          <span class="float-right mt-4 font-14 font-weight-400 contact_wizard">Having issues? Contact <a href="#" class="button_btn font-14 font-weight-600"> hello@olukotide.com</a></span> 
         </div>
         <!-- <div class="row">
          <div class="col-12 col-md-12"> -->
               
             <livewire:wizard/>

         <!-- </div>
	     </div> -->
	   </div>
    </section>
   </div>

  <!-- modal start -->
<div class="modal fade modal_bg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
            <h4 class="text_color">Are you sure these Information are true?</h4>
            <p class="mt-3 text_color">If informations provided here are found to be false, Olukotide has the right to discard your application.</p>
            </div>
            <div class="mb-5 mt-4 text-center">
              <button type="button" class="  btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
              <!-- <a href="javascript:void(0)" id="finish-btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg" data-toggle="modal" data-target="#completeModal">Yes, Submit</a> -->
              <a href="{{ route('teachersform-completed')}}"  class="primary btn-lg ml-5 m-t-15">Yes, Submit</a>
             </div>
        </div>
      </div>
      
    </div>
  </div>
  <!-- modal Ends -->

  <!-- success start -->
 <div class="modal fade modal_bg" id="formCompleteModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="myLargeModalLabel"></h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
           <div class="card-body">
           <div class="row">
              <div class="col-md-6">
                <img src="{{ asset('back/assets/img/icons/img5.png')}}" height="300" width="300" alt="image">
              </div>
              <div class="col-md-6">
                <div class="text-center">
                  <h4 class="text_color badge badge-success font-25">Success!!!</h4> <span class="font-20 text_color ml-2">You made it</span>
                   <p class="text_color font-16 mt-3">Your application has been submitted and is under review. It would take about 3-4 working days for your profile to be reviewed.</p>
                </div>
                <div class="mt-4 text-center">
                     <a href="{{ route('redirect')}}" class="btn btn-icon dashboard_btn">Go to Dashboard <i class="fa fa-arrow-right"></i></a>
                </div>
                <!-- <div class="text-center">
                  <h4 class="text_color">What Next?</h4>
                  <div class="row mt-3">
                     <div class="col-md-4">
                       <i class="fa fa-user form-iconpadding2"></i>
                     </div>
                      <div class="col-md-4">
                        <i class="fa fa-users form-iconpadding"></i>
                     </div>
                     <div class="col-md-4">
                       <i class="fa fa-calendar form-iconpadding"></i>
                     </div>
                  </div>
                  <hr class="works_line">
                  </div> -->
               </div>
             </div>
           </div>
          </div>
        </div>
      </div>
     </div>
   
    <!-- success Ends -->
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
    @livewireScripts

  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <script src="{{ asset('back/assets/js/custom.js')}}"></script> 
  <script src="{{ asset('front/assets/js/loader.js')}}"></script>

 <!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

 @if ($user->verify_ready == 1)
  <script>
    $("#formCompleteModal").modal('show')
  </script>
    <style>
    .modal-backdrop.show{
        opacity: 0.8;
    }
  </style>
  @endif

  <script>
    $(document).ready(function(){
        window.livewire.on('alert_remove',()=>{
          setTimeout(function(){ $(".alert-success").fadeOut('fast');
          }, 3000);
        });
    });
  </script>
  <script>
    $(document).ready(function(){
        window.livewire.on('alert_remove',()=>{
          setTimeout(function(){ $(".alert-danger").fadeOut('fast');
          }, 4000);
        });
    });
  </script>

@stack('scripts')
  
</body>
@endsection