<div class="card-bod">
  <div class="col-12 col-lg-12">
    @if ($in_progress->count() == 0)
    <div class="log_left text-center">
        <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
    </div>
    <div class="mt-3">
        <div class="text-center">
        <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
        </div>
    </div>
    <div class="mt-1 text-center">
        <!-- <a href="{{ route('explore')}}" class="btn btn-primary btn-lg ">Find teachers</a> -->
    </div>
    <div class="mt-5 text-center">
    </div>
    @else
    <div class="row mt-1">
        @foreach ($in_progress as $pending)
        @php
        $users_info = App\Models\PersonalInformation::where('user_id',$pending->teacher_booked)->first();
        $hourly_pay = App\Models\HourlyPay::where('user_id',$pending->teacher_booked)->first();
        @endphp
        <div class="col-md-4">
          <div class="row">
            <div class="col-3 mt-3 text-left">
                <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
            </div>
            <div class="col-md-5 mt-2">
                <span class="font-14 font-weight-bold">{{$pending->teacher->first_name}}</span><br>
                <span class="font-13">{{$pending->subject}}.</span><br>
                <span class="font-13 mt-3">{{$pending->level}}.</span>
            </div>
             <div class="col-md-4 mt-2 text-left">
              <span class="font-14 font-weight-bold">₦{{$hourly_pay->amount}} / hr</span><br>
              <span class="font-13">
                @if ($pending->completed == 1)
                  <span class="text-success">Completed</span>
                @else
                  <span class="text-info">In Progress</span>
                @endif
              </span><br>
              <span>{{$pending->date->format('d')}} {!!substr(date('F', strtotime($pending->date)),0,3)!!}. {{$pending->date->format('Y')}}</span>
            </div>
            </div> 
        </div>
        @endforeach
    </div>
    @endif
    <div class="justify-center">
    {{$in_progress->links()}}  
    </div>
    </div>
    </div>