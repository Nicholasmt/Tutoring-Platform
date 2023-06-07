<div class="card-body">
    <div class="row">
        <div class="col-5">
        @if ($myclasses->count() == 0)
        <!-- <div class="mt-5">
           <div class="text-center">
              <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
              <p class="font-16">You don't have any Classes yet</p>
           </div>
         </div> -->
          @endif
          <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
            <div class="row">
                @foreach ($myclasses as $class)
                @php
                $users_info = App\Models\PersonalInformation::where('user_id',$class->booking->who_booked->id)->first();
                @endphp
                <div class="col-md-3 mt-2">
                <a href="javascript:void(0)" id="myclass_btn" value="{{$class->id}}">
                    <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
                </a>
                </div>
                <div class="col-md-4 text-left booked-t">
                <a href="javascript:void(0)" id="myclass_btn" value="{{$class->id}}">
                    <span class="text_color">{{$class->booking->who_booked->first_name}}</span><br>
                </a>
                <a  id="myclass_btn" value="{{$class->id}}">  
                <span class="">{{$class->booking->subject}}.</span><br>
                <span class="mt-3">{{$class->booking->level}}.</span>
                </div>
                <div class="col-md-5 booked-t2">
                <span>{{$class->booking->date->format('d')}}  {{date('F', strtotime($class->booking->date))}} {{$class->booking->date->format('Y')}}</span>
                </div><hr>
                </a>
            @endforeach
            </div>
            <!-- <div class="justify-center">
            </div> -->
        </ul>
        </div>
         @if ($myclasses->count() == 0)
         <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
            <div class="mt-5">
            <div class="text-center">
                <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
                <p class="font-16">You don't have any Classes yet</p>
            </div>
            </div>
         </div>
         @else
         <div class="col-12 col-sm-12 col-md-7">
          <div class="tab-content no-padding card-body card" id="myTab2Content">
           <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
            <!-- load teacher -->
            <div id="myclass-content"></div>
               <div id="myclass">
                @foreach ($myclasses as $class)
                @php
                $duration = Carbon\Carbon::parse($class->booking->hire_to)->diffInDays($class->booking->hire_from);
                $users_info = App\Models\PersonalInformation::where('user_id',$class->booking->who_booked->id)->with('user')->first();
                @endphp

                 @if($class->booking->completed == 1)
                    <p class="text-success text-right"><i class="fa fa-circle font-8"></i> Completed</p> 
                @elseif($class->booking->date == today())
                    <p class="text-warning text-right"><i class="fa fa-circle font-8"></i> In Progress</p>
                @elseif ($class->booking->date <= today())
                    <p class="text-danger text-right"><i class="fa fa-circle font-8"></i> Passed / Missed!</p>
                @elseif ($class->booking->date >= today())
                    <p class="text-info text-right"><i class="fa fa-circle font-8"></i> Upcoming</p>
                @endif

                 <div class=" text-center mt-3">
                   <img src="{{ asset($users_info->profile_photo)}}" class="mb-2" height="158" width="200" alt=""><br>
                    <span class="h3 text_color">{{$class->booking->who_booked->first_name." ".$class->booking->who_booked->last_name}}</span>
                    <p class="font-14">{{$class->booking->who_booked->email}}</p>
                    </div>
                    <div class="text-center mt-4">
                    <div class="row text-left">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Category</label>
                        <input type="text" class="form-control" value="{{$class->booking->level}}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="text-success">Amount Paid <i class="fa fa-check"></i></label>
                            <input type="text" class="form-control" value="₦{{$class->booking->amount_paid}}" readonly>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" value="{{$class->booking->subject}}" readonly>
                        </div>
                        
                        <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control" value="{{$class->booking->date->format('d')}}  {{date('F', strtotime($class->booking->date))}} {{$class->booking->date->format('Y')}}" readonly>
                        </div>
                    </div>
                    </div>
                    <div class="col-md">
                      <label class="text-left font-17">Scheduled Time / Date</label><br>
                          <!-- array -->
                            @if(is_array(json_decode($class->booking->booked_times)))
                                @foreach (json_decode($class->booking->booked_times) as $times)
                                   <?php
                                    $date_time = date($class->date.' h:i a',strtotime($times));
                                    $meeting = App\Models\ZoomMeeting::where(['booking_id'=>$class->booking->id])->where('start_time', '=', $date_time)->with('booking')->first();
                                   ?>
                                    @if ($meeting)
                                     <p class="text-left">{{date('h:i A', strtotime($times))}}  <i class="text-success fa fa-check"> </i></p>
                                    @else
                                     <p class="text-left">{{date('h:i A', strtotime($times))}}  <i class="text-danger fa fa-times"> </i></p>
                                    @endif
                                @endforeach
                              @endif
                           <!-- single -->
                           @if(!is_array(json_decode($class->booking->booked_times)))
                                  <?php
                                     $date_time = date($class->date.' h:i a',strtotime($class->booking->booked_times));
                                    $meeting = App\Models\ZoomMeeting::where(['booking_id'=>$class->booking->id])->where('start_time', '=', $date_time)->with('booking')->first();
                                    ?>
                                    @if ($meeting)
                                    <p class="text-left">{{date('h:i A', strtotime($class->booking->booked_times))}} <i class="text-success fa fa-check"> </i></p>
                                @else
                                    <p class="text-left">{{date('h:i A', strtotime($class->booking->booked_times))}} <i class="text-danger fa fa-times"> </i></p>
                                @endif
                            @endif
                                <!-- <input type="text" class="form-control" value="" readonly> -->
                                <p class="text-left">{{$class->booking->date->format('d')}}  {{date('F', strtotime($class->booking->date))}} {{$class->booking->date->format('Y') }}</p>
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