 <div class="search-button">
<div class="container">
<div class="search-panel">
<div class="col-md-8 col-lg-8 col-xs-8">
<h3 class="hero-heading">Hire the best teachers <br> For your children</h3>
<p class="hero-sub-heading mb-5">Work with the best teachers on our secure, flexible and cost-effective <br> Platform, whilst providing convenience and empowerment.</p>
<div class="search-ba">
<div class="col-xs-12">
<form action="{{ route('search-subject')}}" class="search-form" method="POST">
@csrf
<div class="form-group row">
<input type="text" name="customword" class="form-control search_box col-md-7" placeholder=" What subjects are you looking for?">
<button class="btn btn-dark col-md-3 ml-2 button_box" type="submit"> Search</button>
<div class="row recent_search">
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Mathematics'])}}" class="btn btn-outline-secondary secondary mt-3 ml-2 text-white link-radius">Mathematics</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'English'])}}" class="btn btn-outline-secondary secondary mt-3 ml-2 text-white link-radius">English</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Social studies'])}}" class="btn btn-outline-secondary secondary mt-3 ml-2 text-white link-radius">Social studies</a>
<a href="{{ route('fliter-page',['model'=>'subject','search'=>'Verbal Reasoning'])}}" class="btn btn-outline-secondary secondary mt-3 ml-2 text-white link-radius">Verbal Reasoning</a>
</div> 
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
 