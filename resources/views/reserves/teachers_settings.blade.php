<div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
              <div class="card-bod">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_name') == 'Mydetails') active  @elseif(empty(Session::get('tab_name'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                          aria-controls="mydetails" aria-selected="true"><label class="nav_image">My details</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'pro-info') active @endif" id="pro-info-tab" data-toggle="tab" href="#pro-info" role="tab"
                          aria-controls="pro-info" aria-selected="false"><label class="nav_image">Professional info</label></a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_name') == 'education') active @endif" id="education-tab" data-toggle="tab" href="#education" role="tab"
                          aria-controls="education" aria-selected="false"><label class="nav_image">Education</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'schedule') active @endif" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab"
                          aria-controls="schedule" aria-selected="false"><label class="nav_image">Schedule</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'password') active @endif" id="password-tab" data-toggle="tab" href="#password" role="tab"
                          aria-controls="password" aria-selected="false"><label class="nav_image">Password</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'notifications') active @endif" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab"
                          aria-controls="notifications" aria-selected="false"><label class="nav_image">General Settings</label></a>
                      </li>
                    </ul>
                    @include('back-layout.error')
                    <div class="tab-content" id="myTabContent">
                        <!-- tab1 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'Mydetails') show active @elseif(empty(Session::get('tab_name'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                        <!-- Personal Information start-->
                      <form action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                          <div class="text_color">
                            <h4>Personal info</h4>
                            <p>Update your photo and personal details here.</p>
                           </div>
                          <div class="row mt-5">
                           <div class="col-md-6">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label for="first_name" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="last_name" class="col-form-label font-14">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" name="phone" value="{{$personal_infos->phone}}">
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" name="address" value="{{$personal_infos->address}}">
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="town" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" name="town" value="{{$personal_infos->town}}">
                                 </div>
                              </div>
                              <div class="col-6">
                               <div class="form-group">
                                  <label for="state" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control" name="state" value="{{$personal_infos->state}}">
                               </div>
                              </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="text-center">
                            <img src="{{ asset($personal_infos->profile_photo)}}" height="200" width="265" alt="photo">
                        </div>
                        <div class="form-group text-center">
                            <label for="profile_photo" class=" col-form-label font-14">Add a photo Here</label><br>
                            <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" name="profile_photo">
                            <p class="text-gray">Note: Photo must not be greater than 5mb</p>
                         </div>
                        </div>
                        </div><hr>
                          <div class="text-right">
                          <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                          <input type="hidden" value="Mydetails" name="tab_name">
                          <input type="submit" class="primary ml-2 btn-lg" name="personal_btn" value="Save"> 
                         </div>
                       </div>
                      </form>
                    </div>
                      <!-- tab1 ends -->
                      <!-- tab 2 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'pro-info') show active @endif" id="pro-info" role="tabpanel" aria-labelledby="pro-info-tab">
                        <section>
                         <div class="card-body">
                         <form action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PATCH')
                            <div class="text_color">
                                <h4>Professional Info</h4>
                                <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                            </div>
                            <div class="row mt-5">
                               <div class="col-md-12">
                                <div class="form-group row">
                                   <label for="about" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
                                <div class="col-sm-9">
                                    <textarea name="about" class="form-control" cols="80" rows="5" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you. Tell us about your teaching strategies and what your pupils/students can expect from you.">{{$pro_infos->about}}</textarea>
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="experience" class="col-sm-3 col-form-label font-14">Experiences:</label>
                                 <div class="col-sm-9">
                                    <textarea name="experience" class="form-control" cols="80"  rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others.">{{$pro_infos->experience}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="onbording_video" class="col-sm-3 col-form-label">Onboading video:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" name="onboading_video" accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*">
                                     <p class="text-gray">Note: Video size must not be more than 10mb</p>
                                 </div>
                              </div>
                            </div>
                           </div><hr>
                           <div class="text-right mb-5">
                            <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                             <input type="hidden" value="pro-info" name="tab_name">
                             <input type="submit" class="primary btn-lg ml-2" name="professional_btn" value="Save">
                          </div>
                        </div>
                       </form>
                     </section>
                    </div>
                    <!-- tab 2 ends -->
                    <!-- tab3 starts -->
                    <div class="tab-pane fade @if(Session::get('tab_name') == 'education') show active @endif" id="education" role="tabpanel" aria-labelledby="education-tab">
                     <section>
                       <div class="card-body">
                        <!-- Qualifications start -->
                        <div class="text_color">
                            <h4>Education</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                         @php $q_count = 1; @endphp
                         @foreach ($educations as $education)
                          <div class="mt-4">
                           <h5 class="font-18 text_color">Qualification {{$q_count++}}</h5>
                         </div>
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$education])}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                          <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="university" class="col-sm-3 col-form-label">University / College:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->university}}" name="university">
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="result" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                     <select name="result" class="custom-select">
                                          <option value="First class" @if($education->result == 'First class') selected @endif>First class</option> 
                                          <option value="Second class" @if($education->result == 'Second class') selected @endif>Second class</option>  
                                          <option value="Third Class" @if($education->result == 'Third Class') selected @endif>Third Class</option> 
                                      </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="result_upload" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" name="result_upload" accept="image/png, image/gif, image/jpeg">
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="">
                                  <input type="checkbox" name="education_visible"  class="education_visible custom-switch-input" @if($education->visible == 1)  checked @endif>
                                  <input type="hidden" value="{{$education->visible}}" name="edu_visibility" class="edu_visibility">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description mt-2">Make your qualification visible</span>
                                </label>
                              </div>

                            </div>

                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="degree" class="col-sm-3 col-form-label">Degree:</label>
                                 <div class="col-sm-9">
                                      <select name="degree" class="custom-select">
                                          <option value="B.Sc" @if($education->degree == 'B.Sc') selected @endif>B.Sc</option> 
                                          <option value="M.SC" @if($education->degree == 'M.SC') selected @endif>M.SC</option>  
                                          <option value="O Level" @if($education->degree == 'O Level') selected @endif>O Level</option> 
                                          <option value="Undergraduate" @if($education->degree == 'Undergraduate') selected @endif>Undergraduate</option>   
                                          <option value="Postgraduate" @if($education->degree == 'Postgraduate') selected @endif>Postgraduate</option>  
                                          <option value="HND" @if($education->degree == 'HND') selected @endif>HND</option> 
                                          <option value="ND" @if($education->degree == 'ND') selected @endif>ND</option>   
                                      </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="passing_year" class="col-sm-3 col-form-label">Passing Year:</label>
                                 <div class="col-sm-9">
                                     <input type="month" class="form-control" value="{{$education->passing_year}}" name="passing_year">
                                 </div>
                              </div>
                              <div class="text-right">
                                   <a href="javascript:void(0)" id="add-qualification-btn" class="mr-3 font-14"><i class="fa fa-plus"></i> Add another qualification</a>
                                   <input type="hidden" value="education" name="tab_name">
                                   <button type="submit" class="primary btn-lg mt-3" name="qualification_btn">Save Change</button>
                               </div>
                             </div>
                            </div>
                          </form>
                          @endforeach
                          <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div id="qualification-contents"></div>
                              <div class="text-center">
                             
                              <input type="hidden" id="counter_1" value="{{$educations->count()}}">
                             </div><hr>
                             <div class="text-right mb-5">
                              <!-- <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-2">Cancel</a> -->
                              <input type="hidden" value="education" name="tab_name">
                              <button type="submit" id="education_btn" class="primary btn-lg ml-2" name="education_new_btn" disabled>Save</button>
                            </div>
                          </form>
                          <!-- Qualifications ends -->
                          <!-- Certifications start -->
                          @php $c_count = 0 @endphp
                          @foreach ($certifications as $certification)
                          <div class="mt-4">
                            <h5 class="font-18 text_color ">Certifications {{$c_count+=1}}</h5>
                         </div>
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$certification])}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="title" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Title" value="{{$certification->title}}" name="title">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="description" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                     <!-- <input type="text" class="form-control" placeholder="Description" value="" name="description"> -->
                                     <textarea name="description" class="form-control" cols="80"  rows="5" placeholder="Description">{{$certification->decription}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="">
                                  <input type="checkbox" name="visible" value="{{$certification->visible}}" class="cert_visible custom-switch-input" @if($certification->visible == 1)  checked @endif>
                                  <input type="hidden" value="{{$certification->visible}}" name="cert_visibility" class="cert_visibility">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description mt-2">Make your qualification visible</span>
                                </label>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="issued_date" class="col-sm-3 col-form-label">Issued Date</label>
                                 <div class="col-sm-9">
                                     <input type="month" class="form-control" placeholder="Issued" value="{{$certification->issued}}" name="issued">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="certification_upload" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file"  name="certification_upload" accept="image/png, image/gif, image/jpeg">
                                 </div>
                              </div>
                              <div class="text-right">
                                   <a href="javascript:void(0)" id="add-certification-btn"  class="mt-5 mr-3 font-14"><i class="fa fa-plus"></i> Add another certification</a>
                                   <input type="hidden" value="education" name="tab_name">
                                   <button type="submit" class="primary btn-sm mt-5" name="certification_btn">Save Change</button>
                              </div>
                           </div>
                          </div>
                         </form>
                         @endforeach
                         <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                           <div id="certification-contents"></div>
                           <div class="text-center">
                               <input type="hidden" id="counter_2" value="{{$certifications->count()}}">
                            </div><hr>
                            <div class="text-right mb-5">
                              <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                              <input type="hidden" value="education" name="tab_name">
                              <button type="submit" id="certifications_btn" class="primary btn-lg ml-2" name="certifications_new_btn" disabled>Save</button>
                            </div>
                         </div>
                       </form>
                     </section>
                  </div>
                  <!-- tab3 ends -->
                  <!-- tab4 starts -->
                  <div class="tab-pane fade @if(Session::get('tab_name') == 'schedule') show active @endif" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                   <section>
                    <div class="card-body">
                      <div class="text_color">
                         <h4>Schedule</h4>
                         <p>Pick the days you would be available as well as the time.</p>
                       </div>
                      <div class="row mt-5">
                        <div class="col-md-12">
                         <form action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                           <div class="row">
                            <div class="col-6">
                               <div class="form-group row">
                                 <label for="" class="col-sm-3 font-14 col-form-label">Amount</label>
                                 <div class="col-sm-9">
                                    <input type="number" class="form-control" placeholder="Amount per Hour" value="{{$hourly_pay->amount}}" name="amount">
                                    <datalist  id="hourly_pay" wire:model="amount">
                                      <option value="500">500</option>
                                      <option value="1000">1000</option>
                                      <option value="2000">2000</option>
                                      <option value="3000">3000</option>
                                      <option value="4000">4000</option>
                                      <option value="5000">5000</option>
                                      <option value="6000">6000</option>
                                    </datalist>
                                 </div>
                               </div>
                               <div class="form-group row">
                                  <label class="col-sm-3 col-form-label font-14">Subjects</label>
                                  <div class="col-sm-9">
                                    <select name="subjects[]" class="form-control select2" multiple="multiple">
                                      <option value="Mathematics" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Mathematics') selected @endif  @endforeach">Mathematics</option>
                                      <option value="Quantitative Reasoning" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Quantitative Reasoning') selected @endif  @endforeach">Quantitative Reasoning</option>
                                      <option value="Verbal Reasoning" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Verbal Reasoning') selected @endif  @endforeach">Verbal Reasoning</option>
                                      <option value="Social Studies" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Social Studies') selected @endif  @endforeach">Social Studies</option>
                                      <option value="Biology" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Biology') selected @endif  @endforeach">Biology</option>
                                      <option value="Art" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Art') selected @endif  @endforeach">Art</option>
                                      <option value="Chemistry" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Chemistry') selected @endif  @endforeach">Chemistry</option>
                                      <option value="Physics" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Physics') selected @endif  @endforeach">Physics</option>
                                      <option value="Civic Education" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Civic Education') selected @endif  @endforeach">Civic Education</option>
                                      <option value="History" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'History') selected @endif  @endforeach">History</option>
                                      <option value="Moral instruction" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Moral instruction') selected @endif  @endforeach">Moral instruction</option>
                                      <option value="Computer Science" @foreach(json_decode($subjects->title) as $subject) @if($subject == 'Computer Science') selected @endif  @endforeach">Computer Science</option>
                                    </select>
                                 </div>
                             </div>
                             </div>
                            <div class="col-6">
                              <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label font-14">Select Category</label>
                                     <div class="col-sm-9">
                                        <select name="category" class="custom-select" id="inputGroupSelect05">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if(isset($subjects)) @if($category->id == $subjects->category_id) selected @endif @endif>{{$category->title}}</option>   
                                            @endforeach
                                        </select>
                                     </div>
                              </div>
                              <div class="text-right">
                                <input type="hidden" value="schedule" name="tab_name">
                                <input type="submit" class="primary btn-sm mt-3" value="Save Change" name="subject_btn" >
                              </div>
                             </div>
                           </div>
                         </form>
                         </div>
                        <!-- add schedule -->
                          <div class="col-md-12">
                            @php $s_count = 0 @endphp
                            @foreach ($schedules as $schedule)
                            <h4 class="font-16 text_color">Schedule {{$s_count+=1}}</h4>
                             <form action="{{ route('teachersform-updates.update',['form_update'=>$schedule])}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-3 mt-3 col-form-label font-14">Day</label>
                                    <div class="col-sm-9">
                                    <select name="day" id="day" class="custom-select mt-3 col-md-12" id="inputGroupSelect05">
                                      <option value="1" @if($schedule->day == 1) selected @endif>Monday</option> 
                                      <option value="2" @if($schedule->day == 2) selected @endif>Tuesday</option>  
                                      <option value="3" @if($schedule->day == 3) selected @endif>Wednesday</option> 
                                      <option value="4" @if($schedule->day == 4) selected @endif>Thursday</option> 
                                      <option value="5" @if($schedule->day == 5) selected @endif>Friday</option>  
                                      <option value="6" @if($schedule->day == 6) selected @endif>Saturday</option> 
                                      <option value="0" @if($schedule->day == 0) selected @endif>Sunday</option>   
                                    </select>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                      <label class="col-sm-3 col-form-label font-14">Limit per booking</label>
                                      <div class="col-sm-9">
                                         <input type="number" value="{{$schedule->time_limit}}" class="form-control" name="time_limit">
                                         <datalist id="time_limit" wire:model="time_limit.0">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </datalist>
                                      </div>
                                  </div> -->
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-14">Limit per booking</label>
                                    <div class="col-sm-9 selectgroup w-100">
                                      <label class="selectgroup-item">
                                        <input type="radio" name="time_limit" value="1" class="selectgroup-input-radio" @if($schedule->time_limit == 1) checked @endif>
                                        <span class="selectgroup-button">One</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" name="time_limit" value="2" class="selectgroup-input-radio" @if($schedule->time_limit == 2) checked @endif>
                                        <span class="selectgroup-button">Two</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" name="time_limit" value="3" class="selectgroup-input-radio" @if($schedule->time_limit == 3) checked @endif>
                                        <span class="selectgroup-button">Three</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" name="time_limit" value="4" class="selectgroup-input-radio" @if($schedule->time_limit == 4) checked @endif>
                                        <span class="selectgroup-button">Four</span>
                                      </label>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-6">
                                  <div class="form-group row">
                                    <label for="inputEmail4" class="col-sm-3 mt-2 font-14">Time</label>
                                     <div class="form-row col-sm-9">
                                        <div class="form-group col-md-5 ml-4">
                                           <input type="time" placeholder="From" class="form-control" value="{{$schedule->from}}" name="from">
                                       </div>
                                       <div class="form-group col-md-5 ml-4">
                                           <input type="time" placeholder="To" class="form-control" value="{{$schedule->to}}" name="to">
                                       </div>
                                     </div>
                                  </div>
                               
                                    
                                  <div class="form-group row">
                                    <label class="font-14 col-sm-3 col-form-label">Select Break Time</label>
                                     <div class="selectgroup selectgroup-pills col-md-9">
                                        @foreach (json_decode($schedule->time_split) as $split)
                                        @if($schedule->break_times == null || $schedule->break_times == "null")
                                          <!-- <div class="selectgroup-pills"> -->
                                           <label class="selectgroup-item">
                                            <input type="checkbox" name="break_times[]" value="{{$split}}" class="selectgroup-input">
                                            <span class="selectgroup-button">{{$split}}</span>
                                           </label>
                                        <!-- </div> -->
                                        @else
                                        <!-- <div class="selectgroup-pills"> -->
                                          <label class="selectgroup-item">
                                            <input type="checkbox" name="break_times[]" value="{{$split}}" class="selectgroup-input" 
                                            @foreach (json_decode($schedule->break_times) as $time)
                                                @if ($split == $time)
                                                  checked 
                                                @endif
                                              @endforeach>
                                            <span class="selectgroup-button"> {{$split}}</span>
                                          </label>
                                        <!-- </div> -->
                                     @endif
                                    @endforeach
                                  </div>
                                 </div>
                                
                                  </div>
                                 </div>
                                <div class="text-right">
                                <a href="javascript:void(0)" id="add-schedule-btn" class="font-14 mr-3"><i class="fa fa-plus"></i> Add another Schedule</a>
                                   <input type="hidden" value="schedule" name="tab_name">
                                   <input type="submit" class="primary btn-sm" value="Save Change" name="schedule_btn" >
                               </div>
                             </form>
                              @endforeach
                               <div class="text-center">
                                 <input type="hidden" id="counter_3" value="1">
                            </div>
                          </div>
                          <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body mt-4 text-center" id="schedule_content"></div>
                             <!-- add schedule ends -->
                             </div><hr>
                             <div class="text-right mb-5">
                                <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                                <input type="hidden" value="schedule" name="tab_name"> 
                                <button type="submit" class="primary btn-lg ml-2" name="schedule_new_btn" id="schedule_btn" disabled>Save</button>
                             </div>
                          </form>
                        </div>
                      </section> 
                  </div>  
                  <!-- tab 4 ends -->
                  <!-- tab 5 start -->
                  <div class="tab-pane fade @if(Session::get('tab_name') == 'password') show active @endif" id="password" role="tabpanel" aria-labelledby="password-tab">
                   <section>
                    <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PATCH')
                      <div class="card-body">
                        <div class="text_color">
                         <h4 class="text_color ">Password</h4>
                         <p>Change your password to protect your account</p>
                        </div>
                        <div class="row mt-4">
                          <div class="col-md-7">
                            <div class="form-group">
                                <label for="" class="col-form-label font-14">Current Password</label>
                                <input type="password" class="form-control" placeholder="Current Password" value="" name="current_password" required>
                                 @error('current_password')
                                   <p class="text-danger">{{$message}}</p>
                                 @enderror
                             </div>
                              
                             <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="" class="col-form-label font-14">New Password</label>
                                 <input type="password" class="form-control" placeholder="New Password" value="" name="new_password" required>
                                 @error('new_password')
                                  <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>
                                
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="inputPassword3" class="col-form-label font-14">Confirm new Password</label>
                                 <input type="password" class="form-control" placeholder="Confirm new Password" value="" name="confirm_password" required>
                                  @error('confirm_password')
                                  <p class="text-danger">{{$message}}</p>
                                 @enderror
                                </div>
                               
                              </div>
                            </div>
                          </div>
                         </div><hr>
                           <div class="text-right mb-5">
                            <a href="{{  route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                            <input type="hidden" value="password" name="tab_name">
                            <input type="submit" class="primary btn-lg ml-2" name="password_btn" value="Save">
                          </div>
                      </div>
                    </form>
                  </section>
                  </div>
                  <!-- tab5 ends -->
                  <!-- tab 6 start -->
                  <div class="tab-pane fade @if(Session::get('tab_name') == 'notifications') show active @endif"  id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                    <div class="card-body">
                     <form action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST">
                        @csrf
                        @method('PATCH')
                       <div class="">
                         <h4 class="font-16 font-weight-bold">Notification</h4>
                         <span class="font-12">Get notified on what you want to see</span>
                       </div><hr>
                       <div class="mt-4">
                          <h5 class="font-14">By Email</h5>
                          <div class="mt-3">
                            <input type="checkbox" name="messages" id="messages" @if($notifications->messages == 1) checked @endif>
                            <input type="hidden" name="message" id="message" value="{{$notifications->messages}}">
                            <span class="ml-2 font-14">Messages</span> <br>
                            <span class="ml-4 font-14">Get notified when your student messages you.</span>
                          </div>  
                          <div class="mt-3">
                            <input type="checkbox" name="activities" id="activities" @if($notifications->activities == 1) checked @endif>
                            <input type="hidden" name="activities" id="activity" value="{{$notifications->activities}}">
                            <span class="ml-2 font-14">Account Activities</span> <br>
                            <span class="ml-4 font-14">Get notified whenever there is an activity on your dashboard.</span>
                          </div>

                          <div class="mt-3">
                            <input type="checkbox" name="offer" id="offer"  @if($notifications->offers == 1) checked @endif>
                            <input type="hidden" name="offers" id="offers" value="{{$notifications->offers}}">
                            <span class="ml-2 font-14">Offers</span> <br>
                            <span class="ml-4 font-14">Get notified when a student accepts or rejects an offer.</span>
                          </div>

                          <div class="mt-5">
                            <h4 class="font-16 font-weight-bold">Push Notifications</h4>
                            <span class="font-12">These are delivered via SMS to your mobile phone.</span>
                          </div>

                          <div class="mt-3">
                              <input type="checkbox" name="everythings" id="everythings"  @if($notifications->everything == 1) checked @endif>
                              <input type="hidden" name="everything" id="everything" value="{{$notifications->everything}}">
                              <span class="ml-2 font-14">Everything</span>
                          </div>

                          <div class="mt-3">
                            <input type="checkbox" name="send_as_emails" id="send_as_emails" @if($notifications->send_as_email == 1) checked @endif>
                            <input type="hidden" name="send_as_email" id="send_as_email" value="{{$notifications->send_as_email}}">
                            <span class="ml-2 font-14">Same as email</span>
                          </div>

                          <div class="mt-3">
                            <input type="checkbox" name="no_pushs" id="no_pushs" @if($notifications->no_push == 1) checked @endif>
                            <input type="hidden" name="no_push" id="no_push" value="{{$notifications->no_push}}">
                            <span class="ml-2 font-14">No push notifications</span>
                          </div>
                        </div><hr>
                        <div class="text-right">
                            <input type="hidden" value="notifications" name="tab_name">
                            <a href="{{ route('teachers-dashboard')}}" class="btn btn-default mr-3">Cancel</a>
                            <input type="submit" class="primary btn-lg" value="Save" name="notification_btn">
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- tab 6 end -->
                </div>
              </div>
           </div>
        </div>
      </div>
    </div>
   </div>
  </div>