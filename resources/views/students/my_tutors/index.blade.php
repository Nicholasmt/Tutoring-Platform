@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row">
   <nav aria-label="breadcrumb">
   <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Teachers</h2></li>
      </ol>
   </nav>
  </div>
  <div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="mt-0">
              <div class="card-bod">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <!-- teachers style view tab -->
                      <ul class="nav nav-tabs" id="subTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link_switch switcher active" id="grid-tab" data-toggle="tab" href="#grid" role="tab"
                              aria-controls="grid" aria-selected="true">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="#6D747D" xmlns="http://www.w3.org/2000/svg">
                                  <path class="tab_icon" d="M10 3H3V10H10V3Z"    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M21 3H14V10H21V3Z"   stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M21 14H14V21H21V14Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M10 14H3V21H10V14Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link_switch_2 switcher" id="list-tab" data-toggle="tab" href="#list" role="tab"
                              aria-controls="list" aria-selected="false">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="#6D747D" xmlns="http://www.w3.org/2000/svg">
                                  <path class="tab_icon" d="M8 6H21"    stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M8 12H21"   stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M8 18H21"   stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 6H3.01"  stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 12H3.01" stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 18H3.01" stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                               </svg>
                            </a>
                          </li>
                       </ul>
                      <!-- teachers style view tab -->

                     <li class="nav-item nav_border ml-5 tab_margin tab_nav">
                         <a class="nav-link active" id="teachers-tab" data-toggle="tab" href="#teachers" role="tab"
                         aria-controls="teachers" aria-selected="false"> <label class="nav_image nav_text"> Teachers </label></a>
                      </li>

                     <li class="nav-item nav_border-2 tab_nav">
                       <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab"
                         aria-controls="classes" aria-selected="false"> <label class="nav_image nav_text"> Classes </label></a>
                      </li>
                     <li class="nav-item nav_border-3 tab_nav">
                       <a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab"
                         aria-controls="requests" aria-selected="false"><label class="nav_image nav_text"> Requests </label></a>
                     </li>
                    </ul>
                
                    <div class="float-right mb-4 tab-button">
                       <a href="{{ route('explore')}}" class="primary mobile_button mt-2 ml-5" id="requests-tab">Find a Tutor</a>
                    </div>
                    @include('back-layout.error')
                   <div class="tab-content" id="myTabContent">
                
                   <div class="tab-pane fade show active" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                     <div class="mt-2">
                       @include('students.my_tutors.paginate.teachers')
                     </div>
                    </div> 
                   <!-- tab3 ends -->
                    <!-- tab 4 start --> 
                    <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                    <div class="card-body">
                          <div class="row">
                            <div class="col-sm-5 col-xl-5 col-md-5">
                              <ul class="nav nav-pills flex-column" id="myTab4" role="tablist"> 
                                <div id="current-teacher"></div>  
                                 <div id="close-currentTeacher">
                                   @include('students.my_tutors.paginate.classes')
                                 </div>  
                               </ul>
                            </div>
                            @if ($teachers->count() == 0)
                            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                              <div class="mt-5 text-center">
                                <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
                              </div>
                              <div class="mt-3">
                                <div class="text-center">
                                  <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
                                </div>
                                </div>
                            </div>
                            @else
                            <div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
                              <div class="tab-content no-padding card-body card" id="myTab2Content">
                                <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                   <!-- load teacher -->
                                   <div id="load-content"></div>
                                   <div id="current_teachers">
                                 
                                    @foreach ($teachers as $details)
                                    @php
                                      $duration = Carbon\Carbon::parse($details->hire_to)->diffInDays($details->hire_from);
                                      $users_info = App\Models\PersonalInformation::where('user_id',$details->teacher_booked)->with('user')->first();
                                      $hourly_pay = App\Models\HourlyPay::where('user_id',$details->teacher_booked)->with('user')->first();
                                      $pro_info = App\Models\ProfessionalInformation::where('user_id',$details->teacher_booked)->with('user')->first();
                                      $educations = App\Models\Education::where('user_id',$details->teacher_booked)->with('user')->get();
                                      $rated = App\Models\RatedClass::where(['booking_id'=>$details->id])->first();
                                      $rating = App\Models\Rating::where(['user_id'=>$details->teacher_booked])->first();
                                      @endphp
                                          @if($details->completed == 1)
                                              <p class="text-success text-right"><i class="fa fa-circle font-8"></i> Completed</p> 
                                          @elseif($details->date == today())
                                              <p class="text-warning text-right"><i class="fa fa-circle font-8"></i> In Progress</p>
                                          @elseif ($details->date <= today())
                                              <p class="text-danger text-right"><i class="fa fa-circle font-8"></i> Passed / Missed</p>
                                          @elseif ($details->date >= today())
                                              <p class="text-info text-right"><i class="fa fa-circle font-8"></i> Upcoming</p>
                                          @endif
                                          <div class="text-center mt-3">
                                          <img src="{{ asset($users_info->profile_photo)}}" class="mb-2" height="158" width="200" alt=""><br>
                                          <span class="h3 text_color">{{$details->teacher->first_name." ".$details->teacher->last_name}}</span>
                                          <p class="text_color">{{$details->teacher->email}}. ₦{{$hourly_pay->amount}} / hr. <span><i class="fa fa-star text-warning"></i>  {{$rating->average}}.0</span></p>
                                          </div>
                                          <div class="text-center">
                                            <div class="card-body">
                                          <p>
                                              <a class="btn text-left col-5" data-toggle="collapse" href="#about" role="button"
                                              aria-expanded="false" aria-controls="about">
                                                  About  
                                              </a>
                                              <a class="btn text-right col-5" data-toggle="collapse" href="#about" role="button"
                                              aria-expanded="false" aria-controls="about">
                                              <span class="text-right"> <i class=" fa fa-chevron-down"></i></span>
                                              </a><hr>
                                          </p>
                                          <div class="collapse" id="about">
                                              <p>
                                                  {{$pro_info->about}}
                                              </p>
                                          </div>
                                              <p>
                                              <a class="btn text-left col-md-5" data-toggle="collapse" href="#education" role="button"
                                              aria-expanded="false" aria-controls="education">
                                              Education  
                                              </a>
                                              <a class="btn text-right col-md-5" data-toggle="collapse" href="#education" role="button"
                                              aria-expanded="false" aria-controls="education">
                                              <span class="text-right"> <i class=" fa fa-chevron-down"></i></span>
                                              </a><hr>
                                              </p>
                                          <div class="collapse" id="education">
                                              @foreach ($educations as $education)
                                              <div class="row">
                                                  <div class="col-md-4 text-center">
                                                  <img src="{{ asset($education->upload_file)}}" class="" height="40" width="40" alt="image">
                                                  </div>
                                                  <div class="col-md-8">
                                                  <p class="">{{$education->university.". ".$education->degree.". ". $education->passing_year}}</p>
                                                  </div>
                                              </div>
                                              @endforeach
                                          </div>
                                          </div>
                                          <div class="row text-left">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label for="">Level</label>
                                              <input type="text" class="form-control" value="{{$details->level}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-success">Amount Paid <i class="fa fa-check"></i></label>
                                                <input type="text" class="form-control" value="₦{{$details->amount_paid}}" readonly>
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                              <div class="form-group">
                                              <label for="">Subject</label>
                                              <input type="text" class="form-control" value="{{$details->subject}}" readonly>
                                              </div>
                                              <div class="form-group">
                                                <label for="">Date</label>
                                                <input type="text" class="form-control" value="{{$details->date->format('d')}}  {{date('F', strtotime($details->date))}} {{$details->date->format('Y')}}" readonly>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group col-md-12">
                                               <div class="col-md-">
                                                <label class="text-left font-17">Scheduled Time / Date</label><br>
                                                <!-- array -->
                                                 @if(is_array(json_decode($details->booked_times)))
                                                    @foreach (json_decode($details->booked_times) as $times)
                                                        <?php
                                                           $date_time = date(date('Y:m:d',strtotime($details->date)).' h:i a',strtotime($times));
                                                           $meeting = App\Models\ZoomMeeting::where(['booking_id'=>$details->id])->where('start_time', '=', $date_time)->with('booking')->first();
                                                        ?>
                                                        @if ($meeting)
                                                          <p class="text-left">{{date('h:i A', strtotime($times))}}  <i class="text-success fa fa-check"> </i></p>
                                                        @else
                                                          <p class="text-left">{{date('h:i A', strtotime($times))}}  <i class="text-danger fa fa-times"> </i></p>
                                                        @endif
                                                    @endforeach
                                                  @endif
                                                   <!-- single -->
                                                   @if(!is_array(json_decode($details->booked_times)))
                                                      <?php
                                                        $date_time = date(date('Y:m:d',strtotime($details->date)).' h:i a',strtotime($details->booked_times));
                                                        $meeting = App\Models\ZoomMeeting::where(['booking_id'=>$details->id])->where('start_time', '=', $date_time)->with('booking')->first();
                                                       ?>
                                                       @if ($meeting)
                                                        <p class="text-left">{{date('h:i A', strtotime($details->booked_times))}} <i class="text-success fa fa-check"> </i></p>
                                                      @else
                                                        <p class="text-left">{{date('h:i A', strtotime($details->booked_times))}} <i class="text-danger fa fa-times"> </i></p>
                                                      @endif
                                                 @endif
                                                      <p class="text-left">{{$details->date->format('d')}}  {{date('F', strtotime($details->date))}} {{$details->date->format('Y') }}</p>
                                              </div>
                                           </div>

                                          <div class="row mt-5">
                                          <!-- array -->
                                            @if(is_array(json_decode($details->booked_times)))
                                                  @foreach(json_decode($details->booked_times) as $time)
                                                    <?php
                                                        $date = date(date('Y:m:d',strtotime($details->date)).' h:i a',strtotime($time));
                                                        $class_attended = App\Models\ZoomMeeting::where('start_time', '=', $date)->with('booking')->first();
                                                    ?>

                                                       @if(!empty($class_attended))
                                                          @php
                                                            $complained = App\Models\Complain::where(['meeting_id'=>$class_attended->id])->with('meeting')->first();
                                                          @endphp
                                                            @if(!empty($complained))
                                                                @if($details->completed == 2)
                                                                  <p class="font-17 card-body text-danger">You logged  a complain and is under review  <i class=" text-warning fa fa-spinner"></i></p>
                                                                @elseif($details->completed == 3)
                                                                  <p class="col-md-6 font-16 text-info">You have been refunded!, Sorry for the inconveniences</i></p>
                                                                @endif
                                                            @else
                                                            <div class="col-6">
                                                              <button value="{{$class_attended->id}}" id="compliants_btn" class="btn btn-default" 
                                                                        data-toggle="modal" data-target="#complaintModal">
                                                                      Make Complain for {{date('h:i A', strtotime($time))}} class
                                                              </button>
                                                            </div>
                                                            @endif

                                                        @if($rated)
                                                          <div class="col-6">
                                                              <span class="text-right text_color">class Rated!</span>
                                                          </div>
                                                        @elseif($class_attended->attended == 1)
                                                            <div class="col-md-6">
                                                                <button href="javascript:void(0)" id="rating_btn" 
                                                                  value="{{$details->id}}" class="btn btn-primary"  
                                                                  data-toggle="modal" data-target="#ratingModal"  
                                                                  >Rate Teacher</button>
                                                              </div>
                                                          @endif
                                                      @endif

                                                  @endforeach
                                                @endif

                                                <!-- single -->
                                                @if(!is_array(json_decode($details->booked_times)))
                                                    <?php
                                                        $date = date(date('Y:m:d',strtotime($details->date)).' h:i a',strtotime($details->booked_times));
                                                        $class_attended = App\Models\ZoomMeeting::where('start_time', '=', $date)->with('booking')->first();
                                                    ?>
 
                                                      @if(!empty($class_attended))
                                                          @php
                                                            $complained = App\Models\Complain::where(['meeting_id'=>$class_attended->id])->with('meeting')->first();
                                                          @endphp
                                                            @if(!empty($complained))
                                                                  @if($details->completed == 2)
                                                                    <p class="font-17 card-body text-danger">You logged  a complain and is under review  <i class=" text-warning fa fa-spinner"></i></p>
                                                                  @elseif($details->completed == 3)
                                                                    <p class="col-md-6 font-16 text-info">You have been refunded!, Sorry for the inconveniences</i></p>
                                                                  @endif
                                                            @else
                                                              <div class="col-6">
                                                                <button value="{{$class_attended->id}}" id="compliants_btn" class="btn btn-default" 
                                                                        data-toggle="modal" data-target="#complaintModal">
                                                                        Make Complain for {{date('h:i A', strtotime($details->booked_times))}} class
                                                                </button>
                                                              </div>
                                                            @endif
                                                        @if($rated)
                                                          <div class="col-6">
                                                              <span class="text-right text_color">class Rated!</span>
                                                          </div>
                                                        @elseif($class_attended->attended == 1)
                                                            <div class="col-md-6">
                                                                <button href="javascript:void(0)" id="rating_btn" 
                                                                  value="{{$details->id}}" class="btn btn-primary"  
                                                                  data-toggle="modal" data-target="#ratingModal"  
                                                                  >Rate Teacher</button>
                                                              </div>
                                                          @endif
                                                      @endif
                                               @endif
                                         </div>
                                       </div>
                                       @break
                                      @endforeach
                                         
                                    </div>
                                  </div>
                               </div>
                             </div>
                             @endif
                          </div>
                      </div>
                    </div>
                    <!-- tab 4 ends -->
                  <!-- tab 5 start -->
                  <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
                     <div id="requests-data"></div>
                     <div id="request-hide">
                         <div class="mt-2">
                          
                         </div>
                        @include('students.my_tutors.paginate.requests')
                    </div>
                 </div> 
                 <!-- tab5 ends -->
              </div>
           </div>
        </div>
      </div>
    </div>
   </div>
  </div>
</section>

<div id="rating-modal"></div> 
<div id="success_rating"></div>

<div id="decline-modal"></div>
<div id="pay-modal"></div>
<div id="complain-modal"></div>


@endsection
@section('scripts')
<script src="{{ asset('front/assets/js/loader.js')}}"></script> 
<script src="{{ asset('front/assets/js/paginator.js')}}"></script> 
@endsection
