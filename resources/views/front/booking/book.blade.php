@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endsection
@extends('front-layout.app')
@section('body')
<header id="header-wrap" style="margin-top:%">
@include('front-layout.top-nav')
</header>
<div class="main-container section-padding mt-5">
 
<div class="container">
<div class="text-left">
<a href="{{ route('details',$teacher->id)}}" class="btn">back</a>
</div>
<!-- aside start -->

<div class="row">
<div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
<aside>
<div class="widget">
<div class="mt-4">
<img class="img-fluid" src="{{ asset($personal_infos->profile_photo)}}" height="453" width="630" alt="image">
</div>
<div class="text-center mt-3">
<h5 class="text_color">{{$teacher->first_name ." ".$teacher->last_name}}</h5>
<p class="">{{$personal_infos->town . ",". $personal_infos->state}}</p>
<h5 class="mb-5 mt-2 text_color">₦{{$hourly_pay->amount}} / hr</h5>
</div>
 
</div>
</aside>
</div>
<!-- aside ends -->

 <!-- contents -->
<div class="col-lg-5 col-md-12 col-xs-12 page-content">
<div class="row">
<div class="container ml-2">
<div class="form-group">
<input type="hidden"  value="{{$teacher->id}}" name="teacher_id">
<!-- <label class="text_color h6" for="">1. Where would you like to meet {{$teacher->first_name}}?</label><br> -->
<label class="text_color h6" for="">1. Meetup</label><br>
<input type="checkbox" class=" ml-5 form-control-radio mt-4" value="online" name="meetup" checked>
<label for="">Online</label>
<!-- <input type="radio" class=" ml-5 form-control-radio mt-4" value="inperson" name="meetup">
<label for="">In- Person</label> -->
</div>
<div class="form-group">
<label class="text_color mb-3 h6">2. Select time that would be convenient for you from the available days</label>

<div class="" id="datepicker">
 <p type="text" class="form-control col-md-10" id="datepicker"></p>
</div>

<div class="form-group mt-4">
<label for="">{{$teacher->first_name}}'s Scheduled Days</label>
<select name="day" id="select_day" class="custom-select mt-3 col-md-9">
<option disabled selected>select a day</option>
@foreach ($schedules as $schedule)
<option value="{{$schedule->id}}" id="{{$schedule->id}}">{{$schedule->day}}</option>
@endforeach
</select>
</div>
 
<!-- load calendar -->
  <div id="load-calendar"></div>
<!-- load calendar -->

<!-- load check availablity -->
<div class="mb-5" id="check-availablity"></div>
<!-- load check availablity -->

 </div>
</div> 
</div>
</div>
<!-- contents ends -->
<div class="col-lg-4 col-md-12 col-xs-12 page-content">
<div class="form-group">
<label for="inputPassword3" class=" text_color h6"> 3.Subject that {{$teacher->first_name}} offer?</label>
<select name="subject" id="subject" class="custom-select mt-3" id="inputGroupSelect05">
    @foreach (json_decode($subjects->title) as $item)
      <option value="{{$item}}">{{$item}}</option>   
    @endforeach
 </select>
</div>

<div class="form-group">
<label for="inputPassword3" class=" text_color h6">4. What category is your child in?</label>
<select name="category" id="category" class="custom-select mt-3" id="inputGroupSelect05">
@foreach ($categories as $category)
<option value="{{$category->id}}" @if(isset($subjects)) @if($subjects->category_id == $category->id) selected @endif @endif >{{$category->title}}</option>   
@endforeach
</select>
</div><hr>
<!-- load check availablity -->
<div class="">
  <h5 class=" text-center alert alert-dark">View booking Deatils here. </h5>
</div>
  <div class="mb-5" id="schedule_times"></div>
 <!-- load check availablity -->
 
<div class="form-group text-right">
<button id="book_btn" class="btn btn-common col-5 mt-4 button_btn" data-toggle="modal" data-target="#exampleModal">Book</button>
<a href="{{ route('bookings',$subjects->user_id)}}" class="btn btn-common col-5 mt-4 button_btn">Continue</a>
</div>
</div>
</div>
</div>
</div>

<div id="success-booking"></div>

<!-- Deposit modal start -->
<div style="background-color:black" class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text_color" id="formModal">Fund your Wallet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       <form action="https://checkout.flutterwave.com/v3/hosted/pay" method="POST">
        @csrf
          @php
              $txid = substr(rand(0,time()),0,8)
          @endphp
         <div class="modal-body">
            <input type="hidden" name="public_key" value="FLWPUBK_TEST-e5513ebe30aabc43d2107e1f5044fde1-X">
            <input type="hidden" name="customer[name]" value="{{$user->first_name.' '.$user->last_name}}">
            <input type="hidden" name="customer[email]" value="{{$user->email}}">
            <input type="hidden" name="tx_ref" value="{{$txid}}">
            <input type="hidden" name="meta[token]" value="5">
            <input type="hidden" name="currency" value="NGN">
             <input type="hidden" name="redirect_url" value="{{ route('parents-depositCallback')}}">
            <input type="hidden" name="customizations[title]" value="Olukotide">
            <input type="hidden" name="customizations[description]" value="Fund Wallet"/>
            <input type="hidden" name="customizations[logo]" value="https://mir-s3-cdn-cf.behance.net/projects/404/3d63b794805785.5e87b6b83f9f3.png">
            <div class="form-group">
              <label for="">Amount</label>
              <input type="number" class="form-control" name="amount" required>
            </div>
            
            <div class="mb-5 mt-4 text-center">
               <button type="button" class="btn btn-outline-common  mr-5" data-dismiss="modal" aria-label="Close">Go back</button>
              <button type="submit" class="btn btn-common ml-5 text-white">Fund</button>
            </div>
         </div>
      </form>
      </div>
    </div>
  </div>
  <!-- Deposit modal Ends -->
  

@include('front-layout.teachers-list')

@include('front-layout.footer')

<a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>


<script data-cfasync="false" src="{{ asset('front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script>

<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/booking.js')}}"></script>
 
  
 <!-- <script>
 $( function() {

  var arrayDays = [ @foreach ($schedules as $s =>$schedule) {{$schedule->day}}, @endforeach ];
$("#datepicker").multiDatesPicker({
  beforeShowDay: function(date){
    var day = date.getDay();
    return [(arrayDays.indexOf(day) != -1)];
  },
  changeMonth: true,
  changeYear: true,
  dateFormat:'yy-mm-dd',
 });
 
//  $('#datepicker').datepicker("show");
  
}); -->
 
 </script>  

 


 


 
 

@endsection