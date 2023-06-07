@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.app')
@section('body')

<header id="header-wrap" style="margin-top:%">
@include('front-layout.top-nav')
</header>

<div class="main-container section-padding mt-5">
<div class="container">
<div class="text-left">
<a href="{{ route('explore')}}" class="normal_link">back</a>
</div>
@include('back-layout.error')
<!-- aside start -->
<div class="row">
<div class="col-lg-3 col-md-3 col-xs-3 page-sidebar">
<aside>
<div class="widget">
<div class="mt-4 text-center">
<img class="img-fluid image_fit" src="{{ asset($personal_info->profile_photo)}}" height="173" width="241" alt="image">
</div>
<div class="text-center mt-3">
<h5 class="text_color">{{$teacher->first_name ." ".$teacher->last_name}}</h5>
<p class="">{{$personal_info->town . ",". $personal_info->state}}</p>
<h5 class="mt-2 text_color">₦{{number_format($hourly_pay->amount)}} / hr</h5>
</div>
<div class="mt-4 card-body">
<p class="text_color text_header">Subjects</p>
<p class="mt-1">@foreach (json_decode($subjects->title) as $subject) {{$subject}}, @endforeach</p>
</div>
<div class="mt-2 card-body">
<p class="text_color text_header">Schedules</p>
@foreach ($schedules as $schedule)
<p class="mt-1">
@if ($schedule->day == 1) Monday: @elseif ($schedule->day == 2) Tuseday: @elseif ($schedule->day == 3) Wednesday: @elseif ($schedule->day == 4) Thursday:
@elseif ($schedule->day == 5)  Friday:  @elseif ($schedule->day == 6)  Saturday: @elseif ($schedule->day == 0)  Sunday:  @endif
 <span class="">{{date('h:i a', strtotime($schedule->from)).' - '.date('h:i a' , strtotime($schedule->to))}}</span></p> 
@endforeach
</div>
<div class="mt-2 card-body">
   <a href="{{ route('bookings',$teacher->id)}}" class="btn btn-common col-11">Book {{$teacher->first_name}}</a>
</div>
<div class="card-body mt-2">
<p class="text_color text_header">Resources posted </p>
<div class="texr-center mt-2">
   <p class="font-12">No Resources Found!</p> 
</div>
</div>
</div>
</aside>
</div>
<!-- aside ends -->

 <!-- contents -->
<div class="col-lg-5 col-md-5 col-xs-5 page-content">
<div class="row">
<div class="container ml-2">
<div class="video_text text-center">
<p class="text-left h5 text_color">Personal Introduction</p>
<video class="video_size mt-4" src="{{ asset($pro_infos->onboading_video)}}" height="260" width="500" controls></video>
</div>

<div class="mt-5">
<p class="h5 text_color">About</p>
<p class="mt-3">{{$pro_infos->about}}</p>
</div><hr>
<div class="mt-5">
<p class="h5 text_color">Experiences</p>
<p class="mt-3">{{$pro_infos->experience}}</p>
</div><hr>


@php $countq = 1;@endphp
<div class="mt-3">
@foreach ($educations as $education)
@if ($education->visible == 1)
<div class="row">
<div class="col-md-5">
<p class="h5 text_color">Education {{$countq++}}</p>
    <img src="{{ asset($education->upload_file)}}" height="67" width="67" alt="logo">
</div>
<div class="col-md-6 mt-4">
<p class="ml-2 h6">{{$education->university}}</p>
<p class="ml-2 mt-2 h6">{{$education->degree}}</p>
<p class="ml-2 mt-2 h6">{{$education->passing_year}}</p>
</div>
</div>
@endif
@endforeach
</div><hr>

<div class="">
@php $countc = 1;@endphp
@foreach ($certifications as $certification)
@if ($certification->visible == 1)
<div class="row mb-4">
<div class="col-md-5"> 
<div class="">
<p class="h5 text_color">Certifications {{$countc++}}</p>
    <img class="image_fit" src="{{ asset($certification->upload_file)}}" height="67" width="67" alt="image">
</div>
</div>
<div class="col-md-6 mt-4">
<p class="ml-2 mt-2 h6">{{$certification->title}}</p>
<p class="ml-2 mt-2 h6">{{$certification->description}}</p>
<p class="ml-2 mt-2 h6">{{$certification->issued}}</p>
<div class="ml-2 mt-2">
    <a href="{{ asset($certification->upload_file)}}" class="btn btn-outline-secondary link-radius" >Show Certificate</a>
</div>
</div>
</div>
@endif
@endforeach
</div>
</div> 
</div>
</div>
<!-- contents ends -->
<div class="col-lg-4 col-md-4 col-xs-4 page-content">
<div class="text-center">
 <h6 class="text_color text_header ml-5">Ratings & Recommendations</h6>
</div>
@if ($recommendations->count() == 0)
<div class="text-center ml-5 mt-3">
  <p class=""> No Recommendation yet!</p>
</div>
@else
@foreach($recommendations as $recommendation)
@php
$info = App\Models\PersonalInformation::where('user_id',$recommendation->user_id)->with('user')->first();
@endphp
<div class="row mt-5">
<div class="col-4">
 <img class="ml-5" src="{{ asset($info->profile_photo)}}" height="58" width="60" alt="image">
</div>
<div class="col-8">
<div class="listing-bottom">
<h4 class="float-left text_color font-s"> {{$recommendation->user->first_name." ".$recommendation->user->last_name}}</h4>
<h5 class="float-right text_color"><i class="lni-star-filled text-warning"></i> {{$recommendation->star}}.0</h5>
</div><br> 
<div class="">
<h6 class="text_color mt-3">{{$recommendation->title}}!</h6>
<p>{{substr($recommendation->message,0,150)}}...</p>
</div> 
</div>
</div>
@endforeach
@endif
</div>
</div>
<!-- similar teachers -->
<section class="section-padding">
<div class="">
<h5 class="text_color">Similar Suggestions for Teachers</h5>
</div>
<div class="mt-3">
<div class="row text-capitalize">
@foreach ($similar_teachers->chunk(20) as $group)
@foreach ($group as $teacher)
@php
$hourly_pay = App\Models\HourlyPay::where('user_id',$teacher->id)->with('user')->first();
$personal_info = App\Models\PersonalInformation::where('user_id',$teacher->id)->with('user')->first();
$subjects = App\Models\Subjects::where('user_id',$teacher->id)->with('user')->first();
$pro_info = App\Models\ProfessionalInformation::where('user_id',$teacher->id)->with('user')->first();
$average_rating = App\Models\Rating::where('user_id',$teacher->id)->first();
$total_response = ($average_rating->one_star + $average_rating->two_star + $average_rating->three_star + $average_rating->four_star + $average_rating->five_star);
@endphp
<div class="col-lg-custom">
<div class="featured-box">
<figure>
<a href="{{ route('details',$teacher->id)}}"><img class="img-fluid explore-image-card flex_fit" src="{{ asset($personal_info->profile_photo)}}" alt="image"></a>
</figure>
<div class="feature-content flext_width">
<div class="listing-bottom text-capitalize">
<h7 class="float-left text_color font-14">{{substr($teacher->first_name." ".$teacher->last_name,0,17)}}</h7>
<p class="float-right font-14"> <i class="lni-star-filled text-warning"></i> {{$average_rating->average}}.0({{$total_response}})</p>
</div>
<div class="listing-bottom">
<p class="float-left font-14">@foreach(json_decode($subjects->title) as $subject) {{substr($subject,0,9)}}.. @break @endforeach</p>
<p class="float-right font-14">₦{{$hourly_pay->amount}}/hr</p>
</div><br>
<?php $trim_text = str_replace(array('\'','"','/',':'), ' ', $pro_info->about); ?>
<p class="dsc font-14">{!!substr($trim_text,0,100)!!} ... </p>
<div class="mt-2 text-capitalize">
<p class="float-left"> <img src="{{ asset('front/assets/img/icons/location.svg')}}" alt="location"> {{$personal_info->town .", ". $personal_info->state}}</p>
<!-- <p class="text_color float-right"><i class="lni-heart-filled"></i></p> -->
</div>

</div>
</div>
</div>
@endforeach
@endforeach
</div> 
 
</div>

</section>

</div>
</div>


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
<!-- <script src="{{ asset('front/assets/js/popper.min.js')}}"></script> -->
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
 
<!-- <script src="{{ asset('front/assets/js/jquery.counterup.min.js')}}"></script> -->
<script src="{{ asset('front/assets/js/waypoints.min.js')}}"></script>
<!-- <script src="{{ asset('front/assets/js/wow.js')}}"></script> -->
 
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
 
 

@endsection