<div id="load-details"></div>
 <div class="card-bod" id="hide">
  @if ($requests->count() == 0)
    <div class="log_left text-center mt-5">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
        </div>
        <div class="mt-3">
            <div class="text-center">
            <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
            </div>
        </div> 

    @else
   <div class="row">
        @foreach ($requests as $request)
        @php
        $users_info = App\Models\PersonalInformation::where('user_id',$request->teacher_booked)->with('user')->first();
        $hourly_pay = App\Models\HourlyPay::where('user_id',$request->teacher_booked)->with('user')->first();
        @endphp
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-3 text-left">
                <button  class="js_button"  id="load_request_btn" value="{{$request->teacher_booked}}">
                <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
                </button>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 mt-2">
              <span class="font-weight-bold font-14">{{$request->teacher->first_name}}</span><br>
              <span class="font-13">{{$request->subject}}.</span><br>
              <span class="font-13 mt-3">{{$request->level}}.</span>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6 mt-2 text-left detail-align">
              <span class="font-weight-bold font-14">₦{{$hourly_pay->amount}} / hr</span><br>
                @if($request->completed == 1)
                    <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
                @elseif($request->date == today())
                    <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
                @elseif ($request->date <= today())
                    <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
                @elseif ($request->date >= today())
                    <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
                @endif
               </div>
            </div> 
        </div>
        @endforeach
    </div>
  @endif
    <div class="justify-center">
        {{$requests->links()}}
    </div>
    </div>