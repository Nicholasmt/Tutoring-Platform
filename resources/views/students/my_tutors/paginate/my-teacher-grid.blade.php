<div class="card-bod">
  <div class="col-12 col-lg-12">
    @if ($my_teachers->count() == 0)
    <div class="log_left text-center">
        <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
    </div>
    <div class="mt-0">
        <div class="text-center">
        <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
        </div>
    </div>
    <div class="mt-1 text-center"></div>
    
    @else
    <div class="row mt-1">
        @foreach ($my_teachers as $my_teacher)
        @php
        $users_info = App\Models\PersonalInformation::where('user_id',$my_teacher->teacher_booked)->with('user')->first();
        $hourly_pay = App\Models\HourlyPay::where('user_id',$my_teacher->teacher_booked)->with('user')->first();
        @endphp
        <div class="col-md-4 col-sm-12">
          <div class="row">
            <div class="col-md-3 col-sm-3 mt-3 text-left">
                <img src="{{ asset($users_info->profile_photo)}}" class="mb-5" height="75" width="75" alt="">
            </div>
            <div class="col-md-5 mt-2">
                <span class="font-14 font-weight-bold">{{$my_teacher->teacher->first_name}}</span><br>
                <span class="font-13">{{$my_teacher->subject}}.</span><br>
                <span class="font-13 mt-3">{{$my_teacher->level}}.</span>
            </div>
            <div class="col-md-4 col-sm-4 mt-2 text-left">
              <span class="font-14 font-weight-bold">₦{{$hourly_pay->amount}} / hr</span><br>
               <span class="font-13">
               @if($my_teacher->completed == 1)
                  <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
                @elseif($my_teacher->date == today())
                    <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
                @elseif ($my_teacher->date <= today())
                    <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
                @elseif ($my_teacher->date >= today())
                    <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
                @endif
               </span><br>
              <span>{{$my_teacher->date->format('d')}} {!!substr(date('F', strtotime($my_teacher->date)),0,3)!!}. {{$my_teacher->date->format('Y')}}</span>
            </div>
          </div> 
        </div>
        @endforeach
    </div>
    @endif
    <div class="justify-center">
    {{$my_teachers->links()}}  
    </div>
    </div>
    </div>