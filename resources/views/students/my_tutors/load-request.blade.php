<div class="card-body">
  <a id="back_btn" href="javascript:void(0)" class="btn btn-primary">Go back</a>
  <div class="row">
   <div class="col-md-5 col-xl-5 col-sm-5">
    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
       <div class="row">
        @foreach ($teachers as $teacher)
            @php
            $users_info = App\Models\PersonalInformation::where('user_id',$teacher->teacher_booked)->with('user')->first();
            $hourly_pay = App\Models\HourlyPay::where('user_id',$teacher->teacher_booked)->with('user')->first();
            @endphp
        
        <div class="col-md-3 mt-2">
            <a href="javascript:void(0)" id="all_teachers_btn" value="{{$teacher->id}}">
            <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
            </a>
        </div>
        <div class="col-md-4 text-left booked-t">
            <a href="javascript:void(0)" id="all_teachers_btn" value="{{$teacher->id}}">
            <span class="text_color">{{$teacher->teacher->first_name}}</span><br>
            </a>
            <span class="">{{$teacher->subject}}.</span><br>
            <span class="mt-3">{{$teacher->levels}}.</span>
        </div>
        <div class="col-md-5 booked-t2">
            <span class="text_color">₦{{$hourly_pay->amount}} / hr</span><br>
            <span>Date</span><br>
            <span>{{$teacher->date->format('d')}}  {{date('F', strtotime($teacher->date))}} {{$teacher->date->format('Y')}}</span>
        </div><hr>
        @endforeach
        </div>
      </ul>
</div>
<div class="col-xl-7 col-sm-7 col-md-7">
  <div class="tab-content no-padding card-body card" id="myTab2Content">
    <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
      <!-- load teacher -->
      <div id="load-teachers"></div>
       <div id="hide_div">
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
                  <p class="text-danger text-right"><i class="fa fa-circle font-8"></i> Passed / Missed!</p>
              @elseif ($details->date >= today())
                  <p class="text-info text-right"><i class="fa fa-circle font-8"></i> Upcoming</p>
              @endif

            <div class=" text-center mt-3">
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
                <a class="btn text-left col-5" data-toggle="collapse" href="#education" role="button"
                aria-expanded="false" aria-controls="education">
                Education  
                </a>
                <a class="btn text-right col-5" data-toggle="collapse" href="#education" role="button"
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
             
            <div class="col-md-">
                <label class="text-left font-17">Scheduled Time / Date</label><br>
                <!-- Array -->
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
                      <!-- <input type="text" class="form-control" value="" readonly> -->
                      <p class="text-left">{{$details->date->format('d')}}  {{date('F', strtotime($details->date))}} {{$details->date->format('Y') }}</p>
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
                                  <p class="font-16 col-md-6 text-danger">You logged  a complain and is under review  <i class=" text-warning fa fa-spinner"></i></p>
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
   </div>
</div>
<!-- <script src="{{ asset('front/assets/js/loader.js')}}"></script> -->