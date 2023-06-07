  @if ($teachers->count() == 0) 
     <!-- <div class="mt-5 text-center">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
      </div>
      <div class="mt-3">
        <div class="text-center">
          <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
        </div>
      </div>
    <div class="mt-5 text-center"></div> -->
  @else
 <div class="row">
   @foreach ($teachers as $teacher)
    @php
    $users_info = App\Models\PersonalInformation::where('user_id',$teacher->teacher_booked)->with('user')->first();
    $hourly_pay = App\Models\HourlyPay::where('user_id',$teacher->teacher_booked)->with('user')->first();
    @endphp
    
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mt-2">
        <a href="javascript:void(0)" id="load_teacher_btn" value="{{$teacher->id}}">
        <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
        </a>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 text-left booked-t">
        <a href="javascript:void(0)" id="load_teacher_btn" value="{{$teacher->id}}">
          <span class="text_colorfont-weight-bold font-14">{{$teacher->teacher->first_name}}</span><br>
        </a>
        <span class="font-13">{{$teacher->subject}}.</span><br>
        <span class="font-13 mt-3">{{$teacher->level}}.</span>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 booked-t2">
        <span class="font-weight-bold font-14">₦{{$hourly_pay->amount}} / hr</span><br>
        <span class="font-13"> 
             @if($teacher->completed == 1)
                  <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
              @elseif($teacher->date == today())
                  <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
              @elseif ($teacher->date <= today())
                  <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
              @elseif ($teacher->date >= today())
                  <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
              @endif
        </span><br>
        <span>{{$teacher->date->format('d')}} {!!substr(date('F', strtotime($teacher->date)),0,3)!!}.  {{$teacher->date->format('Y')}}</span>
    </div><hr>
    @endforeach
   </div>
    <div class="justify-center">
        {{$teachers->links()}}                                          
    </div>
  @endif
