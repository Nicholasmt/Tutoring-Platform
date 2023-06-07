 
@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<link rel="stylesheet" href="{{ asset('front/assets/css/datepicker/jquery-timepicker-addon.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css"> -->
<link rel="stylesheet" href="{{ asset('front/assets/css/datepicker/datepicker-Jquery.css')}}">
<!-- <link rel="stylesheet" href="{{ asset('front/assets/css/datepicker/datepicker-smoothness.css')}}"> -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> -->
@endsection
@extends('front-layout.app')
@section('body')
<header id="header-wrap">
@include('front-layout.top-nav')
</header>
<div class="main-container section-padding mt-5">
 
<div class="container">
<div class="text-left">
<!-- <a href="{{ route('details',$teacher->id)}}" class="btn">back</a> -->
</div>
<form action="{{ route('parents-booking_checkout')}}" method="POST"> 
<div class="row">
<div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
<!-- aside start -->
<aside>
<div class="widget">
<div class="mt-4">
<img class="img-fluid" src="{{ asset($personal_info->profile_photo)}}" height="173" width="241" alt="image">
</div>
<div class="text-center mt-3">
<h5 class="text_color text-capitalize">{{$teacher->first_name ." ".$teacher->last_name}}</h5>
<p class="">{{$personal_info->town . ",". $personal_info->state}}</p>
<h5 class="mb-5 mt-2 text_color">₦{{number_format($hourly_pay->amount)}} / hr</h5>
</div>
<div class="mt-3" id="schedule_times"></div>
</div>
</aside>
<!-- aside Ends -->
</div>
@csrf
 <!-- contents -->
<div class="col-lg-5 col-md-12 col-xs-12 page-content">
<div class="row">
 
<div class="form-group date_picker">
<label for="select_date" class="text_primary ml-3">Pick the day(s) and time to hire {{$teacher->first_name}}?</label>
<div type="text" id="datepicker" class="col-md-12 mt-3 table-responsive"></div><hr>
<input type="hidden" name="teacher_id" id="teacher" value="{{$user_id}}">
<input type="hidden" name="subject" id="subject" value="{{$subject}}">
<input type="hidden" name="category" id="category" value="{{$category}}">
<input type="hidden" name="meetup" id="meetup" value="{{$meetup}}">
</div>
<!-- <div class="mt-3" id="schedule_times"></div> -->
</div>
</div>
<!-- contents ends -->
<div class="col-lg-4 col-md-12 col-xs-12 page-content mt-5">
<!-- times  -->
<div class="" id="available-time"></div>
<!-- times ends -->
<div class="form-group float-right mt-5">
<!-- <button type=buttton id="checkout" class="btn btn-common col-5 mt-4" data-toggle="modal" data-target="#checkoutModal"> Book Now </button> -->
<button type="submit" id="book_button" class="btn btn-common btn-md">Book Now</button>
</div>
</div>
</div>
</form>
</div>
</div>
@include('front-layout.footer')
<a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>
<div id="checkout_booking"></div>

<script data-cfasync="false" src="{{ asset('front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>
 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="{{ asset('front/assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-UI-v1.12.1.js')}}"></script>
 <!-- <script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script> -->
<script src="{{ asset('front/assets/js/multidatePicker.js')}}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/booking.js')}}"></script>

<script>
//datepicker
$( function() {
  $("#book_button").hide();
  var arrayDays = [@foreach ($schedules as $s =>$schedule) {{$schedule->day}}, @endforeach];
$("#datepicker").multiDatesPicker({
  minDate: 0,
  beforeShowDay: function(date){
    var day = date.getDay();
    return [(arrayDays.indexOf(day) != -1)];
  },
  onSelect: function(date){
    let base_url = $('meta[name="site_url"]').attr("content");
    var value = $("#teacher").val();
    date = new Array();
    date.push($(this).val());
    
    if(date == "")
    {
      $("#available-time").hide();
      $("#book_button").hide();
    }
    else
    {
      $.get(base_url + "/parents/available-time/" + value, {date:date}, function (data,status,error) {
          if (data) {
              $("#available-time").html(data);
              $("#book_button").show();
              $("#available-time").show();
          } else {
              $("#available-time").html(error);
           }
      });
   
    }
 
  },
  changeMonth: true,
  changeYear: true,
  dateFormat:'yy-mm-dd',
 });
 
 
  
});
 
 </script>  

@endsection

 