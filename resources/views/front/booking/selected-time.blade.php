<div class="row mt-4">
<input type="hidden" name="booked_dates" value="{{$selected_dates}}">
<input type="hidden" name="booked_times" value="{{json_encode($times)}}">
@foreach (json_decode($selected_dates) as $date)
<?php $dateformat = new DateTime($date); ?>
 <!-- <input style="font-size:25" class="form-control" value="{{$dateformat->format('l')}}, {{$dateformat->format('d')}} {{$dateformat->format('F')}} {{$dateformat->format('Y') }} " readonly> -->
@foreach ($times as $time)
<?php
 $list = explode(',', $time);
?>
@if ($list[1] == $date)
<!-- <p style="font-size:15px" class="mt-3 ml-4">{{date('h:i a',strtotime($list[0]))}}</p> -->
@endif 
@endforeach    
@endforeach
</div>
<?php
  $array_count = count($times);
  $total_amount = $hourly_pay->amount * $array_count;
 ?>
 <div class="mt-2 card-body text-center text_color">
   <input type="hidden" id="amount" value="{{$total_amount}}">
   <h5 style="font-size:20px" class="badge badge-info text-white">Total Amount</h5>
   <h4 style="font-size:20px;color:black;font-weight:600">₦{{number_format($total_amount)}}</h4>
</div>

 