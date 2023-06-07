@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.body')
@section('content')
<!-- Featured Teachers -->
<section class="featured section-padding">
<div class="container">
<h1 class="section-title text-left">Our Featured Teachers</h1>
<div class="row text-capitalize">
@foreach ($teachers->chunk(4) as $group)
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
<a href="{{ route('details',$teacher->id)}}"><img class="img-fluid flex_margin explore-image-card" src="{{ asset($personal_info->profile_photo)}}" alt="image"></a>
</figure>
<div class="feature-content flext_width">
<div class="listing-bottom">
<h6 class="float-left text_color font-14">{{substr($teacher->first_name." ".$teacher->last_name,0,17)}}</h6>
<p class="float-right font-14"><i class="lni-star-filled text-warning"></i>{{$average_rating->average}}.0 ({{$total_response}})</p>
</div>
<div class="listing-bottom">
<h6 class="float-left font-14">@foreach(json_decode($subjects->title) as $subject) {{substr($subject,0,17)}} @break @endforeach</h6>
<p class="float-right font-14">₦{{$hourly_pay->amount}}/hr</p>
</div><br>
<?php $trim_text = str_replace(array('\'','"','/',':'), ' ', $pro_info->about); ?>
<p class="dsc font-14">{!!substr($trim_text,0,100)!!} ... </p>
<!-- <p class="dsc">{{substr($pro_info->about,0,100)}}...</p> -->
<div class="mt-2">
<p class="float-left"> <img src="{{ asset('front/assets/img/icons/location.svg')}}" alt="location"> {{$personal_info->town .", ". $personal_info->state}}</p>
<!-- <p class="float-right"><i class="lni-heart-filled"></i></p> -->
</div>

</div>
</div>
</div>
@endforeach
@endforeach
</div> 
 </div>
</section>
 <!-- Featured Teachers -->
 <!-- An array of expert teachers for your children -->
<section id="about" class="section-padding bg-list">
<div class="container">
<div class="row">
<div class="col-md-7 col-lg-7 col-xs-12">
<div class="about-wrapper">
<h2 class="intro-title">An array of expert teachers <br> for your children</h2>

<section class="services section-padding">
<div class="container">
<div class="row">

<div class="col-md-6 col-lg-6 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
<div class="icon">
<img src="{{ asset('front/assets/img/featured/Icon Wrap1.png')}}" height="54" width="54" alt="">
</div>
<div class="services-content">
<h3> Flexibility</h3>
<p>Pick a day and time that suits you to begin lessons with your children.</p>
</div>
</div>
</div>

<div class="col-md-6 col-lg-6 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
<div class="icon">
<img src="{{ asset('front/assets/img/featured/Icon Wrap2.png')}}" height="54" width="54" alt="">
</div>
<div class="services-content">
<h3> Protected Payments</h3>
<p>Pick a day and time that suits you to begin lessons with your children.</p>
</div>
</div>
</div>

<div class="col-md-6 col-lg-6 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
<div class="icon">
<img src="{{ asset('front/assets/img/featured/Icon Wrap3.png')}}" height="54" width="54" alt="">
</div>
<div class="services-content">
<h3> Budget Friendly</h3>
<p>Pick a day and time that suits you to begin lessons with your children.</p>
</div>
</div>
</div>

<div class="col-md-6 col-lg-6 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
<div class="icon">
<img src="{{ asset('front/assets/img/featured/Icon Wrap4.png')}}" height="54" width="54" alt="">
</div>
<div class="services-content">
<h3>Quality Teaching</h3>
<p>Pick a day and time that suits you to begin lessons with your children.</p>
</div>
</div>
</div>
</div>
</div>
</section>
 </div>
</div>
<div class="col-md-5 col-lg-5 col-xs-12 image_grid" style="">
<img class="img-fluid" src="{{ asset('front/assets/img/landing_page/teachers.png')}}" alt="image">
</div>
</div>
</div>
</section>
 <!-- An array of expert teachers for your children -->

 <!-- how it works -->
<section class="works section-padding">
<div class="container">
<div class="row">
<div class="col-12">
<h3 class="section-title">How Olukotide works?</h3>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="">
<img class="img-fluid" src="{{ asset('front/assets/img/works/subject.jpg')}}" alt="image">
</div>
<p><span class="mr-4 step-1">1</span>Select a Subject</p>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="">
<img class="img-fluid" src="{{ asset('front/assets/img/works/teacher.jpg')}}"   alt="image">
</div>
<p><span class="mr-4 step-2">2</span>Book your Teacher</p>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="">
<img class="img-fluid" src="{{ asset('front/assets/img/works/start.jpg')}}"   alt="image">
</div>
<p><span class="mr-4 step-3">3</span>Get started with your Teacher</p>
</div>
</div>
<hr class="works-line">
</div>
</div>
<div class="text-center post-btn mt-5">
<a class="btn btn-common" href="{{ route('choose-profile')}}">  Get Started</a>
</div>
</section>
<!-- how it works -->



 <!-- Explore Subjects starts here -->
<section class="categories-icon bg-custom section-padding">
<div class="container">
<h3 class="section-title text-left text-white mb-5">Explore Subject We Offer</h3>
<div class="row">
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
 <img class="img-fluid" src="{{ asset('front/assets/img/icons/icon1.png')}}" height="50" width="50" alt="image">
</div>
<h4>Mathematics</h4>
</div>
</div>

<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon2.png')}}" height="50" width="50" alt="image">
</div>
<h4>Quantitative Reasoning</h4>
</div>
 
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon3.png')}}" height="50" width="50" alt="image">
</div>
<h4>Verbal Reasoning</h4>
</div>
 </div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon4.png')}}" height="50" width="50" alt="image">
</div>
<h4>Social Studies</h4>
</div>
 
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon5.png')}}" height="50" width="50" alt="image">
</div>
<h4>Biology</h4>
</div>
 </div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon6.png')}}" height="50" width="50" alt="image">
</div>
<h4>Art</h4>
</div>
 </div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
 <div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon7.png')}}" height="50" width="50" alt="image">
</div>
<h4>Chemistry</h4>
</div>
 </div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon8.png')}}" height="50" width="50" alt="image">
</div>
<h4>Physics</h4>
</div>
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon9.png')}}" height="50" width="50" alt="image">
</div>
<h4>Civic Education</h4>
</div> 
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon10.png')}}" height="50" width="50" alt="image">
</div>
<h4>History</h4>
</div>
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon11.png')}}" height="50" width="50" alt="image">
</div>
<h4>Moral instruction</h4>
</div>
</div>
<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
<div class="icon-box">
<div class="icon">
<img class="img-fluid" src="{{ asset('front/assets/img/icons/icon12.png')}}" height="50" width="50" alt="image">
 
</div>
<h4>Computer Science</h4>
</div>
</div>
</div>
</div>
<div class="text-center">
<a href="{{ route('choose-profile')}}" class="btn btn-outline-secondary btn-sm">sign up for free</a>
</div>

</section>
 <!-- Explore Subjects starts here -->

  <!-- Students Outcome -->
@include('front-layout.outcomes')
 <!-- Students Outcome -->

<!-- Teacher’s list -->
@include('front-layout.teachers-list')
  <!-- Teacher’s list -->

@endsection