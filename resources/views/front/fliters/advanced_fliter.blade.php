<div class="row text-capitalize" id="fliter">
<div class="mt-4">
<h4 class="col-sm-12"> ( {{$teachers->total()}} ) {{$keyword}} <span class="font_17 text-gray lowercase">  tutors available</span></h4>
</div>
@if ($teachers->count() == 0)
<h4 class="mt-5 col-sm-12">NO Tutor Found!</h4> 
@else

@foreach ($teachers->chunk(10) as $group)
@foreach ($group as $teacher)

@if ($teacher->user->is_verified == 1)
<?php
$user_id = $teacher->user_id;
$user = App\Models\User::where('id',$user_id)->first();
$subjects = App\Models\Subjects::where('user_id',$teacher->user_id)->with('user')->first();
$hourly_pay = App\Models\HourlyPay::where('user_id',$user_id)->with('user')->first();
$personal_info = App\Models\PersonalInformation::where('user_id',$user_id)->with('user')->first();
$pro_info = App\Models\ProfessionalInformation::where('user_id',$user_id)->with('user')->first();
$average_rating = App\Models\Rating::where('user_id',$user_id)->first();
$total_response = ($average_rating->one_star + $average_rating->two_star + $average_rating->three_star + $average_rating->four_star + $average_rating->five_star);
?>
<!-- <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"> -->
<div class="featured-box">
<a href="{{ route('details',$user_id)}}" style="color:gray">
<div class="feature-content flext_width">
<div class="row">
<div class="col-sm-3">
 <img class="img-fluid explore-image-card flex_fit" src="{{ asset($personal_info->profile_photo)}}"  alt="image">
</div>
<div class="col-sm-6">
<div class="listing-bottom">
<h5 class="explore-hero">{{$user->first_name.' '.$user->last_name}}</h5>
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
<p class="ml-3">@foreach (json_decode($subjects->levels) as $level) {{$level}}, @endforeach</p>
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
<!-- <div class="pagination-bar">
<nav>
<ul class="pagination float-right">
<li class="page-item ">{{$teachers->links()}} </li>
</ul>
</nav>
</div> -->
</div>