<div>
    
<div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
              <div class="card-bod">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_pane') == 'Mydetails') active  @elseif(empty(Session::get('tab_pane'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                          aria-controls="Mydetails" aria-selected="true"><label class="nav_image">My details</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'pro-info') active @endif" id="pro-info-tab" data-toggle="tab" href="#pro-info" role="tab"
                          aria-controls="pro-info" aria-selected="false"><label class="nav_image">Professional info</label></a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_pane') == 'education') active @endif" id="education-tab" data-toggle="tab" href="#education" role="tab"
                          aria-controls="education" aria-selected="false"><label class="nav_image">Education</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'schedule') active @endif" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab"
                          aria-controls="schedule" aria-selected="false"><label class="nav_image">Schedule</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'password') active @endif" id="password-tab" data-toggle="tab" href="#password" role="tab"
                          aria-controls="password" aria-selected="false"><label class="nav_image">Password</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'notification') active @endif" id="notification-tab" data-toggle="tab" href="#notification" role="tab"
                          aria-controls="notifications" aria-selected="false"><label class="nav_image">General Settings</label></a>
                      </li>
                    </ul>
                    @if(Session::get('tab_pane') == 'schedule' || Session::get('tab_pane') == 'education')
                       @include('back-layout.error')
                     @endif
                    <div class="tab-content" id="myTabContent">
                        <!-- tab1 start -->
                      <div class="tab-pane fade @if(Session::get('tab_pane') == 'Mydetails') show active @elseif(empty(Session::get('tab_pane'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                        <!-- Personal Information start-->
                      <form  enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" wire:model.defer="first_name">
                                     @error('first_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="last_name" class="col-form-label font-14">Last Name</label>
                                    <input type="text" class="form-control" wire:model.defer="last_name">
                                    @error('last_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                              </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="email" class="col-form-label font-14">Email Address</label>
                                    <input type="email" class="form-control" wire:model.defer="email" readonly>
                                    @error('email') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>  
                                </div>
                                <div class="col-6">
                                   <div class="form-group">
                                       <label for="email" class="col-form-label font-14">Country</label>
                                       <input type="text" list="selectcountry" class="form-control" wire:model.defer="country" disabled>
                                       <datalist id="selectcountry">
                                        <option value="Nigeria">Nigeria</option>
                                       </datalist>
                                       @error('country') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                                </div>
                             </div>
                           
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="phone" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" wire:model.defer="phone">
                                      @error('phone') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="address" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" wire:model.defer="address">
                                @error('address') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="town" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" wire:model.defer="town">
                                      @error('town') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                               <!-- <div class="form-group">
                                  <label for="state" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control" wire:model.defer="state">
                                  @error('state') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                               </div> -->

                               <div class="form-group">
                                  <label for="state" class="col-form-label font-14">State</label>
                                     @if(isset($country))
                                         @if ($states  == null || $states->count() == 0)
                                         <select  class="form-control">
                                            <option value="">No State Found! </option>
                                         </select>
                                          @else
                                          <select id="selectState" wire:model="state" class="form-control">
                                             <option value="">Select State</option>
                                              @foreach ($states->chunk(20) as $groups)
                                                @foreach ($groups as $state)
                                                  <option value="{{$state->name}}">{{$state->name}}</option> 
                                                @endforeach
                                               @endforeach
                                            </select>
                                          @endif
                                       @endif
                                      @error('state') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>

                              </div>
                            </div>
                        </div>
                     
                       <div class="col-md-6">
                        @if($profile_photo)
                            <div class="text-center">
                                <img src="{{$profile_photo->temporaryUrl()}}" height="200" width="265" alt="photo">
                            </div>
                            @else
                            <div class="text-center">
                                <img src="{{ asset($personal_infos->profile_photo)}}" height="200" width="265" alt="photo">
                            </div>
                            @endif
                            <div class="form-group text-center">
                                <label for="profile_photo" class=" col-form-label font-14">Add a photo Here</label><br>
                                <div x-data="{ isUploading: false, progress: 0}" 
                                    x-on:livewire-upload-start="isUploading = true; progress: 5"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input type="file" wire:click="personalTab()" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" wire:model.defer="profile_photo">
                                    <div x-show="isUploading" class="mt-2">
                                    <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('profile_photo') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                <p class="text-gray">Note: Photo must not be greater than 5mb</p>
                            </div>
                        </div>
                        </div><hr>
                          <div class="text-right">
                           <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                           <button class="primary btn-lg" wire:click.prevent="updatePersonalInfo({{$user->id}})">Save</button>
                         </div>
                       </div>
                      </form>
                    </div>
                      <!-- tab 1 ends -->
                      <!-- tab 2 start -->
                      <div class="tab-pane fade @if(Session::get('tab_pane') == 'pro-info') show active @endif" id="pro-info" role="tabpanel" aria-labelledby="pro-info-tab">
                        <section>
                         <div class="card-body">
                         <form enctype="multipart/form-data">
                            <div class="text_color">
                                <h4>Professional Info</h4>
                                <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                            </div>
                            <div class="row mt-5">
                               <div class="col-md-12">
                                <div class="form-group row">
                                   <label for="about" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
                                <div class="col-sm-9">
                                    <textarea wire:model.defer="about" class="form-control" cols="80" rows="5" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you. Tell us about your teaching strategies and what your pupils/students can expect from you."></textarea>
                                    @error('about') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="experience" class="col-sm-3 col-form-label font-14">Experiences:</label>
                                 <div class="col-sm-9">
                                    <textarea wire:model.defer="experience" class="form-control" cols="80"  rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others."> </textarea>
                                    @error('experience') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="onbording_video" class="col-sm-3 col-form-label font-14">Onboading video:</label>
                                 <div class="col-sm-9">
                                      <div x-data="{ isUploading: false, progress: 0}" 
                                           x-on:livewire-upload-start="isUploading = true; progress: 5"
                                           x-on:livewire-upload-finish="isUploading = false"
                                           x-on:livewire-upload-error="isUploading = false"
                                           x-on:livewire-upload-progress="progress = $event.detail.progress">
                                           <input type="file" wire:click="proTab()" class="form-control-file" wire:model.defer="onboading_video" accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*">
                                         <div x-show="isUploading" class="mt-2">
                                           <progress max="100" x-bind:value="progress"></progress>
                                         </div>
                                      </div>
                                      <p class="text-gray">Note: Video size must not be more than 10mb</p>
                                       @error('onboading_video') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror <br>
                                       @if (!is_string($onboading_video))
                                           <video src="{{ $onboading_video->temporaryUrl() }}" height="180" width="250" controls></video>
                                       @else
                                           <video src="{{ asset($pro_infos->onboading_video) }}" height="180" width="250" controls></video> 
                                       @endif
                                   </div>
                                 </div>
                               </div>
                            </div>
						   </form>
                           </div><hr>
						
                           <div class="text-right mb-5">
                             <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                             <button class="primary btn-lg mr-3" wire:click.prevent="updateProInfo({{$user->id}})" @if($about || $experience || $onboading_video) enabled @else disabled @endif>Save</button>
                          </div>
					  </section>
                    </div>
                    <!-- tab 2 ends -->
                    <!-- tab 3 starts -->
                    <div class="tab-pane fade @if(Session::get('tab_pane') == 'education') show active @endif" id="education" role="tabpanel" aria-labelledby="education-tab">
                     <section>
                       <div class="card-body">
                        <!-- Qualifications start -->
                        <div class="text_color">
                            <h4>Education</h4>
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                          
                        @if ($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)
                            <p class="font-18">Add More Qualification</p>
                            <button class="btn btn-default btn-sm mt-3 font-14 mr-3" wire:click.prevent="addQualification({{$i}})"><i class="fa fa-plus"></i> Add more</button>
                        @elseif($dynamic_cert == 0 || $dynamic_qualify == 0)

                         @php $q_count = 1; @endphp
                         @foreach ($education_infos as $key => $education)
                          <div class="mt-4">
                           <h5 class="font-18 text_color">Qualification {{$q_count++}}</h5>
                         </div>
                         <form  enctype="multipart/form-data">
                          <div class="row mt-5">
                            <div class="col-md-6">

                             <div class="form-group row">
                                 <label for="university" class="col-sm-3 col-form-label">University / College:</label>
                                 <div class="col-sm-9">
                                    <select wire:model="university.{{$key}}" id="selectUniversity_{{$key}}" class="form-control">
                                      <option value="">Select University / College</option> 
                                        @foreach ($universities->chunk(20) as $group)
                                          @foreach ($group as $college)
                                              <option value="{{$college->name}}">{{$college->name}}</option> 
                                            @endforeach
                                        @endforeach
                                    </select>  
                                    @error('university.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="result" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                     <select wire:model.defer="result.{{$key}}" class="custom-select">
                                          <option value="First class">First class</option> 
                                          <option value="Second class">Second class</option>  
                                          <option value="Third Class">Third Class</option> 
                                      </select>
                                      @error('result.'.$key)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="result_upload" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                    <div x-data="{ isUploading: false, progress: 0}" 
                                        x-on:livewire-upload-start="isUploading = true; progress: 5"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <input type="file"  wire:model.defer="qualification_upload.{{$key}}" wire:click="educationTab()" class="form-control-file" accept="image/png, image/gif, image/jpeg">
                                        <div x-show="isUploading" class="mt-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                    @error('qualification_upload.'.$key)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                      Preview: <br>
                                      @if (is_string($qualification_upload[$key]))
                                         <img src="{{ asset($education->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                                       @else
                                         <img src="{{ $qualification_upload[$key]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                                       @endif
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="mt-2">
                                  <input type="checkbox" wire:model.defer="edu_visibility.{{$key}}" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">Make your qualification visible</span>
                                </label>
                              </div>

                            </div>

                            <div class="col-md-6">
                               <div class="form-group row">
                                  <label for="degree" class="col-sm-3 col-form-label font-14">Degree:</label>
                                  <div class="col-sm-9">
                                      <select  wire:model.defer="degree.{{$key}}" class="custom-select">
                                      @if (isset($university[$key]))
                                        @php
                                              $selected = App\Models\University::where('name','like', "%{$university[$key]}%")->first();
                                          @endphp 
                                          <option value="">Select Degree</option> 
                                          @if (!empty($selected->degree))
                                          @if($selected->degree == 1)
                                              <option value="B.Sc">B.Sc</option> 
                                              <option value="M.SC">M.SC</option>  
                                              <option value="Undergraduate">Undergraduate</option>   
                                              <option value="Postgraduate">Postgraduate</option>  
                                          @else
                                              <option value="HND">HND</option> 
                                              <option value="ND">ND</option> 
                                          @endif 
                                          @endif
                                        @endif
                                      </select><br>
                                      @error('degree.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                  </div>  
                              </div>

                              <div class="form-group row">
                                 <label for="passing_year" class="col-sm-3 col-form-label">Passing Year:</label>
                                 <div class="col-sm-9">
                                     <input type="month" wire:model.defer="passing_year.{{$key}}" class="form-control" >
                                     @error('passing_year.'.$key)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                 </div>
                              </div>

                              <div class="form-group">
                                <input type="hidden" wire:model.defer="qualification_id.{{$key}}">
                              </div>

                              <div class="text-right mt-5">
                                   <button wire:click.prevent="addQualification({{$i}})" class="button_btn mr-3 font-14"><i class="fa fa-plus"></i> Add More</butoon>
                               </div>
                             </div>
                            </div>
                           </form> <hr>
                         @endforeach
                        @endif

                          <!-- add more qualification starts-->
                             @include('teachers.profile-forms.add_mores.more_qualifications')
                          <!-- add more qualification ends -->
                          <!-- Qualifications ends -->


                          <!-- Certifications start -->
                          @if ($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)

                            <p class="font-18">Add More Certification</p>
                            <button class="btn btn-default btn-sm font-14 mr-3" wire:click.prevent="addCertification({{$i}})"> <i class="fa fa-plus"></i> Add more</button>

                          @elseif($dynamic_cert == 0 || $dynamic_qualify == 0)
                          
                          @php $c_count = 0 @endphp
                          @foreach ($cert_infos as $key2 => $certification)
                          <div class="mt-4">
                            <h5 class="font-18 text_color ">Certifications {{$c_count+=1}}</h5>
                           </div>
                           <form  enctype="multipart/form-data">
                            <div class="row mt-5">
                             <div class="col-md-6">
                               <div class="form-group row">
                                 <label for="title" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" wire:model.defer="title.{{$key2}}" class="form-control" placeholder="Title">
                                     @error('title.'.$key2)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="description" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                    <textarea wire:model.defer="description.{{$key2}}" class="form-control" cols="80"  rows="5" placeholder="Description"></textarea>
                                     @error('description.'.$key2)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="">
                                  <input type="checkbox" wire:model.defer="cert_visibility.{{$key2}}"  class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description mt-2">Make your Certification visible</span>
                                </label>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="issued_date" class="col-sm-3 col-form-label">Issued Date</label>
                                 <div class="col-sm-9">
                                     <input type="month" wire:model.defer="issued.{{$key2}}" class="form-control" placeholder="Issued">
                                     @error('Issued.'.$key2)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="certification_upload" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                 <div x-data="{ isUploading: false, progress: 0}" 
                                    x-on:livewire-upload-start="isUploading = true; progress: 5"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                     <input type="file" wire:model.defer="certification_upload.{{$key2}}" wire:click="educationTab()" class="form-control-file"  accept="image/png, image/gif, image/jpeg">
                                     <div x-show="isUploading" class="mt-2">
                                      <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                 </div>
                                 @error('certification_upload.'.$key2)<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                    Preview: <br>
                                   @if (is_string($certification_upload[$key2]))
                                      <img src="{{ asset($certification->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                                   @else
                                      <img src="{{ $certification_upload[$key2]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                                    @endif
                                 </div>
                              </div>
                              <div class="form-group">
                                <input type="hidden" wire:model="certification_id.{{$key2}}">
                              </div>
                               <br>
                              <div class="text-right mt-4">
                                   <button  class="button_btn btn-sm mr-2" wire:click.prevent="addCertification({{$i}})"> <i class="fa fa-plus"></i> Add More</button>
                               </div>
                           </div>
                          </div>
                         </form>
                         @endforeach
                        @endif
                        @if($msg_display == 1)
                             <div class="alert alert-success col-md-6">
                                 <span class="text-white text-capitalize font-14 font-weight-600"> {{Session::get('message')}}  <i class="fa fa-check"></i></span> 
                             </div>
                           @endif
                            <!-- add more certifications starts-->
                               @include('teachers.dynamic_form.more_certification')
                            <!-- add more certification ends -->
                            <hr>
                           <div class="text-right">
                               <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                             @if($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)
                               <button wire:click.prevent="moreEducation" class="primary btn-sm mt-5">Save</button>
                             @else
                               <button wire:click.prevent="UpdateEducation" class="primary btn-sm mt-5">Save Change</button>
                            @endif
                           </div>
						            </div>
                      </section>
                   </div>
                  <!-- tab3 ends -->
                 <!-- tab4 starts -->
                 <div class="tab-pane fade @if(Session::get('tab_pane') == 'schedule') show active @endif" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                   <section>
                    <div class="card-body">
                      <div class="text_color">
                         <h4>Schedule</h4>
                         <p>Pick the days you would be available as well as the time.</p>
                       </div>
                       
                      <div class="row mt-5">
                       @if ($dynamic_schedule == 0)
                        <div class="col-md-12">
                         <!-- <form action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data"> -->
                          <div class="row">
                            <div class="col-md-6">
                               <div class="form-group row">
                                 <label for="" class="col-sm-3 font-14 col-form-label">Amount</label>
                                 <div class="col-sm-9">
                                    <input type="number" wire:model="amount" class="form-control"  disabled>
                                 </div>
                               </div>
                               <div class="form-group row" wire:ignore>
                                  <label class="col-sm-3 col-form-label font-14">Subjects</label>
                                  <div class="col-sm-9 mt-3">
                                    <select wire:model.defer="subjects" class="form-control" id="Select_subject" multiple="multiple">
                                      <option value="Mathematics">Mathematics</option>
                                      <option value="Quantitative Reasoning">Quantitative Reasoning</option>
                                      <option value="Verbal Reasoning">Verbal Reasoning</option>
                                      <option value="Social Studies">Social Studies</option>
                                      <option value="Biology">Biology</option>
                                      <option value="Art">Art</option>
                                      <option value="Chemistry">Chemistry</option>
                                      <option value="Physics">Physics</option>
                                      <option value="Civic Education">Civic Education</option>
                                      <option value="History">History</option>
                                      <option value="Moral instruction">Moral instruction</option>
                                      <option value="Computer Science">Computer Science</option>
                                    </select>
                                 </div>
                             </div>
                             </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label font-14">Select Level</label>
                                     <div class="col-sm-9">
                                        <select wire:model.defer="levels" id="select_levels" class="form-control" multiple="multiple">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->title}}">{{$category->title}}</option>   
                                            @endforeach
                                        </select>
                                     </div>
                                     @error('levels')<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                </div>
                             </div>
                           </div>
                         </form>
                         </div>
                        <!-- add schedule -->
                          <div class="col-md-12">
                           @php $s_count = 0 @endphp
                            @foreach ($schedules_infos as $key3 => $schedule)
                            <h4 class="font-16 text_color">Schedule {{$s_count+=1}}</h4>
                             <form action="{{ route('teachersform-updates.update',['form_update'=>$schedule])}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                              <div class="row">
                                <div class="col-md-6">
                                <div class="form-group row">
                                  <label for="day" class="col-sm-3 col-form-label font-14">Day</label>
                                  <div class="col-sm-9">
                                    <select wire:model.defer="day.{{$key3}}" class="form-control">
                                      <option value="1" @if($day[$key3] == 1) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 1) disabled @endif @endforeach @endif>Monday</option> 
                                      <option value="2" @if($day[$key3] == 2) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 2) disabled @endif @endforeach @endif>Tuesday</option>  
                                      <option value="3" @if($day[$key3] == 3) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 3) disabled @endif @endforeach @endif>Wednesday</option> 
                                      <option value="4" @if($day[$key3] == 4) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 4) disabled @endif @endforeach @endif>Thursday</option> 
                                      <option value="5" @if($day[$key3] == 5) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 5) disabled @endif @endforeach @endif>Friday</option>  
                                      <option value="6" @if($day[$key3] == 1) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 6) disabled @endif @endforeach @endif>Saturday</option> 
                                      <option value="0" @if($day[$key3] == 0) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 0) disabled @endif @endforeach @endif>Sunday</option>   
                                      </select><br>
                                      @error('day.'.$key3)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                    </div>
                                  </div>
                                  
                                  <div class="form-group row">
                                    @php
                                        $time_from = date('H:', strtotime($from[$key3]));
                                        $time_to = date('H:',strtotime($to[$key3]));
                                        $convert_time_from = strval($time_from).'00';
                                        $convert_time_to = strval($time_to).'00';
                                        $time_diff[] = abs(strtotime($convert_time_from) - strtotime($convert_time_to))/3600;
                                     @endphp
                                    <span class="col-md-12 text-info">Note: Remember to reselect based on your updated time rage.</span>
                                    <label class="col-sm-3 col-form-label font-14 mt-2">Limit per booking</label>
                                     <div class="col-sm-9 selectgroup w-100 mt-3">
                                      @if ($time_diff[$key3] >= 1)
                                        <label class="selectgroup-item">
                                           <input type="radio" wire:model.defer="time_limit.{{$key3}}" value="1" class="selectgroup-input-radio">
                                          <span class="selectgroup-button">Once</span>
                                        </label>
                                      @endif
                                      @if($time_diff[$key3] >= 2)
                                        <label class="selectgroup-item">
                                          <input type="radio" wire:model.defer="time_limit.{{$key3}}" value="2" class="selectgroup-input-radio">
                                          <span class="selectgroup-button">Twice</span>
                                        </label>
                                      @endif
                                      @if($time_diff[$key3] >= 3)
                                        <label class="selectgroup-item">
                                          <input type="radio" wire:model.defer="time_limit.{{$key3}}" value="3" class="selectgroup-input-radio">
                                          <span class="selectgroup-button">Thrice</span>
                                        </label>
                                      @endif
                                        @error('time_limit.'.$key3)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                     </div>
                                  </div>
                               </div>
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label for="time" class="col-sm-3 mt-2 font-14">Time</label>
                                     <div class="form-row col-sm-9">
                                      
                                       <div class="form-group col-sm-6">
                                          <label for="">From</label>
                                           <input type="time" placeholder="From" class="form-control" wire:model="from.{{$key3}}">
                                           @error('from.'.$key3)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                        </div>
                                       <div class="form-group col-sm-6">
                                        <label for="">To</label>
                                           <input type="time" placeholder="To" class="form-control" wire:model="to.{{$key3}}">
                                           @error('to.'.$key3)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                       </div>
                                       @if($time_diff[$key3] == 0)
                                          <span class="text-danger ml-2">Schedule time "From" and "To" cant't be same!</span>
                                       @endif
                                       <span class="text-info font-bold ml-2">
                                        Note:Default schedule times should be in "00" minutes,
                                        The system will use default if other wise.
                                      </span>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <input type="hidden" wire:model="schedule_id.{{$key3}}">
                                  </div>

                                </div>
                                <div class="text-right">
                                   <button wire:click.prevent="add({{$i}})" class="button_btn font-14 mr-3"><i class="fa fa-plus"></i> Add More</button>
                                   <!-- <input type="hidden" value="schedule" name="tab_name"> -->
                                </div>
                             <!-- </form> -->
                              @endforeach

                              @else
                             
                              <!-- more schedule -->
                                @include('teachers.dynamic_form.more_schedule')
                              <!-- more schedule -->

                              @endif
                              <!-- add schedule ends -->
                              <div class="col-md-12 text-right mb-5 mt-5">
                                <a href="{{ route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                                 @if ($dynamic_schedule == 0)
                                   <button class="primary btn-lg pull-right ml-5" wire:click="updateSchedule" type="button">Save Change</button>
                                 @else 
                                    <button class="primary btn-lg pull-right ml-5" wire:click="moreSchedule" type="button">Save</button>
                                @endif
                              </div>
                            </div>
                        </div>
                     </section> 
                  </div>  
                  <!-- tab 4 ends -->
                  <!-- tab 5 start -->
                  <div class="tab-pane fade @if(Session::get('tab_pane') == 'password') show active @endif" id="password" role="tabpanel" aria-labelledby="password-tab">
                   <section>
                    <form class="needs-validation" novalidate="" enctype="multipart/form-data">

                      <div class="card-body">
                        <div class="text_color">
                         <h4 class="text_color ">Password</h4>
                         <p>Change your password to protect your account</p>
                        </div>
                        <div class="row mt-4">
                          <div class="col-md-7">
                            <div class="form-group">
                                <label for="" class="col-form-label font-14">Current Password</label>
                                <input type="password" class="form-control" placeholder="Current Password" wire:model.defer="current_password" required>
                                 @error('current_password')
                                   <p class="text-danger font-13 text-capitalize">{{$message}}</p>
                                 @enderror
                             </div>
                              
                             <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="" class="col-form-label font-14">New Password</label>
                                 <input type="password" class="form-control" placeholder="New Password" wire:model.defer="new_password" required>
                                 @error('new_password')
                                  <p class="text-danger font-13 text-capitalize">{{$message}}</p>
                                 @enderror
                                </div>
                                
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="password" class="col-form-label font-14">Confirm new Password</label>
                                 <input type="password" class="form-control" placeholder="Confirm new Password" wire:model.defer="confirm_password" required>
                                  @error('confirm_password')
                                  <p class="text-danger font-13 text-capitalize">{{$message}}</p>
                                 @enderror
                                </div>
                               
                              </div>
                            </div>
                          </div>
                         </div><hr>
                           <div class="text-right mb-5">
                            <a href="{{  route('teachers-dashboard')}}" class="btn btn-default btn-lg mr-4">Cancel</a>
                            <input type="hidden" value="password" name="tab_pane">
                            <button class="primary btn-lg" wire:click.prevent="updatePassword({{$user->id}})">Save</button>
                          </div>
                      </div>
                    </form>
                  </section>
                  </div>
                  <!-- tab5 ends -->
                  <!-- tab 6 start -->
                  <div class="tab-pane fade @if(Session::get('tab_pane') == 'notification') show active @endif"  id="notification" role="tabpanel" aria-labelledby="notification-tab">
                    <div class="card-body">
                     <form>
                       <div class="">
                         <h4 class="font-16 font-weight-bold">Notification</h4>
                         <span class="font-12">Get notified on what you want to see</span>
                       </div><hr>
                       <div class="mt-4">
                         <h5 class="font-14">By Email</h5>
                          <label class="check-box mt-3">
                             <input type="checkbox" wire:model.defer="message" class="custom-chechbo" id="messages">
                             <span class="font-14">Messages</span> <br>
                             <span class="checkmark"></span>
                             <span class="font-14">Get notified when your student messages you.</span>
                          </label>  
                         <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="activities" class="custom-chechbox" id="activities">
                            <span class="font-14">Account Activities</span> <br>
                            <span class="font-14">Get notified whenever there is an activity on your dashboard.</span>
                            <span class="checkmark"></span>
                          </label>

                         <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="offers" class="custom-chechbox" id="offer">
                             <span class="font-14">Offers</span> <br>
                            <span class="font-14">Get notified when a student accepts or rejects an offer.</span>
                            <span class="checkmark"></span>
                          </label>

                          <div class="mt-5">
                            <h4 class="font-16 font-weight-bold">Push Notifications</h4>
                            <span class="font-12">These are delivered via SMS to your mobile phone.</span>
                          </div>

                         <label class="check-box mt-3">
                              <input type="checkbox" wire:model.defer="everything" class="custom-chechbox" id="everything">
                              <span class="ml-2 font-14">Everything</span>
                              <span class="checkmark"></span>
                            </label>

                         <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="send_as_email" class="custom-chechbox" id="send_as_email">
                            <span class="ml-2 font-14">Same as email</span>
                            <span class="checkmark"></span>
                          </label>

                         <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="no_push" class="custom-chechbox" id="no_push">
                            <span class="ml-2 font-14">No push notifications</span>
                            <span class="checkmark"></span>
                          </label>
                        </div><hr>
                        <div class="text-right">
                             <a href="{{ route('teachers-dashboard')}}" class="btn btn-default mr-3">Cancel</a>
                            <button class="primary btn-lg" wire:click.prevent="updateGeneralSettings({{$user->id}})">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- tab 6 end -->
                  @if($msg_display == 0)
                    @if(Session::has('message'))
                        <div class="alert alert-success col-md-6 meesage_alert">
                        <p class="text-white text-capitalize font-14 font-weight-600"> {{Session::get('message')}}  <i class="fa fa-check"></i></p> 
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger col-md-6 meesage_alert">
                        <p class="text-white text-capitalize font-14 font-weight-600"> {{Session::get('error')}}</p> 
                        </div>
                    @endif
                  @endif
                </div>
              </div>
           </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

@push('scripts')
<script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
<script>
  @if($dynamic_qualify == 0 && $dynamic_cert == 0)
  @foreach ($education_infos as $key =>$education)
    $(document).ready(function() {
            window.universitySelect=()=>{
                $('#selectUniversity_{{$key}}').select2({
                    placeholder: 'Select University / College',
                    allowClear: true});
                   
              $('#selectUniversity_{{$key}}').on('change', function (e) {
                    var data = $('#selectUniversity_{{$key}}').select2("val");
                    @this.set('university.{{$key}}', data);
              });
            }
            universitySelect();
            window.livewire.on('loadUniversity',()=>{
                universitySelect();
            });
         });
    @endforeach
   @endif

      //state multiple select
      $(document).ready(function() {
          window.stateSelect=()=>{
              $('#selectState').select2({
                  placeholder: 'Select State',
                  allowClear: true});
                
            $('#selectState').on('change', function (e) {
                  var data = $('#selectState').select2("val");
                  @this.set('state', data);
            });
          }
          stateSelect();
          window.livewire.on('loadState',()=>{
              stateSelect();
          });

      });

     //subject multiple select
      $(document).ready(function() {
        window.selectsubjects=()=>{
            $('#Select_subject').select2({
                placeholder: 'Select Subject',
                allowClear: true});

          
          $('#Select_subject').on('change', function (e) {
                var data = $('#Select_subject').select2("val");
                @this.set('subjects', data);
          });
        }
        selectsubjects();
        window.livewire.on('loadSubject',()=>{
          selectsubjects();
        });

    });

    // level multiple select
    $(document).ready(function() {
        window.selectLevel=()=>{
            $('#select_levels').select2({
                placeholder: 'Select Subject',
                allowClear: true});

          
          $('#select_levels').on('change', function (e) {
                var data = $('#select_levels').select2("val");
                @this.set('levels', data);
          });
        }
        selectLevel();
        window.livewire.on('loadLevels',()=>{
          selectLevel();
        });

    });

</script>

 

@endpush
