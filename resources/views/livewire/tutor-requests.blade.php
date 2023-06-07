<div>
<div class="row mt-5">
<div class="col-lg-6 col-md-6 col-xs-6">
<div class="form-group">
<label for="subject">What subject would you like help with?</label>
<!-- <input type="text" class="form-control mt-1" placeholder="Enter Your Subject" wire:model.lazy='subject'> -->
<select wire:model.lazy="subject" id="subject" class="custom-select">
<option value="">Select subjects</option>
<option value="Mathematics">Mathematics</option>
<option value="English">English</option>
<option value="Biology">Biology</option>
<option value="Physics">Physics</option>
<option value="Civic Education">Civic Education</option>
<option value="Verbal Reasoning">Verbal Reasoning</option>
<option value="Quantitative Reasoning">Quantitative Reasoning</option>
<option value="Chemistry">Chemistry</option>
<option value="History">History</option>
<option value="Social">Social Studies</option>
<option value="Art">Art</option>
<option value="Computer Science">Computer Science</option>
</select>
@error('subject') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror

</div>
<div class="form-group">
<label for="subject">And which level are you looking for?</label>
<select  wire:model.lazy="level" id="level" class="custom-select mt-1">
<option value="">Select level</option>
@foreach ($categories as $levels)
<option value="{{$levels->title}}">{{$levels->title}}</option>  
@endforeach
</select>
@error('level') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>
 
<div class="form-group">
<label class="form-label">What’s your main goal?</label><br>
<div class="col-md-12 row btn-group mt-1">
<input type="radio" class="form-check" wire:model.lazy="goal" value="Improve grade" id="goal-1">
<label class="btn btn-common label_check col-sm-" for="goal-1">IMPROVE GRADES</label>
<input type="radio" class="form-check"  wire:model.lazy="goal" value="Prep for exams" id="goal-2">
<label class="btn btn-common label_check col-sm-" for="goal-2">PREP FOR EXAMS</label>
<input type="radio" class="form-check" wire:model.lazy="goal" value="Boost confidence" id="goal-3">
<label class="btn btn-common label_check col-sm-" for="goal-3">BOOST CONFIDENCE</label>
</div>
@error('goal') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>
 
<div class="form-group">
<label class="form-label">How often would you like lessons?</label><br>
<div class="col-md-12 row btn-group mt-1">
<input type="radio" class="form-check"  wire:model.lazy="often" value="Once a week" id="often-1">
<label class="btn btn-common label_check" for="often-1">ONCE A WEEK</label>
<input type="radio" class="form-check" wire:model.lazy="often" value="Twice a week" id="often-2">
<label class="btn btn-common label_check" for="often-2">TWICE A WEEK</label>
<input type="radio" class="form-check"  wire:model.lazy="often" value="I will decide later" id="often-3">
<label class="btn btn-common label_check" for="often-3">I’LL DECIDE LATER</label>
</div><br>
@error('often') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

<div class="form-group row ml-0">
<label class="form-label">How much would you like to spend?</label><br>
<div class="col-md-12 row btn-group mt-1">
<input type="radio" class="form-check" wire:model.lazy="price" value="20k - 29k" id="price-1">
<label class="btn btn-common label_check" for="price-1">₦20k - ₦29kK</label>
<input type="radio" class="form-check" wire:model.lazy="price" value="30k - 39k" id="price-2">
<label class="btn btn-common label_check" for="price-2">₦30k - ₦39K</label>
<input type="radio" class="form-check" wire:model.lazy="price" value="40k - 50K" id="price-3">
<label class="btn btn-common label_check" for="price-3">₦40k - ₦50K</label>
<input type="radio" class="form-check" wire:model.lazy="price" value="I will decide late" id="price-4">
<label class="btn btn-common label_check" for="price-4">I’LL DECIDE LATER</label>
</div>
@error('price') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

 

<div class="form-group row">
<label class="ml-3">When is a good time to have a free meeting with your tutor?</label>
<div class="col-sm-6">
<input type="date" class="form-control mt-1"  wire:model.lazy='day'>
@error('day') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>
<div class="col-sm-6">
<input type="time" class="form-control mt-1"  wire:model.lazy='time'>   
@error('time') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>
</div>

 

<div class="form-group">
<label class="form-label">Any gender preference?</label><br>
<div class="col-md-12 row btn-group mt-1">
<input type="radio" class="form-check"  wire:model.lazy="gender" value="Male" id="gender-1">
<label class="btn btn-common label_check" for="gender-1">MALE</label>
<input type="radio" class="form-check"  wire:model.lazy="gender" value="Female" id="gender-2">
<label class="btn btn-common label_check" for="gender-2">FEMALE</label>
<input type="radio" class="form-check"  wire:model.lazy="gender" value="I don't mind" id="gender-3">
<label class="btn btn-common label_check" for="gender-3">I DON’T MIND</label>
</div><br>
@error('gender') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

<div class="form-group">
<label for="subject">Is there anything else we should know?</label>
<textarea type="text" rows="5" cols="" class="form-control mt-1"  wire:model.lazy='note'></textarea>
<span>Have a particular learning style? Want to focus on a particular topic? Any target grades in mind? Let us know!</span> <br>
@error('note') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

<h4>Your contact details</h4>
<!-- <p class="">Our tutor expert team will get back to you within the hour. We’ll then help you sort a free 15 minute meeting (in our lesson space) so you can get to know them before booking any lessons.</p> -->


<div class="form-group mt-5">
<label for="subject">Full name</label>
<input type="text" wire:model.lazy="full_name" class="form-control mt-1" plaaceholder="Type your full name">
@error('full_name') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>
<div class="form-group">
<label for="subject">Email</label>
<input type="text" wire:model.lazy="email" class="form-control mt-1" plaaceholder="Type your Email">
@error('email') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

<div class="form-group">
<label for="subject">Phone number</label>
<input type="text" wire:model.lazy="phone" class="form-control mt-1" plaaceholder="Type your phone number">
@error('phone') <span class="text-danger font_13 text-capitalize">{{$message}}</span> @enderror
</div>

<div class="form-group row">
<div class="col-sm-6">
<button wire:click.prevent="store" class="btn btn-common">Submit request</button>
</div>
<div class="col-sm-6">
@if(Session::has('message'))
<div class="alert alert-success">
<p class="text-capitalize font_14"> {{Session::get('message')}} <i class="lni-check"></i></p> 
</div>
@endif
</div>
</div>
</div>

@if ($subject || $level || $often ||$price || $goal ||$time ||$day ||$gender ||$note)
<div class="col-xl-6 col-lg-6 col-md-6 mt-3 fixed_display">
<div class="card">
<h4 class="font_17 text-black">Tutor request summary</h4>  
@endif 
<div class="mt-3">
@if ($subject)
<span class="explore-sub-hero">{{$subject}}</span><br>
<span class="">Subject</span><br>
@endif
@if ($level)
<span class="explore-sub-hero">{{$level}}</span><br>
<span class="">Level</span><br>
@endif
@if ($goal)
<span class="explore-sub-hero">{{$goal}}</span><br>
<span class="">Goal</span><br>
@endif
@if ($often)
<span class="explore-sub-hero">{{$often}}</span><br>
<span class="">Frequency</span><br>
@endif
 
@if ($price)
<span class="explore-sub-hero">{{$price}}</span><br>
<span class="">Price</span><br>
@endif
@if ($day || $time)
<?php $dateformat = new DateTime($day); ?>
<span class="explore-sub-hero">{{$dateformat->format('l')}}, {{$dateformat->format('d')}} {{$dateformat->format('F')}} {{$dateformat->format('Y') }}, </span>
<span class="explore-sub-hero"> {{date('h:i a', strtotime($time))}}</span><br>
<span class="">Availability</span><br>
@endif
@if ($gender)
<span class="explore-sub-hero">{{$gender}}</span><br>
<span class="">Gender</span><br>
@endif
@if ($note)
<span class="explore-sub-hero">{{$note}}</span><br>
<span class="">Note</span><br>
@endif
</div> 
</div>
</div>


</div>
</div>
