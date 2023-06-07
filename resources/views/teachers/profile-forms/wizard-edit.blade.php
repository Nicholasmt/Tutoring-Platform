@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/main.css')}}"> -->
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="">
          <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
        </div>
        <a href="{{ route('teachers-form1')}}" class="btn mt-5 h5"><i class="fa fa-angle-left"></i> back</a>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="card">
              <div class="auth-header text-left mt-4 ml-4">
              @include('back-layout.error')
                <h4>Continue filling out your form</h4>
              </div>
               <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="mt-2">
                  <div class="card-body">
                    <form action="{{ route('teachersform-updates.update',['form_update'=>$user->id])}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')
                     <div id="wizard_horizontal">
                      <h2 class="wizard_radius">Personal Information</h2>
                      <section>
                      <!-- Personal Information start-->
                     <div class="card-body">
                      <form action="{{ route('teachersform-updates.update',['form_update'=>$personal_infos])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text_color">
                            <h4>Personal Information</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                        </div>
                        <div class="row mt-5">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{$personal_infos->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="state" value="{{$personal_infos->state}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" value="{{$personal_infos->phone}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Means of Identifcation</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="means_of_ID">
                                <a class="btn btn-outline-secondary mt-3 link-radius" href="{{ asset($personal_infos->means_of_ID)}}">view file</a>
                            </div>
                        </div>

                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Town</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="town" value="{{$personal_infos->town}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="country" value="{{$personal_infos->country}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="d_o_b" value="{{$personal_infos->d_o_b}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Profile Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="profile_photo" >
                                <p class="text-danger">Note: Photo must not be greater than 5mb</p>
                                <a class="btn btn-outline-secondary link-radius" href="{{ asset($personal_infos->profile_photo)}}">view file</a>
                            </div>
                          </div>
                        </div>
                       </div>
                       <div class="card-footer text-right">
                            <input type="submit" name="personal_btn" class="btn btn-primary" value="Update personal information"> 
                      </div>
                     </div>
                    </form>
                    <div class="card-footer text-left">
                        <!-- <a href="{{ route('redirect')}}" class="btn btn-outline-secondary">Skip to Dashboard <i class="fa fa-arrow-right"></i></a> -->
                    </div>
                    </section>
                     <!-- Personal Information Ends-->
                     <!-- Professional Information start-->
                      <h2>Professional Info</h2>
                      <section>
                      <div class="card-body">
                        <form action="{{ route('teachersform-updates.update',['form_update'=>$pro_infos])}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                        <div class="text_color">
                            <h4>Professional Information</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                         <div class="row mt-5">
                            <div class="col-md-12">
                               <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Tell us about you:</label>
                                 <div class="col-sm-9">
                                    <textarea name="about" class="form-control" cols="80" rows="5" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you. Tell us about your teaching strategies and what your pupils/students can expect from you.">{{$pro_infos->about}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Experiences:</label>
                                 <div class="col-sm-9">
                                    <textarea name="experience" class="form-control" cols="80" rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others.">{{$pro_infos->experience}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Onboading video:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" name="onboading_video">
                                     <p class="text-danger">Note: Video duration must not be more than 1 minute</p>
                                     <a class="btn btn-outline-secondary link-radius" href="{{ asset($pro_infos->onboading_video)}}">view file</a>
                                 </div>
                              </div>
                              <div class="text-right">
                                 <div class="mb-4">
                                     <input type="submit" class="btn btn-primary" value="update professional information" name="professional_btn" >
                                 </div>
                              </div>
                            </div>
                           </div>
                         </form>
                        </div>
                      </section>
                      <!-- Professional Information Ends-->
                      <!-- Education start-->
                      <h2>Education</h2>
                      <section>  
                      <div class="card-body">
                        <div class="text_color">
                           <h4>Education</h4>
                           <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                         <!-- Qualification start -->
                            <?php $qualify = 1; ?>
                            
                            @foreach($educations as $education)
                             <form action="{{ route('teachersform-updates.update',['form_update'=>$education])}}" method="POST" enctype="multipart/form-data">
                               @csrf
                               @method('PUT')
                               <div class="mt-4">
                                 <h3>Qualification {{$qualify++}}</h3>
                              </div>
                              <div class="row mt-5">
                                <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$education->university}}" name="university">
                                    </div>
                                </div>
                               <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                    <select name="result" class="custom-select" id="inputGroupSelect05">
                                          <option value="First class" @if(old('education.0.result') == 'First class') selected @endif>First class</option> 
                                          <option value="Second class" @if(old('education.0.result') == 'Second class') selected @endif>Second class</option>  
                                          <option value="Third Class" @if(old('education.0.result') == 'Third Class') selected @endif>Third Class</option> 
                                    </select>
                                 </div>
                               </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" name="result_upload">
                                     <a class="btn btn-outline-secondary mt-3 link-radius" href="{{ asset($education->upload_file)}}">view file</a>
                                 </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Degree:</label>
                                 <div class="col-sm-9">
                                   <select name="degree" class="custom-select" id="inputGroupSelect05">
                                          <option value="B.Sc" @if(old('education.0.degree') == 'B.Sc') selected @endif>B.Sc</option> 
                                          <option value="M.SC" @if(old('education.0.degree') == 'M.SC') selected @endif>M.SC</option>  
                                          <option value="O Level" @if(old('education.0.degree') == 'O Level') selected @endif>O Level</option> 
                                          <option value="Undergraduate" @if(old('education.0.degree') == 'Undergraduate') selected @endif>Undergraduate</option>   
                                          <option value="Postgraduate" @if(old('education.0.degree') == 'MoPostgraduateday') selected @endif>Postgraduate</option>  
                                          <option value="HND" @if(old('education.0.degree') == 'HND') selected @endif>HND</option> 
                                          <option value="ND" @if(old('education.0.degree') == 'ND') selected @endif>ND</option>   
                                   </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Passing Year:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->passing_year}}" name="passing_year">
                                 </div>
                              </div>
                              <div class="card-footer text-right">
                                   <input type="submit" class="btn btn-primary" value="update qualification" name="qualification_btn" >
                               </div>
                             </div>
                           </div>
                           </form>
                          @endforeach
                           <div id="qualification-contents"></div>
                           <div class="text-center">
                             <a href="javascript:void(0)" id="add-qualification-btn" class="btn_add"><i class="fa fa-plus"></i> Add another qualification</a>
                             <input type="hidden" id="counter_1" value="{{$educations->count()}}">
                          </div> <hr>
                        
                         <!-- Qualification ends -->
                         <!-- Certification start -->
                         @php $cert = 1 @endphp
                         @foreach($certifications as $certification)
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$certification])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mt-4">
                              <h3>Certification {{$cert++}}</h3>
                            </div>
                            <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$certification->title}}" name="title">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$certification->decription}}" name="description">
                                 </div>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$certification->issued}}" name="issued">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file"  name="certification_upload">
                                     <a class="btn btn-outline-secondary mt-3 link-radius" href="{{ asset($certification->upload_file)}}">view file</a>
                                 </div>
                              </div>
                              <div class="card-footer text-right">
                                    <input type="submit" class="btn btn-primary" value="update certification" name="certification_btn" >
                               </div>
                            </div>
                           </div>
                        </form>
                         @endforeach

                          <div class="text-center">
                             <a href="javascript:void(0)" id="add-certification-btn" class="btn_add"><i class="fa fa-plus"></i> Add another certification</a>
                             <input type="hidden" id="counter_2" value="{{$certifications->count()}}">
                          </div>

                        <div id="certification-contents"></div>

                       <!-- Certification ends -->
                      </div>
                     </section>
                    <!-- Education Ends -->
                    <!-- Schedule start -->
                      <h2>Schedule</h2>
                      <section>
                      <div class="card-body">
                        <div class="text_color">
                            <h4>Schedule</h4>
                            <p>Pick the days you would be available as well as the time.</p>
                         </div> 
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Amount</label>
                                 <div class="col-sm-9">
                                     <input type="number" class="form-control" value="{{$hourly_pay->amount}}" name="amount">
                                 </div>
                              </div>
                              <!-- add schedule -->
                               @php $day=1 @endphp
                              @foreach($schedules as $schedule)
                             <form action="{{ route('teachersform-updates.update',['form_update'=>$schedule])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                              <div class="text_color">
                                 <h4>Day {{$day++}}</h4>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Day:</label>
                                 <div class="col-sm-9">
                                 <select name="day" id="day" class="custom-select mt-3 col-md-9" id="inputGroupSelect05">
                                    <option value="Monday"  @if(old('schedule.0.day') == 'Monday') selected @endif>Monday</option> 
                                    <option value="Tuseday" @if(old('schedule.0.day') == 'Tuseday') selected @endif>Tuesday</option>  
                                    <option value="Wednesday" @if(old('schedule.0.day') == 'Wednesday') selected @endif>Wednesday</option> 
                                    <option value="Thursday" @if(old('schedule.0.day') == 'Thursday') selected @endif>Thursday</option> 
                                    <option value="Friday" @if(old('schedule.0.day') == 'Friday') selected @endif>Friday</option>  
                                    <option value="Saturday" @if(old('schedule.0.day') == 'Saturday') selected @endif>Saturday</option> 
                                    <option value="Sunday" @if(old('schedule.0.day') == 'Sunday') selected @endif>Sunday</option>   
                                  </select>
                                 </div>
                              </div>
                              <div class="text_color">
                                <p class="font-16">Time</p>
                              </div>
                              <div class="row">
                                <div class="col-5 ml-5">
                                 <div class="form-group row">
                                      <label for="inputPassword3" class="col-form-label font-14">From</label>   
                                      <input type="time" class="form-control ml-5" name="from" value="{{$schedule->from}}">
                                  </div>
                                </div>
                                 <div class="col-5 ml-3">
                                  <div class="form-group">
                                     <label for="inputPassword3" class="col-form-label font-14">To</label>
                                    <input type="time" class="form-control ml-5" name="to" value="{{$schedule->to}}">
                                  </div>
                                 </div>
                                </div>
                                <div class="card-footer text-right mb-4">
                                   <input type="submit" class="btn btn-primary" value="update schedule" name="schedule_btn" >
                                  </div>
                                </form>
                              @endforeach
                               <div class="text-center">
                                 <a href="javascript:void(0)" id="add-schedule-btn" class="btn_add"><i class="fa fa-plus"></i> Add another Schedule</a>
                                 <input type="hidden" id="counter_3" value="{{$schedules->count()}}">
                               </div>
                               <div class="mt-4 text-center" id="schedule_content"></div>
                              <!-- add schedule ends -->
                            </div>
                            <div class="col-md-6">
                            <div class="form-group row">
                                <div class="input-group">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Select Category</label>
                                    <select name="category" class="custom-select" id="inputGroupSelect05">
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}" @if(isset($subjects)) @if($category->id == $subjects->category_id) selected @endif @endif>{{$category->title}}</option>   
                                        @endforeach
                                     </select>
                                </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Subjects:</label>
                                 <div class="col-sm-9">
                                   <input type="text" class="form-control" value="@foreach(json_decode($subjects->title) as $subject) {{$subject}}, @endforeach" name="subjects">
                                   <p class="text-danger">Note: Seperate each subject with comma ","</p>
                                 </div>
                              </div>
                           </div>
                          </div>
                         <div>
                         <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary" name="preview_btn">Preview</button>
                       </div>
                      </section>
                      <!-- Schedule ends -->
                    </div>
                  </div>
                </div>
               </form>
             </div>
           </div>
         </div>
      </div>
   </div>
</div>
</section>
 </div>
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
   <script src="{{ asset('back/assets/js/custom.js')}}"></script>
  <script src="{{ asset('back/assets/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/page/form-wizard.js')}}"></script>
  <script src="{{ asset('front/assets/js/form.js')}}"></script>
</body>
@endsection