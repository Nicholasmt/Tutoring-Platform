<div id="myclass">
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
      <img src="{{ asset($users_info->profile_photo)}}" class="mb-2" height="162" width="200" alt=""><br>
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
            <!-- single -->
            @endif
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
              <p class="text-left">{{$class->booking->date->format('d')}}  {{date('F', strtotime($class->booking->date))}} {{$class->booking->date->format('Y') }}</p>
      </div>

  </div>
 </div>