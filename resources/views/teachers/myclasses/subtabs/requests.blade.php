<div class="col-12 col-lg-12">
    @if ($requests->count() == 0)
    <div class="mt-5">
      <div class="text-center">
            <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
            <p class="font-16">You don't have any Classes yet</p>
        </div>
    </div>
    <div class="mt-1 text-center">
        <!-- <a href="{{ route('explore')}}" class="btn btn-primary btn-lg ">Find teachers</a> -->
    </div>
    <div class="mt-5 text-center">
    </div>
    @else
    <div class="row mt-1">
        @foreach ($requests as $request)
        @php
        $users_info = App\Models\PersonalInformation::where('user_id',$request->booking->who_booked->id)->with('user')->first();
        @endphp
        <div class="col-4">
           <div class="row">
            <div class="col-3 mt-3 text-left">
                <img src="{{ asset($users_info->profile_photo)}}" class="mb-5"height="75" width="75" alt="">
            </div>
            <div class="col-md-5 mt-2">
                <span class="font-weight-bold font-14">{{$request->booking->who_booked->first_name." ".$request->booking->who_booked->last_name}}</span><br>
                <span class="font-13">{{$request->booking->subject}}.</span><br>
                <span class="font-13 mt-3">{{$request->booking->level}}.</span>
            </div>
            <div class="col-md-4 mt-2 float-right">
                <span class="font-14">{{$request->booking->date->format('d')}} {!!substr(date('F', strtotime($request->date)),0,3)!!}. {{$request->booking->date->format('Y')}}</span><br>
                <span class="font-14">
                @if($request->booking->completed == 1)
                  <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
                @elseif($request->booking->date == today())
                    <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
                @elseif ($request->booking->date <= today())
                    <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
                @elseif ($request->booking->date >= today())
                    <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
                @endif
                </span>
            </div>
            </div> 
        </div>
        @endforeach
    </div>
    @endif
    <div class="justify-center">
   </div>
</div>