@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="">
          <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
        </div>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="mt-5">
            <a href="{{ route('teachers-wizard-edit')}}" class="">back</a>
            </div>
            <div class="card mt-2">
              <div class="auth-header text-left mt-4 ml-4">
                <h4>Preview Profile</h4>
              </div>
               <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="mt-2">
                  <div class="card-body">
                   <form action="">
                     <div class="row">
                      <div class="col-md-4">
                       <div class="card-body">
                         <img src="{{ asset($personal_infos->profile_photo)}}" height="200" width="250" alt="photo">
                        <div class="text-center mr-4 text-color">
                          <p class="mt-2 font-20">{{$user->first_name." ".$user->last_name}}</p>
                          <p class=" h7">{{$personal_infos->town .", " . $personal_infos->state}}</p>
                          <p class="text_color font-20">
                          ₦{{$hourly_pay->amount}} / hr
                           </p>
                       </div>
                       <div class="mt-1 mb-4">
                        <p class="h5 text_color">Subjects:</p>
                       @foreach (json_decode($subjects->title) as $subject)
                       <span class="">{{$subject}},</span>
                       @endforeach
                       </div>
                       <div class="mt-1">
                        <p class="h5 text_color">Schedule:</p>
                          @foreach ($schedules as $schedule)
                           <p class="">{{$schedule->day}}: <span class=""> <i class="fa fa-clock"></i> {{date('h:i a', strtotime($schedule->from)).' - '.date('h:i a' , strtotime($schedule->to)) }}</span></p>
                          @endforeach
                        </div>
                      </div>
                     </div>
                    <div class="col-md-8"><hr>
                      <div class="card-body">
                        <div class="video_text">
                          <p class="h5 text_color">Onboarding Process</p>
                          <video class="video_size" src="{{ asset($pro_infos->onboading_video)}}" height="260" width="500" controls></video>
                        </div><hr>
                        <div class="mt-4">
                          <p class="h5 text_color">About</p>
                           <p class="">{{$pro_infos->about}}</p>
                        </div><hr>
                        <div class="mt-4">
                          <p class="h5 text_color">Experiences</p>
                           <p class="">{{$pro_infos->experience}}</p>
                        </div><hr>
                        
                        @php $countq = 1;@endphp
                        <div class="">
                        @foreach ($educations as $education)
                         <div class="row">
                           <div class="col-md-5">
                           <p class="h5 text_color">Education {{$countq++}}</p>
                             <img src="{{ asset($education->upload_file)}}" height="67" width="67" alt="logo">
                          </div>
                          <div class="col-md-6 mt-5">
                            <p class="ml-5 h6">{{$education->university}}</p>
                            <p class="ml-5 mt-2 h6">{{$education->degree}}</p>
                            <p class="ml-5 mt-2 h6">{{$education->passing_year}}</p>
                          </div>
                          </div>
                         @endforeach
                         </div><hr>
                          <div class="">
                          @php $countc = 1;@endphp
                          @foreach ($certifications as $certification)
                          <div class="row">
                            <div class="col-md-5"> 
                            <div class="">
                            <p class="h5 text_color">Certifications {{$countc++}}</p>
                              <img src="{{ asset($certification->upload_file)}}" height="67" width="67" alt="image">
                            </div>
                          </div>
                          <div class="col-md-6 mt-5">
                            <p class="ml-5 mt-2 h6">{{$certification->title}}</p>
                            <p class="ml-5 mt-2 h6">{{$certification->description}}</p>
                            <p class="ml-5 mt-2 h6">{{$certification->issued}}</p>
                            <div class="ml-5 mt-2">
                               <a target="_blank" href="{{ asset($certification->upload_file)}}" class="btn btn-outline-secondary link-radius">Show Certificate</a>
                            </div>
                           </div>
                          </div>
                         @endforeach
                         </div><hr>
                       </div>
                      <div class="card-body text-right mr-5 mb-4">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Submit</button>
                      </div>
                     </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
</section>
<div id="completed-form"></div>
<!-- modal start -->
<div style="background-color:black" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal">form submition warning</h5>
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
            <a id="finish-btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg text-white" data-toggle="modal" data-target="#exampleModal">Yes, Submit</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal Ends -->
  <!-- success start -->
  <div id="success-from"></div>
  <!-- success Ends -->
 </div>
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
   <script src="{{ asset('back/assets/js/custom.js')}}"></script>
  <script src="{{ asset('back/assets/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/page/form-wizard.js')}}"></script>
  <script src="{{ asset('front/assets/js/form.js')}}"></script>
  
</body>
@endsection