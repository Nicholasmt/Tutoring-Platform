 
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
 @include('back-layout.error')
</div>
<!-- aside start -->
<form action="{{ route('parents-schedule-date')}}" method="POST">
 @csrf
<div class="row">
<div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
<aside>
<div class="widget">
<div class="mt-4">
<img class="img-fluid" src="{{ asset($personal_info->profile_photo)}}" height="453" width="630" alt="image">
</div>
<div class="text-center mt-3">
<h5 class="text_color text-capitalize">{{$teacher->first_name ." ".$teacher->last_name}}</h5>
<p class="">{{$personal_info->town . ",". $personal_info->state}}</p>
<h5 class="mb-5 mt-2 text_color">₦{{number_format($hourly_pay->amount)}} / hr</h5>
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
<input type="hidden" value="{{$teacher->id}}" name="teacher_id">
<label class="text_color font-14" for="">1. Meetup</label><br>
<label class="check-bo mt-3">
<input type="radio" class="form-control-radio mt-3" value="online" name="meetup" class="custom-chechbo" checked>
<span class="checkmar"></span>
<span class="">Online</span>
</label>
<label class="ml-4"> 
<input type="radio" class="" disabled>
in-person <span class="font-italic">(not available now)</span>
</label>
</div>
 
<div class="form-group">
<label for="category" class=" text_color h6 mt-1">2. What Level is your child in?</label>
<select name="category" id="category" class="custom-select mt-3" id="category">
@foreach (json_decode($subjects->levels) as $level)
<option value="{{$level}}">{{$level}}</option>   
@endforeach
</select>
</div>
</div> 
</div>
</div>
<!-- contents ends -->
<div class="col-lg-4 col-md-12 col-xs-12 page-content mt-5">
<div class="form-group mt-5">
<label for="subject" class="text_color h6"> 3. Subject that {{$teacher->first_name}} offers?</label>
<select name="subject" id="subject" class="custom-select mt-3" id="subject">
    @foreach (json_decode($subjects->title) as $item)
      <option value="{{$item}}">{{$item}}</option>   
    @endforeach
 </select>
</div>
<div class="form-group text-right mt-5">
<button type="submit" class="btn btn-common col-5 mt-4">Continue</button>
</div>
</div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
<div class="schedule_box">
  <div class="row">
    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 ml-5">
       <img src="{{ asset('front/assets/img/featured/call-center.png')}}" height="120" width="120" alt="" class="">
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 mt-4 ml-5">
       <span class="h4 text_color">Schedule a free call with {{$teacher->first_name}}</span><br>
       <span class="font_16">Have a free call with {{$teacher->first_name}} to get to know her and relate with her. This first session is completely free</span>
    </div>
 </div>
</div>
</div>
</div>
</form>
</div>
</div>

<div id="success-booking"></div>
 
<!-- @include('front-layout.teachers-list') -->

@include('front-layout.footer')

<a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>


<script data-cfasync="false" src="{{ asset('front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script> -->

<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>

 
@endsection

 