@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.app')
@section('body')

@include('front-layout.top-nav')

<div class="main-container section-padding">
<div class="container">
<div class="text-left">
<h4 class="mt-5">Subject tutors that fit your schedule</h4>
<p class="mb-5  text_secondary">Find your perfect subject tutor and arrange a Free Video Meeting. Then book one-to-one Online Lessons to fit your schedule.</p>
</div>

<div class="">
<!-- <h5 class="text_secondary">Home > Explore</h5>  -->
<div class="mt-2 card">
<form action="" class="">
<div class="row">

<div class="form-group col-sm-3">
<label for="">Subjects</label>
<select name="" id="subject" class="custom-select">
<option disabled selected>select subject</option>
<option value="">All subjects</option>
<option value="Mathematics">Mathematics</option>
<option value="English">English</option>
<option value="Biology">Biology</option>
<option value="Physics">Physics</option>
<option value="Civic Education">Civic Education</option>
<option value="Verbal Reasoning">Verbal Reasoning</option>
<option value="Quantitative Reasoning">Quantitative Reasoning</option>
<option value="Chemistry">Chemistry</option>
<option value="History">History</option>
<option value="Social Studies">Social Studies</option>
<option value="Art">Art</option>
<option value="Computer Science">Computer Science</option>
 
</select>
</div>

<div class="form-group col-sm-3">
<label for="">Levels</label>
<select name="" id="level" class="custom-select">
<option selected disabled>Select Level</option>
<option value="">All levels</option>
@foreach ($categories as $levels)
  <option value="{{$levels->id}}">{{$levels->title}}</option>  
@endforeach
</select>
</div>

<div class="form-group col-sm-3">
<label for="">Price</label>
<select name="" id="price" class="custom-select">
<option selected disabled>Select Prices</option>
<option value="">All Prices</option>
<option  value="10000">₦{{ number_format(10000)}} /hr</option>
<option  value="15000">₦{{ number_format(15000)}} /hr</option>
<option  value="20000">₦{{ number_format(20000)}} /hr</option>
<option  value="25000">₦{{ number_format(25000)}} /hr</option>
<option  value="30000">₦{{ number_format(30000)}} /hr</option>
<option  value="35000">₦{{ number_format(35000)}} /hr</option>
<option  value="40000">₦{{ number_format(40000)}} /hr</option>
<option  value="45000">₦{{ number_format(45000)}} /hr</option>
<option  value="50000">₦{{ number_format(50000)}} /hr</option>
</select>
</div>
<div class="ml-5 col-sm-2 mt-4">
<a class="dropdown fliter_color" data-toggle="collapse" href="#more" role="button" aria-expanded="false" aria-controls="more">
More Fliter  <i class="float-right lni-chevron-down"></i>
</a>
</div>

<div class="collapse col-sm-12" id="more">
<div class="row">
<div class="form-group col-sm-3">
<label for="">Gender</label>
<select name="" id="gender" class="custom-select">
<option selected disabled>Select Gender</option>
<option value="">All Gender</option>
<option value="male"> Male </option>
<option value="female"> Female </option>
</select>
</div>
<div class="form-group col-sm-3">
<label for="">Availability</label>
<select name="" id="day" class="custom-select">
<option selected disabled>Select availability</option>
<option value="">All availability</option>
<option value="Monday"> Monday </option>
<option value="Tuesday"> Tuesday </option>
<option value="Wednesday"> Wednesday </option>
<option value="Thursday"> Thursday </option>
<option value="Friday"> Friday </option>
<option value="Saturday"> Saturday </option>
<option value="Sunday"> Sunday </option>
</select>
</div>
</div>
</div> 
</div>
</form>
</div> 
</div>


<div class="row">
 <!-- contents -->
<div class="col-lg-8 col-md-8 col-xs-8 page-content">

<!-- show fliters -->
<div class="fliter" id="show_fliter"></div>
<!-- show fliter ends -->

<div class="row text-capitalize" id="explore">
<div class="mt-4">
<h4 class="col-sm-12"> ( {{$teachers->total()}} ) {{$keyword}} <span class="font_17 text-gray lowercase">  tutors available</span></h4>
</div>
@if ($teachers->count() == 0)
<h4 class="mt-5 col-sm-12">NO Tutor Found!</h4> 
@else

@foreach ($teachers->chunk(10) as $group)
@foreach ($group as $teacher)

@if ($teacher->user->is_verified == 1)

@php
$hourly_pay = App\Models\HourlyPay::where('user_id',$teacher->user_id)->with('user')->first();
$personal_info = App\Models\PersonalInformation::where('user_id',$teacher->user_id)->with('user')->first();
$subjects = App\Models\Subjects::where('user_id',$teacher->user_id)->with('user')->first();
$pro_info = App\Models\ProfessionalInformation::where('user_id',$teacher->user_id)->with('user')->first();
$average_rating = App\Models\Rating::where('user_id',$teacher->user_id)->first();
$total_response = ($average_rating->one_star + $average_rating->two_star + $average_rating->three_star + $average_rating->four_star + $average_rating->five_star);
@endphp
<!-- <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> -->
<div class="featured-box">
<a href="{{ route('details',$teacher->user_id)}}" style="color:gray">
<div class="feature-content flext_width">
<div class="row">
<div class="col-sm-3">
 <img class="img-fluid explore-image-card flex_fit" src="{{ asset($personal_info->profile_photo)}}"  alt="image">
</div>
<div class="col-sm-6">
<div class="listing-bottom">
<h5 class="explore-hero">{{$teacher->first_name.' '.$teacher->last_name}}</h5>
<p class="explore-sub-hero">@foreach(json_decode($subjects->title) as $subject) {{$subject}}, @endforeach</p>
<?php $trim_text = str_replace(array('\'','"','/',':'), ' ', $pro_info->about); ?>
<p class="dsc mt-2">{!!substr($trim_text,0,100)!!} ... </p>
</div>
<div class="mt-2 text-capitalize">
<p class="float-left"> <img src="{{ asset('front/assets/img/icons/location.svg')}}" alt="location"> {{$personal_info->town .", ". $personal_info->state}}</p>
</div>
</div>
 
<div class="col-sm-2 listing-bottom mt-4 float-right ml-5">
<h4 class="ml-3"><i class="lni-star-filled text-warning"></i>  {{$average_rating->average}}.0({{$total_response}})</h4>
<h4 class="mt-3 ml-3">₦{{number_format($hourly_pay->amount)}}/hr</h4>
<p class="ml-3">{{$teacher->category->title}}</p>
</div>
</div>
</div>
</a>
</div>
<!-- </div> -->
@endif
@endforeach
@endforeach
@endif
</div> 
<div class="pagination-bar">
<nav>
<ul class="pagination float-right">
<li class="page-item ">{{$teachers->links()}} </li>
</ul>
</nav>
</div>
</div>

<!-- contents ends -->
<!-- aside start -->
<div class="col-lg-4 col-md-4 col-xs-4 page-sidebar">
<div class="card mt-3 text-center">
<img src="{{ asset('front/assets/img/featured/geology-study.png')}}" class="image_fit mr-4" height="200" width="300" alt="">
<h4 class="explore-hero mt-3">Looking for something specific?</h4>
<p class="mt-2">Fill out the online form and one of our tutor experts will be in touch with a shortlist of tutors for you.</p>
<a href="#" class="btn btn-common mt-3">Find me a tutor</a>
<p class="mt-3">Or contact us on at<span class="text-info"> hello@olukotide.com</span></p>
</div>
</div>
<!-- aside ends -->
</div>
</div>


</div>
 
@include('front-layout.outcomes')
@include('front-layout.teachers-list')
@include('front-layout.footer')


<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/advanced_fliter.js')}}"></script>
@endsection