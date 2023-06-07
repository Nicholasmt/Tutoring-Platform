@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.body')
@section('content')

<div class="main-container section-padding">
<div class="container">
<div class="text-left">
<h4 class="mt-5">Our Teachers</h4>
<p class="mb-5 col-7 text_secondary font-20">Work with the best teachers on our secure, flexible and cost-effective platform, whilst providing convenience and empowerment.</p>
</div>
<!-- aside start -->
<div class="row">
 <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
<aside>
<div class="widget categories">
<h4 class="widget-title"><img src="{{ asset('front/assets/img/featured/sliders.png')}}" height="22" width="22" class="mr-2" alt="">  Filters <span class="float-right">  x </span></h4>
<ul class="categories-list">

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#type" role="button" aria-expanded="false" aria-controls="type">
Type  <i class="float-right lni-chevron-down"></i>
</a>
</p class="text_color">
<div class="collapse" id="type">
 <a href="#" class="dropdown-item"></a> 
</div>

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#availability" role="button" aria-expanded="false" aria-controls="availability">
Availability  <i class="float-right lni-chevron-down"></i>
</a>
</p>

<div class="collapse" id="availability"> 
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'1'])}}" class="dropdown-item"> Monday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'2'])}}" class="dropdown-item"> Tuesday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'3'])}}" class="dropdown-item"> Wednesday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'4'])}}" class="dropdown-item"> Thursday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'5'])}}" class="dropdown-item"> Friday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'6'])}}" class="dropdown-item"> Saturday </a>
<a href="{{ route('fliter-page',['model'=>'availabile','search'=>'0'])}}" class="dropdown-item"> Sunday </a>
</div>

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
Categories  <i class="float-right lni-chevron-down"></i>
</a>
</p>
<div class="collapse" id="category">
@foreach ($categories as $category) 
<a href="{{ route('fliter-page',['model'=>'cat','search'=>$category->id])}}" class="dropdown-item"> {{$category->title}} </a>
@endforeach
</div>

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#subjects" role="button" aria-expanded="false" aria-controls="subjects">
Subjects  <i class="float-right lni-chevron-down"></i>
</a>
</p>
<div class="collapse" id="subjects"> 
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Mathematics'])}}" class="dropdown-item">Mathematics</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'English'])}}" class="dropdown-item">English</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Biology'])}}" class="dropdown-item">Biology</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Physics'])}}" class="dropdown-item">Physics</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Civic Education'])}}" class="dropdown-item">Civic Education</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Verbal Reasoning'])}}" class="dropdown-item">Verbal Reasoning</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Quantitative Reasoning'])}}" class="dropdown-item">Quantitative Reasoning</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Chemistry'])}}" class="dropdown-item">Chemistry</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'History'])}}" class="dropdown-item">History</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Social Studies'])}}" class="dropdown-item">Social Studies</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Art'])}}" class="dropdown-item">Art</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Computer Science'])}}" class="dropdown-item">Computer Science</a>
 
</div>

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#state" role="button" aria-expanded="false" aria-controls="state">
State  <i class="float-right lni-chevron-down"></i>
</a>
</p>
<div class="collapse" id="state">
 <a href="{{ route('fliter-page',['model'=>'state','search'=>'Lagos'])}}" class="dropdown-item">Lagos</a>
 <a href="{{ route('fliter-page',['model'=>'state','search'=>'Ogun'])}}" class="dropdown-item">Ogun</a>
 <a href="{{ route('fliter-page',['model'=>'state','search'=>'Oyo'])}}" class="dropdown-item">Oyo</a>
 <a href="{{ route('fliter-page',['model'=>'state','search'=>'Edo'])}}" class="dropdown-item">Edo</a>
 <a href="{{ route('fliter-page',['model'=>'state','search'=>'Enugu'])}}" class="dropdown-item">Enugu</a>
</div>

<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#town" role="button" aria-expanded="false" aria-controls="town">
Town  <i class="float-right lni-chevron-down"></i>
</a>
</p>
<div class="collapse" id="town">
<a href="{{ route('fliter-page',['model'=>'town','search'=>'lekki'])}}" class="dropdown-item">lekki</a>
<a href="{{ route('fliter-page',['model'=>'town','search'=>'ikeja'])}}" class="dropdown-item">ikeja</a>
<a href="{{ route('fliter-page',['model'=>'town','search'=>'ikoyi'])}}" class="dropdown-item">ikoyi</a>
<a href="{{ route('fliter-page',['model'=>'town','search'=>'agege'])}}" class="dropdown-item">Agege</a>
<a href="{{ route('fliter-page',['model'=>'town','search'=>'ojoduu'])}}" class="dropdown-item">ojoduu</a>
</div>
<p class="text_color">
<a class="nav-link dropdown fliter_color" data-toggle="collapse" href="#hourly_rate" role="button" aria-expanded="false" aria-controls="hourly_rate">
Hourly Pay  <i class="float-right lni-chevron-down"></i>
</a>
</p>
<div class="collapse" id="hourly_rate"> 
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'100'])}}" class="dropdown-item">₦100 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'200'])}}" class="dropdown-item">₦200 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'300'])}}" class="dropdown-item">₦300 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'400'])}}" class="dropdown-item">₦400 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'500'])}}" class="dropdown-item">₦500 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'600'])}}" class="dropdown-item">₦600 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'700'])}}" class="dropdown-item">₦700 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'800'])}}" class="dropdown-item">₦800 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'900'])}}" class="dropdown-item">₦900 /hr</a>
<a href="{{ route('fliter-page',['model'=>'hp','search'=>'1000'])}}" class="dropdown-item">₦1000 /hr</a>
</div>
</ul>
</div>
</aside>
</div>
<!-- aside ends -->

 <!-- contents -->
<div class="col-lg-9 col-md-12 col-xs-12 page-content">
<div class="row text-capitalize">
@foreach ($teachers->chunk(20) as $group)
@foreach ($group as $teacher)
@php
$hourly_pay = App\Models\HourlyPay::where('user_id',$teacher->id)->with('user')->first();
$personal_info = App\Models\PersonalInformation::where('user_id',$teacher->id)->with('user')->first();
$subjects = App\Models\Subjects::where('user_id',$teacher->id)->with('user')->first();
$pro_info = App\Models\ProfessionalInformation::where('user_id',$teacher->id)->with('user')->first();
$average_rating = App\Models\Rating::where('user_id',$teacher->id)->first();
$total_response = ($average_rating->one_star + $average_rating->two_star + $average_rating->three_star + $average_rating->four_star + $average_rating->five_star);
@endphp
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
<div class="featured-box">
<figure>
<a href="{{ route('details',$teacher->id)}}"><img class="img-fluid explore-image-card flex_fit" src="{{ asset($personal_info->profile_photo)}}"  alt="image"></a>
</figure>
<div class="feature-content flext_width">
<div class="listing-bottom">
<h7 class="float-left text_color font-14">{{substr($teacher->first_name,0,10)}}</h7>
<p class="float-right font-14"><i class="lni-star-filled text-warning"></i>{{$average_rating->average}}.0({{$total_response}})</p>
</div>
<div class="listing-bottom">
<p class="float-left font-14">@foreach(json_decode($subjects->title) as $subject) {{substr($subject,0,9)}}.. @break @endforeach</p>
<p class="float-right font-14">₦{{$hourly_pay->amount}}/hr</p>
</div><br>
<?php $trim_text = str_replace(array('\'','"','/',':'), ' ', $pro_info->about); ?>
<p class="dsc">{!!substr($trim_text,0,100)!!} ... </p>
<div class="mt-2 text-capitalize">
<p class="float-left"> <img src="{{ asset('front/assets/img/icons/location.svg')}}" alt="location"> {{$personal_info->town .", ". $personal_info->state}}</p>
</div>

</div>
</div>
</div>
@endforeach
@endforeach
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
</div>
</div>
</div>








@include('front-layout.outcomes')
@include('front-layout.teachers-list')
@endsection