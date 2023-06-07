<!-- <h5 class="col-md-11">Available Time Slots, <span class="text-danger">Note: Empty time slot means teacher is fully booked!</span></h5> -->
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="expectations">Expections (optional).</label>
<textarea name="expectations" class="form-control" cols="10" rows="4" placeholder="Enter Your Expections"></textarea>
</div>
<input type="hidden" id="selected_dates" value="{{json_encode($dates)}}" name="selected_dates">   
@foreach ($dates as $key => $date) 
<?php
  $dateformat = new DateTime($date);
//   $newdate = $dateformat->format('Y-m-d');
  if($dateformat->format('l') == "Tuesday"){ $week = 2; } if($dateformat->format('l') == "Sunday"){ $week = 0; }
  if($dateformat->format('l') == "Friday"){ $week = 5; } if($dateformat->format('l') == "Saturday"){ $week = 6; }
  if($dateformat->format('l') == "Thursday"){ $week = 4; }  if($dateformat->format('l') == "Wednesday"){ $week = 3; }
  if($dateformat->format('l') == "Monday"){ $week = 1; }

  $time_schedule = App\Models\Schedule::where(['user_id'=>$teacher_id,'day'=>$week])->first();
 
  $bookedDays = App\Models\BookedDay::where(['teacher_id'=>$teacher_id,'date'=>$date,'status'=>0])->get();
   
 ?>

<input style="font-size:25" class="form-control text-center" value="{{$dateformat->format('l')}}, {{$dateformat->format('d')}} {{$dateformat->format('F')}} {{$dateformat->format('Y') }} " readonly>
<p class="text-danger">Note: Limit is @if($time_schedule->time_limit == 1) Once per booking @elseif($time_schedule->time_limit == 2) Twice per booking @elseif($time_schedule->time_limit == 3) Thrice per booking @endif</p>
<script>
  const limit = {!!$time_schedule->time_limit!!};
 $('input.times_{!!$key!!}').on('change', function(e) {
    if($('input.times_{{$key}}:checked').length >= limit) {
       $(".times_{!!$key!!}").not(":checked").attr("disabled",true);
     //    alert("allowed only 2");
    }
    else{
     $(".times_{!!$key!!}").not(":checked").removeAttr("disabled");
    }
 });
 </script> 

@foreach (json_decode($time_schedule->time_split) as $time)
 


@if ($bookedDays->count() == 0)
<p class="mt-2 ml-4 text_size badge badge-light">
<input type="hidden" id="value" value="{{$time_schedule->id}}"
@if($time_schedule->break_times !== null)
@foreach (json_decode($time_schedule->break_times) as $b_time)
@if($time == $b_time)
 style="display:none;"
@endif
@endforeach
@endif>

{{date('h:i a',strtotime($time))}}
<input type="hidden" id="date" name="date[]" value="{{$date}}">
<input type="checkbox" id="selected" value="{{$time .','. $date}}" name="booking_time" class="times_{{$key}}">
</p>
 

@else
 

<p class="badge badge-light mt-3 ml-4 text_size"
@foreach ($bookedDays as $day)
 
@if (is_array(json_decode($day->booked_times)))
 
@foreach (json_decode($day->booked_times) as $booked_time)
@if ($time_schedule->break_times == null)
@if($time == $booked_time)
 style="display:none;"
@endif 
@else
@foreach (json_decode($time_schedule->break_times) as $b_time)
@if($time == $booked_time  || $time == $b_time)
 style="display:none;"
@endif 
@endforeach
@endif
@endforeach

@else

 
@if ($time_schedule->break_times == null)
@if($time == $day->booked_times)
 style="display:none;"
@endif 
@else
@foreach (json_decode($time_schedule->break_times) as $b_time)
@if($time == $day->booked_times  || $time == $b_time)
 style="display:none;"
@endif 
@endforeach
@endif

@endif
@endforeach>

{{date('h:i a',strtotime($time))}}

<input type="hidden" id="date" name="date[]" value="{{$date}}">
<input type="checkbox" id="selected" value="{{$time .','. $date}}" name="booking_time" class="times_{{$key}}" 
@foreach ($bookedDays as $day)

@if (is_array(json_decode($day->booked_times)))
 
@foreach (json_decode($day->booked_times) as $booked_time)
@if ($time_schedule->break_times == null)
@if($time == $booked_time)
 style="display:none;"
@endif
@else
@foreach (json_decode($time_schedule->break_times) as $b_time)
@if($time == $booked_time || $time == $b_time)
 style="display:none;"
@endif 
@endforeach
@endif
@endforeach


@else
 
@if ($time_schedule->break_times == null)
@if($time == $day->booked_times)
 style="display:none;"
@endif
@else
@foreach (json_decode($time_schedule->break_times) as $b_time)
@if($time == $day->booked_times || $time == $b_time)
 style="display:none;"
@endif 
@endforeach
@endif

@endif


@endforeach>

</p>

@endif




@endforeach

{{-- <script>
  var limit =  {!!$time_schedule->time_limit!!};
 $('input.times_{!!$key!!}').on('change', function(e) {
    if($('input.times_{{$key}}:checked').length >= limit) {
       $(".times_{!!$key!!}").not(":checked").attr("disabled",true);
     //    alert("allowed only 2");
    }
    else{
     $(".times_{!!$key!!}").not(":checked").removeAttr("disabled");
    }
 });
 </script> --}}

@endforeach



</div>
</div>
 
@php
$total_limit = count($dates) * $time_schedule->time_limit; 
@endphp
 

 