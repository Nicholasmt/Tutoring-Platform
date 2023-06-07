@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row">
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="mt-5 ml-3 text-capitalize">Welcome {{Session::get('first_name')}}</h2></li>
      </ol>
   </nav>
  </div>

    @if ($personal_infos->phone == null)
        <div style="border-left: 4px solid red" class="alert alert-light alert-dismissible show fade mb-2">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
               </button>
                 Kindly Complete setting up your profile as you might not be able to perform some actions here <br>
               <a href="{{ route('parentssettings.create')}}" class="btn">Complete profile <i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    @endif
 
    <div class="row mb-2">
     <div class="col-md-4">
      <div class="col-xl-12">
       <a href="btn">
       <div class="card">
           <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
               <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-1 pt-3">
                  <a href="{{ route('parentswallets.index')}}" class="wallet-link">
                  <div class="card-content">
                     <h5 class="font-14 ml-3 subtab-text">My Wallet</h5>
                    @if ($my_wallet->balance == null)
                     <h2 class="mt-4 font-30 mb-4 ml-3" id="show_balance">₦0.00</h3>
                     <h2 class="mt-4 font-30 mb-4 ml-3" id="hide_balance">xxxx xx</h3>
                    @else
                    <h2 class="mt-4 font-25 mb-4 ml-3" id="hide_balance">₦{{number_format($my_wallet->balance)}}</h2>
                    <h2 class="mt-4 font-30 mb-4 ml-3" id="show_balance">xxxx xx</h3>
                    @endif
                    </div>
                  </a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-im ml-5 mt-3">
                       <img class="ml-5" id="show_wallet" src="{{ asset('back/assets/img/icons/icon7.png')}}" alt="img">
                       <i id="hide_wallet" class="text_gray fa fa-eye-slash ml-5 font-15"></i>
                   </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
    
   <div class="col-md-4">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
               <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-14 ml-3 subtab-text">On-going Classes</h5>
                     <h2 class="mt-4 font-30 mb-4 ml-3">{{$on_going_classes->count()}}</h2>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>

   <div class="col-md-4">
      <div class="">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
               <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-14 ml-3 subtab-text">Recently Booked teachers</h5>
                     <h2 class="mt-4 font-30 mb-4 ml-3">{{$recent_booked->count()}}</h2>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
  </div>
  
 
  <div class="row">
   <div class="col-md-8">
     <div class="col-xl-12">
       @include('back-layout.error')
       <!-- todays class start -->
       <div class="card_margin card-body card">
            <div class="mt-3">
              <p class="font-16 subtab-text-2 font-weight-600 ml-3 float-left">Today's Classes</p>
              <a href="{{ route('parents-dashboard')}}" class="btn btn-light float-right">Refresh page</a>
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
                   <table class="table card-body">
                   <tbody class="text-capitalize">
                    @foreach($on_going_classes as $class)
                    <?php
                     $user_info = App\Models\PersonalInformation::where('user_id',$class->teacher_booked)->with('user')->first();
                    
                    ?>
                    <!-- single booking -->
                    @if (!is_array(json_decode($class->booked_times)))
                     <tr class="card-body">
                           <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-3" height="38" width="38" alt="">
                            <span class="ml-3">{{$class->teacher->first_name}}</span>
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
                                  
                              @elseif($now >= $start_time && $now <= $end_time)

                                   @if(empty($zoom_meeting))
                                    <span class="badge badge-info">Waiting For Teacher</span>
                                    @else
                                      @if(!empty($zoom_meeting->password))
                                        <span class="">Password: <span class="font-20 font-weight-600" id="copytext">{{$zoom_meeting->password}}</span>
                                        <button  onclick="copyContent()" class="btn btn-dark btn-sm">Copy</button>
                                       </span><br>
                                        <a href="{{ route('parents-join-class',$zoom_meeting->id)}}" class="btn btn-primary" target="_blank">Join Class</a>
                                      @endif
                                    @endif
 
                                @elseif ($now >= $end_time)

                                  @if(empty($zoom_meeting))
                                      <span class="badge badge-danger">Teacher Missed the Class!</span>
                                  @else
                                       @if($zoom_meeting->attended == 1)
                                           <?php
                                              
                                              $booking = App\Models\Booking::where('id',$zoom_meeting->booking_id)->first();
                                              //check if class is completed
                                               $metting_counter = App\Models\ZoomMeeting::where('booking_id',$booking->id)->get();
                                               $meet_count = $metting_counter->count();
                                               $time_counter = 1;
                                               if($meet_count == $time_counter)
                                               {
                                                 App\Models\Booking::where('id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                                 App\Models\MyClass::where('booking_id',$zoom_meeting->booking_id)->update(['completed'=>1]);
                                               }
                                            ?>
                                          
                                          <span class="badge badge-success">Class Ended!</span>

                                       
                                        @else
                                          <span class="badge badge-danger">You Missed the Class!</span>
                                        @endif
                                       
                                  @endif

                              @endif
                           </td>
                      </tr>
                     @endif
                     <!-- mutiple bookings -->
                     @if(is_array(json_decode($class->booked_times)))
                      @foreach(json_decode($class->booked_times) as $time)
                        <tr class="">
                          <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-3" height="38" width="38" alt="">
                            <span class="ml-3">{{$class->teacher->first_name}}</span>
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
                                $zoom_meeting_class = App\Models\ZoomMeeting::where('start_time', '=', $date_time)->with('booking')->first();
                             @endphp

                            @if($now < $start_time)

                              <span class="badge badge-info ">Not yet Time</span>

                            @elseif($now >= $start_time && $now <= $end_time)

                              @if(empty($zoom_meeting_class))

                                <span class="badge badge-warning">Waiting For Teacher <i class="fa fa-spinner"></i></span>
                               
                               @elseif(!empty($zoom_meeting_class->password))
                                    <span class="">Password: <span class="font-20 font-weight-600" id="copytext">{{$zoom_meeting_class->password}}</span> 
                                    <button  onclick="copyContent()" class="btn btn-success btn-sm">Copy</button>
                                  </span><br>
                                  <a href="{{ route('parents-join-class',$zoom_meeting_class->id)}}" class="btn btn-primary btn-sm" target="_blank">Join Class</a>
                               
                               @endif

                             @elseif ($now >= $end_time)

                                @if(empty($zoom_meeting_class))
                                        
                                      <span class="badge badge-danger">Teacher Missed the Class!</span>
                                @else
                                     @if($zoom_meeting_class->attended == 1)
                                         
                                        <?php
                                            $booking = App\Models\Booking::where('id',$zoom_meeting_class->booking_id)->with('teacher','who_booked')->first();
                                            // check if class is compleed
                                            $metting_counter = App\Models\ZoomMeeting::where('booking_id',$booking->id)->with('booking')->get();
                                            $meet_count = $metting_counter->count();
                                            $time_counter = count(json_decode($booking->booked_times));
                                            if($meet_count == $time_counter)
                                            {
                                              App\Models\Booking::where('id',$zoom_meeting_class->booking_id)->update(['completed'=>1]);
                                              App\Models\MyClass::where('booking_id',$zoom_meeting_class->booking_id)->update(['completed'=>1]);
                                            }

                                          ?>
                                         <span class="badge badge-success">Class Ended</span>
                                        @else
                                          <span class="badge badge-danger">You Missed the Class!</span>
                                        @endif
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
         <!-- today's class  ends-->
        @if ($attended_classes->count() > 0)
         <!-- today's class events starts -->
          <div class="card_margin card-body card">
            <div class="mt-3">
              <p class="font-16 subtab-text-2 font-weight-600 ml-3">Today's Class Events</p>
             </div>
             <div class="row mt-3 mb-5">
               <div class="table-responsive">
                 @php
                      $count = 1;
                    @endphp
                  @if ($attended_classes->count() == 0)
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
                    @foreach($attended_classes as $attend)
                    <?php
                     $user_info = App\Models\PersonalInformation::where('user_id',$attend->booking->teacher_booked)->with('user')->first();
                    ?>
                    <tr class="card-body">
                           <td>
                            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle ml-3" height="38" width="38" alt="">
                            <span class="ml-3">{{$attend->booking->teacher->first_name}}</span>
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
                           @if($attend->attended == 1)
                              @if($now >= $class_start && $now <= $class_end)
                                <span class="badge badge-info">On Going!</span>
                              @elseif($now >= $class_end)
                                
                                 <span class="badge badge-success">Attended <i class="fa fa-check"></i></span>

                              @endif
                            @else
                               {{-- {{$now ."  ".$class_start." ".$class_end}} --}}
                               @if($now >= $class_start && $now <= $class_end)
                                  <span class="badge badge-info">On Going!</span>
                               @elseif($now >= $class_end)
                                  <span class="badge badge-danger">Missed</span>
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
        <!-- today's Attended classes starts -->
        @endif

        <!-- recently booked teacher -->
        <div class="card card-body mb-5">
          <div class="mt-3 font-16 text-left">
            <h6 class="ml-3 mb-4 font-weight-600 subtab-text-2">Recently booked Teachers</h6>
          </div>
         @if($bookings->count()== 0)
         <div class="mt-5">
           <div class="text-center">
           <p class="">You have no Teachers yet. Whenever you accept and pay for a teacher, they appear here</p>
           </div>
         </div>
         <div class="mt-1 text-center">
          <a href="{{ route('explore')}}" class="btn btn-primary btn-lg">Find teachers</a>
        </div>
          <div class="mt-5 log_left text-center">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
          </div>
         <div class="mt-5 text-center">
         </div>
         @else
         <div class="row mb-5">
            @foreach ($bookings->chunk(10) as $group)
            @foreach ($group as $booking)
              @php
                $personal_info = App\Models\PersonalInformation::where('user_id',$booking->teacher_booked)->with('user')->first();
                $hourly_pay = App\Models\HourlyPay::where('user_id',$booking->teacher_booked)->with('user')->first();
                $rating = App\Models\Rating::where(['user_id'=>$booking->teacher_booked])->first();
                $rated = App\Models\RatedClass::where(['booking_id'=>$booking->id])->first();
              @endphp
              <div class="col-md-6 log_margin2 mt-3">
                <div class="card-body card">
                    <div class="text-center">
                      <img src="{{ asset($personal_info->profile_photo)}}" class="mb-2 "height="153" width="236" alt="">
                    </div>
                  <div class="text-left">
                      <span class="text_color font-weight-600 text-capitalize font-15">{{$booking->teacher->first_name." ".$booking->teacher->last_name}} 
                        <span class="font-15 float-right ml-3"><i class="fa fa-star text-warning"></i> {{$rating->average}}.0</span>
                      </span><br>
                      <span class="font-15 mt-1">{{$booking->subject}} <span class="font-weight-600 float-right font-15 ml-5"> ₦{{$hourly_pay->amount}} /hr </span> </span><br>
                      <span class="font-15 mt-1">{{$booking->level}}</span>
                  </div>
                <!-- array times -->
                @if(is_array(json_decode($booking->booked_times)))
                  @foreach(json_decode($booking->booked_times) as $time)
                      <?php
                          $date = date(date('Y:m:d',strtotime($booking->date)).' h:i a',strtotime($time));
                          $class_attended = App\Models\ZoomMeeting::where('start_time', '=', $date)->with('booking')->first();
                        ?>
                       @if(!empty($class_attended)) 
                          <span class="text-left">{{date('h:i A', strtotime($time))}} <i class="text-success fa fa-check"> </i></span> 
                          @if($rated)
                             <span class="badge badge-info">class Rated!</span>
                           @elseif ($class_attended->attended == 1)
                              <div class="card-body text-center">
                                <button href="javascript:void(0)" id="rating_btn" 
                                      value="{{$booking->id}}" class="primary"
                                      data-toggle="modal" data-target="#ratingModal">
                                      Rate Teacher <i class=" text-warning fa fa-star"></i>
                                 </button>
                                </div>
                            @else
                                <p class="text-center badge badge-info"> Rate after Class!</p>
                            @endif
                         @else
                           <span class="text-left">{{date('h:i A', strtotime($time))}} <i class="text-danger fa fa-times"> </i></span>
                          @endif
                    @endforeach
                  @endif
                 <!-- single time -->
                 @if(!is_array(json_decode($booking->booked_times)))
                      <?php
                          $date = date(date('Y:m:d',strtotime($booking->date)).' h:i a',strtotime($booking->booked_times));
                          $class_attended = App\Models\ZoomMeeting::where('start_time', '=', $date)->with('booking')->first();
                       ?>
                    @if(!empty($class_attended))
                    <span class="text-left">{{date('h:i A', strtotime($booking->booked_times))}} <i class="text-success fa fa-check"> </i></span>
                          @if($rated)
                             <span class="badge badge-info">class Rated!</span>
                           @elseif ($class_attended->attended == 1)
                              <div class="card-body text-center">
                                <button href="javascript:void(0)" id="rating_btn" 
                                      value="{{$booking->id}}" class="primary"
                                      data-toggle="modal" data-target="#ratingModal">
                                      Rate Teacher <i class=" text-warning fa fa-star"></i>
                                 </button>
                                </div>
                            @else
                                <p class="text-center badge badge-info"> Rate after Class!</p>
                            @endif
                     @else
                     <span class="text-left">{{date('h:i A', strtotime($booking->booked_times))}} <i class="text-danger fa fa-times"> </i></span> 

                     @endif
                   @endif
                </div>
              </div>
            @endforeach
           @endforeach 
         </div>
         @endif
         </div>
        <div class="justify-center">
             {{$bookings->links()}}
          </div>
       </div>
    </div>
      <!-- upcoming_classess -->
    <div class="col-md-4">
      <div class="card-body card">
        <h6 class="font-16 font-weight-600 subtab-text-2">Upcoming Class</h6>
        @if ($upcoming_class->count() == 0)
           <div class="mt-3 text-center">
             <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="100" width="70" alt=""><br>
             <span>You have no upcoming class</span>
          </div>
         @else
        @foreach ($upcoming_class as $class)
        @php
          $user_info = App\Models\PersonalInformation::where('user_id',$class->teacher_booked)->with('user')->first();
        @endphp
         <div class="mt-3">
            <img src="{{ asset($user_info->profile_photo)}}" class="rounded-circle mt-2 float-right" height="48" width="48" alt="">
            <span class="font-17">{{$class->subject}}</span><br>
            <span class="font-13 text-capitalize">{{$class->teacher->first_name ." ". $class->teacher->last_name}}</span><br>
            <span>
            @if (is_array(json_decode($class->booked_times)))
              @foreach (json_decode($class->booked_times) as $time)
                {{date('h:i A', strtotime($time))}},
              @endforeach
            @else
                {{date('h:i A', strtotime($class->booked_times))}},
            @endif
            </span><br>
            <span>{{ $class->date->format('d')}}  {{date('F', strtotime($class->date))}} {{$class->date->format('Y') }}</span>
          </div><hr>
        @endforeach
        @endif
      </div>

      <!-- rencent activites -->
        <div class="card">
          <div class="mt-2 mb-4">
            <div class="mt-3">
             <h6 class="ml-3 font-16 font-weight-600 subtab-text-2">Recent Activities</h6>
            </div>
            @if ($recent_activities->count() == 0 && $refunds->count() == 0)
             <div class="mt-5 text-center">
                <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
             </div>
             <div class="text-center">
              <p>You have no recent activities</p>
            </div>
            @else
            
            @foreach ($recent_activities as $activity)
             @if($activity->type == 'bookings')
             @php
               $details = App\Models\Booking::where('id',$activity->type_id)->with('teacher','who_booked')->first();
             @endphp
             <div class="card-body mt-1">
                <img  src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                <span class="float-right font-14">Your booking just been accepted <br>
                  <span class="font-14 text-capitalize">By  {{ substr($details->teacher->first_name ." ". $details->teacher->last_name,0,13)}}.</span> <br>
                  <span class="font-12">{{$activity->created_at->diffForHumans()}}</span><br>
                </span>
              </div>

              
             @endif

             @if ($activity->type == 'Fund wallet')
             @php
              $transaction =  App\Models\Transaction::where('id',$activity->type_id)->first();
             @endphp
             <div class="card-body mt-4">
                <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                <span class="float-right font-14">You just made Deposit of ₦{{$transaction->amount}} <br>
                  <span class="font-12">{{$activity->created_at->diffForHumans()}}</span><br>
                  <span class="font-12">Deposit to your wallet</span>
                {{-- </sapn> --}}
            </div>
             @endif
             
             @if ($activity->type == 'decline')
             @php
                $details = App\Models\Booking::where('id',$activity->type_id)->with('teacher','who_booked')->first();
             @endphp
             <div class="card-body mt-4">
                <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                <span class="float-right font-14">You Declined payment of ₦{{$details->total_amount}} <br>
                  <span class="font-12">{{$activity->created_at->diffForHumans()}}</span><br>
                  <span class="font-12">Payment Declined for <span class="font-14">{{ substr($details->teacher->first_name ." ". $details->teacher->last_name,0,12)}}...</span> </span>
                </span>
            </div>
             @endif

             @if ($activity->type == 'withdrawal')
             @php
                $transaction =  App\Models\Transaction::where('id',$activity->type_id)->first();
             @endphp
             <div class="card-body mt-4">
                <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                <span class="float-right font-14">You just made withdrawal of ₦{{$transaction->amount}} <br>
                  <span class="font-12">{{$activity->created_at->diffForHumans()}}</span><br>
                  <span class="font-12">withdrawal from your wallet</span>
                </span>
              </div>
             @endif
            @endforeach

           @foreach ($refunds as $refund)
             <div class="card-body mt-3">
                <img class="" src="{{ asset('front/assets/img/featured/actitvity.svg')}}" height="48" width="48" alt="">
                <span class="float-right font-12">Refund! for a class complain you logged<br>
                  <span class="font-12">{{$refund->created_at->diffForHumans()}}</span><br>
                  <span class="font-12">your account was credited with ₦{{number_format($refund->amount)}}.</span>
                </span>
            </div>
           @endforeach

            

          @endif
        </div>
       </div>
       </div>
    </div>
</section>
<!-- modal start -->

{{-- class feedback modal starts --}}
@foreach($attended_classes as $feedback)
  @php
    $class_feedback = App\Models\ClassFeedback::where('zoom_id',$feedback->id)->whereNUll('content')->with('zoom_class')->first();
  @endphp
  @if($feedback->attended == 1)
    @if($class_feedback)
      @include('students.class-feedback.feedback');
    @endif
  @endif
@endforeach
{{-- class feedback modal ends --}}

<div id="rating-modal"></div> 
<div id="success_rating"></div>
<!-- modal Ends -->

<!-- profile complete modal -->
<div  class="modal fade" id="whatnextModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="formModal"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="text-center">
              <img src="{{ asset('front/assets/img/details/icon.png')}}" height="48" width="48" alt="image"> 
                  <p class="mt-3 mb-3 text_color font-17">Congratulations you have completed your profile settings, </p>
                  <a href="{{ route('explore')}}" class="primary mb-3 mt-3"> Find a tutor</a>
                 </span>
              </div>
              
        </div>
      </div>
    </div>
  </div>
  <!-- profile complete modal -->

  <!-- reminder modal stars -->
<div  class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
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
                   <a href="{{ route('parentssettings.create')}}" class="btn btn-primary"> Complete profile <i class="fa fa-angle-double-right"></i></a>
               </span>
            </div>
            <div class="mb-5 mt-4 text-right">
                 <!-- <button type="button" class="  btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button> -->
             </div>
        </div>
      </div>
    </div>
  </div>
  <!-- reminder modal ends -->


   
@endsection
@section('scripts')
 <script src="{{ asset('front/assets/js/loader.js')}}"></script>
 <script src="{{ asset('front/assets/js/wallet-actions.js')}}"></script> 
 @if (Session::get('profile_complted') == 1)
  <script>
    $("#whatnextModal").modal('show');
  </script>
  @endif
  @if ($personal_infos->phone == null)
  <script>
    $("#reminderModal").modal('show');
  </script>
  @endif

  <script>
    let text = document.getElementById('copytext').innerHTML;
    const copyContent = async () => {
      try {
        await navigator.clipboard.writeText(text);
        alert('copied to clipboard');
      } catch (err) {
        console.error('Failed to copy: ', err);
      }
    }
  </script>

<script>
  $("#feedbackModal").modal('show');
  $(".modal-backdrop").hide();
</script>
 
 @endsection 