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
        <!-- <a href="{{ route('teachers-form1')}}" class="btn mt-5 h5"><i class="fa fa-angle-left"></i> back</a> -->
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
                    <form  action="{{ route('teachers-wizard')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                     <div id="wizard_horizontal">
                      <h2 class="wizard_radius">Personal Information</h2>
                      <section>
                      <!-- Personal Information start-->
                     <div class="card-body">
                        <div class="text_color">
                            <h4>Personal Information</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                        </div>
                        <div class="row mt-5">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="state" value="{{old('state')}}" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" value="{{old('phone')}}" placeholder="phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Means of Identifcation</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg" value="{{old('means_of_ID')}}" name="means_of_ID" >
                            </div>
                        </div>
                        @error('profile_photo')
                              <div class="alert-danger text-center">{{$message}}</div>
                         @enderror

                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Town</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="town" value="{{old('town')}}" placeholder="Town">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="country" value="{{old('country')}}" placeholder="Country">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">D.O.B</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="d_o_b" value="{{old('d_o_b')}}" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Profile Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg" value="{{old('profile_photo')}}" name="profile_photo">
                                <p class="text-danger">Note: Photo must not be greater than 5mb</p>
                            </div>
                         </div>
                          @error('profile_photo')
                              <div class="alert-danger text-center">{{$message}}</div>
                         @enderror
                      </div>
                     </div>
                     </div>
                     <div class="card-footer text-left">
                          <a href="{{ route('redirect')}}" class="btn btn-outline-secondary">Skip to Dashboard <i class="fas fa-forward-fast"></i></a>
                       </div>
                     </section>
                     <!-- Personal Information Ends-->
                     <!-- Professional Information start-->
                      <h2>Professional Info</h2>
                      <section>
                      <div class="card-body">
                        <div class="text_color">
                            <h4>Professional Information</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                         <div class="row mt-5">
                            <div class="col-md-12">
                               <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Tell us about you:</label>
                                 <div class="col-sm-9">
                                    <textarea name="about"  class="form-control" cols="80" rows="5" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you. Tell us about your teaching strategies and what your pupils/students can expect from you." wrap=physical>{{old('about')}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Experiences:</label>
                                 <div class="col-sm-9">
                                    <textarea name="experience" class="form-control" cols="80" rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others.">{{old('experience')}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Onboading video:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*" value="{{old('onboading_video')}}" name="onboading_video" >
                                     <p class="text-danger">Note: Video size must not be more than 10mb</p>
                                 </div>
                                </div>
                                @error('onboading_video')
                                <div class="alert-danger text-center">{{$message}}</div>
                               @enderror
                            </div>
                         </div>
                         </div>
                         <div class="card-footer text-right">
                          <!-- <a  href="{{ route('redirect')}}" class="btn btn-info">Skip to Dashboard</a> -->
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
                         <!-- Qualification 1 start -->
                         <div class="mt-4">
                           <h3>Qualification</h3>
                         </div>
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="University / College" value="{{old('education.0.university')}}" name="education[0][university]">
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                     <select name="education[0][result]" class="custom-select" id="inputGroupSelect05">
                                          <option value="First class" @if(old('education.0.result') == 'First class') selected @endif>First class</option> 
                                          <option value="Second class" @if(old('education.0.result') == 'Second class') selected @endif>Second class</option>  
                                          <option value="Third Class" @if(old('education.0.result') == 'Third Class') selected @endif>Third Class</option> 
                                      </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" accept="image/png, image/gif, image/jpeg"  class="form-control-file" value="old('education.0.result_upload')" name="education[0][result_upload]" >
                                 </div>
                              </div>
                                @error('education.0.result_upload')
                                <div class="mb-3 alert-danger text-center">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Degree:</label>
                                 <div class="col-sm-9">
                                     <select name="education[0][degree]" class="custom-select" id="inputGroupSelect05">
                                          <option value="B.Sc" @if(old('education.0.degree') == 'B.Sc') selected @endif>B.Sc</option> 
                                          <option value="M.SC" @if(old('education.0.degree') == 'M.SC') selected @endif>M.SC</option>  
                                          <option value="O Level" @if(old('education.0.degree') == 'O Level') selected @endif>O Level</option> 
                                          <option value="Undergraduate" @if(old('education.0.degree') == 'Undergraduate') selected @endif>Undergraduate</option>   
                                          <option value="Postgraduate" @if(old('education.0.degree') == 'Postgraduate') selected @endif>Postgraduate</option>  
                                          <option value="HND" @if(old('education.0.degree') == 'HND') selected @endif>HND</option> 
                                          <option value="ND" @if(old('education.0.degree') == 'ND') selected @endif>ND</option>   
                                      </select>
                                    </div>  
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Passing Year:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Passing Year" value="{{old('education.0.passing_year')}}" name="education[0][passing_year]">
                                 </div>
                              </div>
                          </div>
                          </div>
                          <!-- Qualification 1 ends -->
                           
                          <div class="text-center">
                             <a href="javascript:void(0)" id="add-qualification-btn" class="btn_add"><i class="fa fa-plus"></i> Add another qualification</a>
                             <input type="hidden" id="counter_1" value="1">
                         </div> 
                          <!-- Qualification 3 ends -->

                          <!-- more qualifications start -->
                          <div id="qualification-contents"> </div>
                           <!-- more qualifications ends -->

                          <!-- Certification 1 start -->
                          <div class="mt-4">
                            <h3>Certification</h3>
                         </div>
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Title" value="{{old('certificate.0.title')}}" name="certificate[0][title]">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Description" value="{{old('certificate.0.description')}}" name="certificate[0][description]">
                                 </div>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{old('certificate.0.issued')}}" placeholder="Issued" name="certificate[0][issued]">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file  @error('certificate.0.certification_upload') is-invalid @enderror" value="{{old('certificate.0.issued')}}"  name="certificate[0][certification_upload]" >
                                 </div>
                               </div>
                                 @error('certificate.0.certification_upload')
                                 <div class="mb-3 alert-danger text-center">{{$message}}</div>
                                 @enderror
                           </div>
                          </div>
                          <div class="text-center">
                             <a href="javascript:void(0)"  id="add-certification-btn"  class="btn_add"><i class="fa fa-plus"></i> Add another certification</a>
                             <input type="hidden" id="counter_2" value="1">
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
                                     <input type="number" class="form-control" value="{{old('amount')}}" placeholder="Amount per Hour" name="amount">
                                 </div>
                              </div>
                            </div>
                           <div class="col-md-6">
                            <div class="form-group row">
                                <div class="input-group">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label">Select Category</label>
                                    <select name="category" class="custom-select" id="inputGroupSelect05">
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}" @if(old('category') == $category->id) selected @endif>{{$category->title}}</option>   
                                        @endforeach
                                     </select>
                                </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Subjects:</label>
                                 <div class="col-sm-9">
                                   <input type="text" class="form-control" value="{{old('subjects')}}" placeholder="Enter Subjects you Offer" name="subjects">
                                   <p class="text-danger">Note: Seperate each subject with comma ","</p>
                                 </div>
                              </div>
                              
                           </div>
                                <!-- add schedule -->
                              <div class="card-body mt-5">
                              <h3 class="">Schedule</h3>
                              <div class="row">
                              <div class="col-6">
                               <div class="form-group row mt-4">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Day:</label>
                                 <div class="col-sm-12">
                                  <select name="schedule[0][day]" id="day" class="custom-select mt-3 col-md-9" id="inputGroupSelect05">
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
                              <div class="form-group text-left">
                                  <label for="inputPassword3" class="col-form-label">Limit per booking:</label>
                                  <input type="number" class="mt-3 col-md-10 form-control" value="{{ old('schedule.0.time_limit')}}" name="schedule[0][time_limit]"  >
                              </div>
                            </div>
                              <div class="col-6">
                                 <div class="row">
                                 <label for="inputEmail4" class="mr-5">Time:</label>
                                  <div class="form-group col-md-12">
                                      <label for="inputEmail4">From</label>
                                      <input type="time" id="from" class="form-control" value="{{old('schedule.0.from')}}" name="schedule[0][from]">
                                  </div>
                                  <div class="form-group col-md-12">
                                      <label for="inputPassword4">To</label>
                                      <input type="time" id="to_btn" class="form-control" value="{{ old('schedule.0.to')}}" name="schedule[0][to]">
                                  </div>
                                </div>

                                <div class="form-group col-md-12">
                                  <label class="font-18">Add break time</label><br>
                                     <div id="select_time"></div>
                                </div>
                              </div> 
                              </div>
                              <div class="mt-4 text-center" id="schedule_content"></div>
                               <div class="text-center">
                                 <a href="javascript:void(0)" id="add-schedule-btn" class="btn_add"><i class="fa fa-plus"></i> Add another Schedule</a>
                                 <input type="hidden" id="counter_3" value="1">
                               </div>
                               </div> 
                               <!-- add schedule ends -->
                           </div>
                       
                         <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Preview</button>
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
  <script src="{{ asset('front/assets/js/loader.js')}}"></script>
</body>
@endsection