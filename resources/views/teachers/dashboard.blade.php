@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row mt-2">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="mt-5 text-capitalize">Welcome {{Session::get('first_name')}}</h2></li>
      </ol>
   </nav>
  </div>
  @include('back-layout.error')
  @if ($user->verify_ready == 0)
  <div style="border-left: 4px solid red" class="alert alert-light alert-dismissible show fade mb-2">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
        Kindly Complete setting up your profile as you might not be able to perform some actions here
        <a href="{{ route('teachers-step-wizard')}}" class="">Complete profile <i class="fa fa-angle-double-right"></i></a>
    </div>
  </div>
  @elseif ($user->verify_ready == 1)
  <div class="alert alert-info alert-dismissible show fade mb-">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
      <i class="fa fa-exclamation-circle"></i>
      Your account is still under review. You will not be able to take any course yet
    </div>
  </div>
  @elseif ($user->is_verified == 2)
  <div style="border-left: 4px solid red" class="alert alert-light alert-dismissible show fade mb-2">
    <div class="alert-body  ">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
       <p class="badge badge-danger">Rejected! </p> Some informations in your profile has been declined click
        <a href="{{ route('teachersprofile-resubmits.index')}}" class=""> HERE <i class="fa fa-angle-double-right"></i></a>
         to update and resubmit to be verifed thank you. 
      </div>
    </div>
      @endif
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-center">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <a href="{{ route('teacherswallets.index')}}" class="wallet-link">
                      <div class="card-content">
                        <h6 class="font-14 ml-3 subtab-text"> My Wallet</h6>
                         @if($my_wallet->balance == null)
                          <h2 class="mt-4 font-25 mb-4 ml-3" id="hide_balance">₦0.0</h2>
                          <h2 class="mt-4 font-25 mb-4 ml-3" id="show_balance">xxxx xx</h2>
                        @else
                          <h2 class="mt-4 font-23 mb-4 ml-3" id="hide_balance">₦{{number_format($my_wallet->balance)}}</h2>
                          <h2 class="mt-4 font-25 mb-4 ml-3" id="show_balance">xxxx xx</h2>
                        @endif
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="float-right mr-3 mt-2">
                        <!-- <a data-toggle="modal" data-target="#walletModal"> -->
                           <img id="show_wallet" class="" src="{{ asset('back/assets/img/icons/icon7.png')}}" alt="img">
                           <i id="hide_wallet" class="text_gray fa fa-eye-slash font-15"></i>
                        <!-- </a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           </div>
        
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <a href="{{ route('teacherswallets.index')}}" class="wallet-link">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-center">
                  <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pl-0 pt-3">
                      <div  class="card-content">
                        <!-- <h6 class="font-14 ml-4 subtab-text">This month’s revenue</h6> -->
                        <h6 class="font-14 ml-4 subtab-text">Pending requests</h6>
                         <!-- <h2 class="mt-3 font-23 mb-4 ml-4">₦0.00</h2> -->
                         <h2 class="mt-3 font-29 mb-4 ml-4">{{$booking_requests->count()}}</h2>
                       </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pl-0">
                       <div class="float-right mr-3 mt-3 text-info">
                        <!-- <i class="fa fa-spinner"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>

          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pr-2 pt-3">
                      <div class="card-content">
                        <h6 class="font-14 ml-3 subtab-text">No. of students</h6>
                        <h2 class="mt-3 font-30 mb-2 ml-3">{{$total_student->count()}}</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img ml-5 mt-3">
                          
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pr-0 pt-3">
                      <div class="card-content">
                        <h6 class="font-14 ml-3 subtab-text">Average Rating</h6>
                        @if($my_rating->average == null)
                          <h2 class="mt-3 font-30 mb-2 ml-3"><i class="fa fa-star text-warning font-25"></i> 0</h2> 
                        @else
                          <h2 class="mt-3 font-30 mb-2 ml-3"><i class="fa fa-star text-warning font-24"></i> {{$my_rating->average}}.0</h2> 
                        @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="banner-img ml-5 mt-3">
                      </div>
                    </div>
                  </div>
                 </div>
               </div>
             </div>
            </div>
          </div>
             
         <!-- today's class starts -->
         <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card_margin card-body">
            <div class="mt-2">
                <p class="font-16 subtab-text-2 font-weight-600 ml-3 float-left">Today's Classes</p>
               <a href="{{ route('teachers-dashboard')}}" class="btn btn-light float-right">Refresh page</a><br>
             </div>
             <div class="row mt-3 mb-5">
               <div class="table-responsive">
                 @php
                      $count = 1;
                  @endphp
                  @if ($on_going_classes->count() == 0)
                  <div class="mt-3 mb-5 text-center">
                      <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
                  </div>
                  <div class="mt-0 mb-4">
                      <div class="text-center">
                        <p class="">You have no class today.</p>
                      </div>
                  </div>
                   @else
                   <div class="text-left mt-3">
                       <p class="font-18 text_color">Teachers are ment to start classes "10 minutes" earlier, To test microphone and get ready!</p>
                   </div>
                   <table class="table mt-4">
                   <tbody class="text-capitalize">
                    @foreach($on_going_classes as $class)
                    <?php
                     $due_date = strtotime($class->date);
                     $user_info = App\Models\PersonalInformation::where('user_id',$class->booked_by)->with('user')->first();
                    ?>
                     <!-- single bookings -->
                     @if (!is_array(json_decode($class->booked_times)))
                      <tr class="">
                           <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-1" height="38" width="38" alt="">
                            <span class="ml-1">{{$class->who_booked->first_name .' '. $class->who_booked->last_name}}</span>
                           </td>
                          <td>{{$class->subject}}</td>
                          <td>{{date('h:i A', strtotime($class->booked_times))}}</td>
                          <td>{{$class->date->format('d')}}  {{date('F', strtotime($class->date))}} {{$class->date->format('Y')}}</td>
                          <td>
                            @php
                                $now = strtotime(date('H.i'));
                                $start_time = strtotime($class->booked_times);
                                $end_time = strtotime($class->booked_times) + 60*60;
                                $date_time = date("Y-m-d H:i:s", strtotime($class->booked_times));
                                $zoom_meeting = App\Models\ZoomMeeting::where('start_time', '=', $date_time)->with('booking')->first();

                             @endphp
                               
                               @if($now < $start_time)

                                   <span class="badge badge-info">Not yet Time</span>

                                   @if($now >= $start_time - 10 *60) 
                                      <a href="{{ route('teachers-create-class',[$class->id,$class->booked_times])}}" class="primary ml-3" target="_blank">Start Class</a>
                                   @endif

                               @elseif($now >= $start_time && $now <= $end_time)
                                
                                  @if(empty($zoom_meeting))
                                     <a href="{{ route('teachers-create-class',[$class->id,$class->booked_times])}}" class="primary ml-3" target="_blank">Start Class</a>
                                   @else
                                      <span class="">Password: <span class="font-20 font-weight-600">{{$zoom_meeting->password}}</span> </span>
                                      <a href="{{$zoom_meeting->start_url}}" class="btn btn-primary ml-3" target="_blank">Start Class</a>
                                   @endif
                              
                                  @elseif ($now >= $end_time)
                                    @if(empty($zoom_meeting))
                                       <span class="badge badge-danger">You Missed the Class!</span>
                                       {{-- {{date('H:i',$start_time).''. date('H:i',$end_time)}} --}}
                                       {{-- <a href="{{ route('teachers-create-class',[$class->id,$class->booked_times])}}" class="primary ml-3" target="_blank">Start Class</a> --}}

                                      @else
                                          <?php
                                              $booking = App\Models\Booking::where('id',$zoom_meeting->booking_id)->with('teacher','who_booked')->first();
                                               // check if class is compleed
                                              $meeting_counter = App\Models\ZoomMeeting::where('booking_id',$booking->id)->with('booking')->get();
                                              $meet_count = $meeting_counter->count();
                                              $time_counter = 1;
                                              if($meet_count == $time_counter)
                                              {
                                                App\Models\Booking::where('id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                                App\Models\MyClass::where('booking_id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                              }
                                            ?>
                                         <span class="badge badge-success">Class Ended</span>
                                   @endif
                                @endif
                           </td>
                      </tr>
                     @endif

                     <!-- array bookings -->
                     @if(is_array(json_decode($class->booked_times)))
                      @foreach(json_decode($class->booked_times) as $time)
                        <tr class="">
                          <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-5" height="38" width="38" alt="">
                            <span class="ml-5">{{$class->who_booked->first_name .' '. $class->who_booked->last_name}}</span>
                          </td>
                            <td>{{$class->subject}}</td>
                            <td>{{date('h:i A', strtotime($time))}}</td>
                            <td>{{$class->date->format('d')}}  {{date('F', strtotime($class->date))}} {{$class->date->format('Y')}}</td>
                            <td>
                            @php
                                $now = strtotime(date('H.i'));
                                $start_time = strtotime($time);
                                $end_time = strtotime($time) + 60*60; 
                                $date_time = date("Y-m-d H:i:s", strtotime($time));
                                $zoom_meeting = App\Models\ZoomMeeting::where('start_time', '=', $date_time)->with('booking')->first();
                             @endphp
                            @if($now < $start_time)

                                @if($now >= $start_time - 10 *60) 
                                   <a href="{{ route('teachers-create-class',[$class->id,$class->booked_times])}}" class="btn btn-primary ml-3" target="_blank">Start Class</a>
                                @else
                                   <span class="badge badge-info">Not yet Time</span>
                                @endif

                             @elseif($now >= $start_time && $now <= $end_time)
                                  @if(empty($zoom_meeting))
                                    <a href="{{ route('teachers-create-class',[$class->id,$time])}}" class="btn btn-primary ml-3" target="_blank">Start Class</a>
                                   @else
                                      <span class="">Password: <span class="font-20 font-weight-600">{{$zoom_meeting->password}}</span> </span>
                                      <a href="{{$zoom_meeting->start_url}}" class="primary ml-3" target="_blank">Start Class</a>
                                   @endif
                               
                              @elseif ($now >= $end_time)
                                   @if(empty($zoom_meeting))
                                       <span class="badge badge-danger">You Missed the Class!</span>
                                        <a href="{{ route('teachers-create-class',[$class->id,$time])}}" class="btn btn-primary ml-3" target="_blank">Start Class</a>
                                      @else
                                          <?php
                                              $booking = App\Models\Booking::where('id',$zoom_meeting->booking_id)->with('teacher','who_booked')->first();
                                               // check if class is compleed
                                              $meeting_counter = App\Models\ZoomMeeting::where('booking_id',$booking->id)->with('booking')->get();
                                              $meet_count = $meeting_counter->count();
                                              $time_counter = count(json_decode($booking->booked_times));
                                               if($meet_count == $time_counter)
                                              {
                                                App\Models\Booking::where('id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                                App\Models\MyClass::where('booking_id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                              }
                                            ?>
                                         <span class="badge badge-success">Class Ended</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                       @endif
                       @endforeach
                    </tbody>
                  </table>
                 @endif
              </div>
           </div>
         </div>
       </div>
         <!-- todays class end -->
         
     <!-- profile count  -->
     <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card-header mt-2">
            <h4 class="font-16 font-weight-600 subtab-text-2">Profile views</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart2" height="23vw" width="80vw"></canvas>
          </div>
       </div>
     <!-- profile count ends -->

      <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
        <div class="row">
        <!-- Completed classes -->
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

            <!-- today's class events starts -->
          <div class="card_margin card-body card">
            <div class="mt-">
              <p class="font-16 subtab-text-2 font-weight-600 ml-3">Today's Class Events</p>
             </div>
             <div class="row mt-3 mb-5">
               <div class="table-responsive">
                   @php
                      $count = 1;
                    @endphp
                  @if ($completed_classes->count() == 0)
                  <div class="mt-3 mb-5 text-center">
                      <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
                  </div>
                  <div class="mt-0 mb-4">
                      <div class="text-center">
                        <p class="">You didn't have any class events today.</p>
                      </div>
                  </div>
                   @else
                   <table class="table card-body">
                   <tbody class="text-capitalize">
                    @foreach($completed_classes as $attend)
                    <?php
                     $user_info = App\Models\PersonalInformation::where('user_id',$attend->booking->booked_by)->with('user')->first();
                    ?>
                    <tr class="card-body">
                           <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-3" height="38" width="38" alt="">
                            <span class="ml-3">{{$attend->booking->who_booked->first_name}}</span>
                          </td>
                          <td>{{$attend->booking->subject}}</td>
                          <td>{{date('h:i A', strtotime($attend->date_time))}}</td>
                          <td>{{$attend->created_at->diffForHumans()}}</td>
                          <td>
                            @php
                              $now = strtotime(date('H.i'));
                              $class_start = strtotime(date('H:i',strtotime($attend->date_time)));
                              $class_end = strtotime($attend->date_time) + 60*60; 
                            @endphp
                            @if($attend->attended == 0)
                              @if($now >= $class_start && $now <= $class_end)
                                  <span class="badge badge-info">On Going!</span>
                              @elseif($now >= $class_end)
                                  <span class="badge badge-danger">Missed</span>
                              @endif
                               
                              @elseif($attend->attended == 1)
                                @if($now >= $class_start && $now <= $class_end)
                                   <span class="badge badge-info">On Going!</span>
                                @elseif($now >= $class_end)
                                   <span class="badge badge-success">Attended <i class="fa fa-check"></i></span>
                                @endif

                            @endif
                        </td>
                    </tr>
                    @endforeach
                   </tbody>
                  </table>
                 @endif
              </div>
           </div>
         </div>

        <!-- today's Attended classes ends -->
       </div>
        
        <!-- recent activites -->
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card mb-5">
              <div class="mt-3">
              <p class="h6 ml-3 mb-3 font-16 subtab-text-2 font-weight-600 text-capitalize">Recent Activities</p>
            </div>
            @if ($recent_activities->count()== 0 && $refunds->count() == 0 && $accepted_bookings->count() == 0)
             <div class="mt-5 mb-5 text-center">
                <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
             </div>
             <div class="text-center">
              <p class="mb-5">You have no recent activities</p>
             </div>
           @else
          <div class="card-body">
            <div class="row">
            @foreach ($recent_activities as $activity)
            @if($activity->type == 'bookings')
             @php
               $details = App\Models\Booking::where('id',$activity->type_id)->with('who_booked','teacher')->first();
             @endphp
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <img src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                  </div>
                  <div class="col-md-10">
                      <span class="font-14">You just been booked by </span>
                      <span class="font-14">{{ substr($details->who_booked->first_name ." ". $details->who_booked->last_name,0,20)}}</span><br>
                      <span class="font-12">{{$activity->created_at->diffForHumans()}}</span>
                  </div>
                </div>
              
              </div>
            @endif
            @if($activity->type == 'withdrawal')
             @php
              $details = App\Models\Transaction::where('id',$activity->type_id)->first();
              @endphp
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                    </div>
                    <div class="col-md-6">
                      <span class="font-14">You just made a withdrawl of {{$details->amount}} </span>
                      <span class="font-12">From your Wallet</span> <br>
                      <span class="font-12">{{$activity->created_at->diffForHumans()}}</span>
                    </div>
                  </div>
               </div>
              @endif
              @endforeach

                 {{-- refund activity log --}}
                  @foreach ($refunds as $refund)
                  <div class="col-md-12 mt-2">
                    <div class="row">
                      <div class="col-md-2">
                        <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                      </div>
                      <div class="col-md-10">
                          <span class="float-right font-14 ml-3">Debit, for a class complain logged against you </span><br>
                          <span class="font-12">₦{{number_format($refund->amount)}} was deducted from your balance based on review.</span>
                          <span class="font-12">{{$refund->created_at->diffForHumans()}}</span><br>
                      </div>
                    </div>
                 </div> 
                @endforeach

                  {{-- accepted booking activity log --}}
                  @foreach ($accepted_bookings as $accepted)
                  <div class="col-md-12 mt-2">
                    <div class="row">
                      <div class="col-md-2">
                        <img src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                      </div>
                      <div class="col-md-10">
                         <span class="float-righ font-14">You just accepted a booking from </span>
                         <span class="font-16"> {{$accepted->booking->who_booked->first_name.' '.$accepted->booking->who_booked->last_name}}.</span> <br>
                         <span class="font-12">{{$accepted->created_at->diffForHumans()}}</span>
                      </div>
                    </div>
                   </div>
                @endforeach
               
              @endif
             </div>
            </div>
           </div>
         </div>
      </div>
     <!-- </div> -->

  </section>

 <!-- start zoom class modal -->
  <div id="zoom_class"></div>
<!-- start zoom class modal ends-->

    
  <!-- reminder modal starts -->
<div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal">Complete your Profile!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="text-center">
              <p class="mt-3 mb-3 text-left font-17"> Kindly Complete setting up your profile as you might not be able to perform some actions here, </p>
                   <a  href="{{ route('teachers-step-wizard')}}" class="btn btn-primary"> Complete profile <i class="fa fa-angle-double-right"></i></a>
               </span>
            </div>
            <div class="mb-5 mt-4 text-right">
                 <!-- <button type="button" class="btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button> -->
             </div>
        </div>
      </div>
    </div>
  </div>
  <!-- reminder modal ends -->

  
   
@endsection
@section('scripts')
<script>
  var y_data = JSON.parse('{!! json_encode($labels) !!}');
  var x_data = JSON.parse('{!! json_encode($data) !!}');
</script>
<script src="{{ asset('back/assets/bundles/chartjs/chart.min.js')}}"></script>
<script src="{{ asset('back/assets/js/page/chart-chartjs.js')}}"></script>
 
 
<!-- <script>
    $("#meetingModal").modal('show');
    $('.modal-backdrop').hide();
 </script> -->
 

@if ($user->verify_ready == 0)
<script>
    $("#reminderModal").modal('show');
  </script>
@endif

  <script src="{{ asset('front/assets/js/wallet-actions.js')}}"></script> 
  <script src="{{ asset('front/assets/js/booking.js')}}"></script>

  @endsection 