<div>

  @if ($currentStep == 1)
  <div class="text-left mt-4">
    <a href="{{ route('teachers-form1')}}" class="button_btn"><i class="fas fa-angle-left"></i> back</a>
  </div>
@endif

 <div class="card-wizard mt-2">
   @if($currentStep == 5)
   <div class="auth-header card-body text-left mt-4 ml-4">
     <h4>Preview Profile</h4>
    </div> 
   @else
     <div class="auth-header text-left mt-4 ml-4">
     @if(Session::has('message'))
        @include('back-layout.error')
     @endif
        <h4 class="font-20 ml-4">Continue filling out your form</h4>
     </div>
    @endif
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="mt-2">
             <div class="card-body">
               <!-- livewire wizard starts  -->
                   
                     @if(Session::has('message'))
                        <div class="alert alert-success">
                          <p class="text-white text-capitalize font-16 font-weight-600"><i class="fa fa-check"></i> {{Session::get('message')}}</p> 
                        </div>
                      @endif
                   

                     @if ($currentStep == 5)
                      <div class="stepwizard">
                          <!-- <div class="stepwizard-row setup-panel">
                          </div> -->
                      </div>
                      @else
                      <div class="stepwizard step_wizard">
                          <div class="stepwizard-row setup-panel">
                              <div class="multi-wizard-step step-adjust">
                                  <a href="#step-1" type="button"
                                      class="btn ml-4 mr-1 {{ $currentStep != 1 ? ' btn-secondary link-radius' : 'btn-primary link-radius' }} @if($currentStep >= 1) btn-primary @endif">1</a>
                                  <span> Personal Information <i class="font-18 ml-3 fa fa-angle-right"></i></span>
                              </div>
                              <div class="multi-wizard-step step-adjust">
                                  <a href="#step-2" type="button"
                                      class="btn mr-2 {{ $currentStep != 2 ? ' btn-secondary link-radius' : 'btn-primary link-radius' }} @if($currentStep >= 2) btn-primary @endif">2</a>
                                     <span> Professional Information <i class="font-18 ml-3 fa fa-angle-right"></i></span>
                              </div>
                              <div class="multi-wizard-step step-adjust">
                                  <a href="#step-3" type="button"
                                      class="btn mr-2 {{ $currentStep != 3 ? ' btn-secondary link-radius' : 'btn-primary link-radius'}} @if($currentStep >= 3) btn-primary @endif" disabled="disabled">3</a>
                                      <span> Educations <i class="font-18 ml-3 fa fa-angle-right"></i></span>
                              </div>
                              <div class="multi-wizard-step">
                                  <a href="#step-4" type="button"
                                      class="btn mr-2 {{ $currentStep != 4 ? ' btn-secondary link-radius' : 'btn-primary link-radius'}} @if($currentStep >= 4) btn-primary @endif" disabled="disabled">4</a>
                                     <span>Schedules <i class="font-18 ml-3 fa fa-angle-right"></i></span>
                              </div>
                          </div>
                      </div>
                      @endif
                      <!-- Step 1 -->
                      <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
                     
                        @if ($currentStep == 1 && $personal_infos->profile_photo !== null)

                           @include('teachers.profile-forms.back.step_1')

                         @elseif(empty($personal_infos->profile_photo))
                         <div class="col-md-12">
                           <section>
                              <!-- Personal Information start-->
                              <div class="card-body mt-3">
                              <div class="text_color">
                                  <h4>Personal Information</h4>
                                  <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                              </div>
                            
                              <div class="row mt-5">
                               <div class="col-md-6">
    
                              <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Address</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="address" wire:model="address" placeholder="Address">
                                      @error('address') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                  </div>
                              </div>

                              <div class="form-group row" wire:ignore>
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Country</label>
                                  <div class="col-sm-9">
                                     <select wire:model="country" wire:click="display_state" id="frontCountry" class="form-control">
                                        <option value="">Select Country</option>
                                         @foreach ($countries->chunk(20) as $group)
                                           @foreach ($group as $country)
                                            <option  value="{{$country->name}}" >{{$country->name}}</option> 
                                           @endforeach
                                          @endforeach
                                      </select>
                                       @error('country') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                  </div>
                               </div>
                              @if (isset($country))
                                    <?php
                                      $country = App\Models\Country::where('name','like', "%{$this->country}%")->first();
                                      $states = App\Models\State::where('country_id',$country->id)->get();
                                      $display_country = 1;
                                    ?>
                                  @endif

                              <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Gender</label>
                                  <div class="col-sm-9">
                                      <select  wire:model="gender" class="custom-select">
                                       <option value="">Select Gender</option>
                                       <option value="Male">Male</option>
                                       <option value="Female">Female</option>
                                      </select>
                                      @error('gender') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Means of Identifcation</label>
                                  <div class="col-sm-9">
                                      <div x-data="{ isUploading: false, progress: 0}" 
                                          x-on:livewire-upload-start="isUploading = true; progress: 5"
                                          x-on:livewire-upload-finish="isUploading = false"
                                          x-on:livewire-upload-error="isUploading = false"
                                          x-on:livewire-upload-progress="progress = $event.detail.progress"
                                          >
                                          <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg" wire:model="means_of_ID" id="means_of_ID">
                                          <div x-show="isUploading" class="mt-2">
                                            <progress max="100" x-bind:value="progress"></progress><br>
                                            <span class="badge badge-info">pls... wait for the upload to complete before you proceed!</span>
                                          </div>
                                          
                                      </div>
                                      <p class="text-gray">This can be your national ID, Drivers license or internaltional passport
                                        <br><span class="text-gray">Note: Means of ID must not be greater than 5mb</span>
                                       </p>
                                       @error('means_of_ID') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                       @if ($currentStep == 1 && $means_of_ID)
                                          Preview: <br>
                                          <img src="{{ $means_of_ID->temporaryUrl() }}" class="image_fit" height="170" width="214">
                                       @endif
                                  </div>
                              </div>
                            </div>
                              
                             <div class="col-md-6">
                               <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Town</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="town" wire:model="town"  placeholder="Town">
                                      @error('town') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                  </div>
                              </div>

                              @if($display_country == 1)  
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">State</label>
                                   <div class="col-sm-9">
                                     <select id="state" wire:model="state"  class="custom-select">
                                        @if ($states->count() == 0)
                                         <option value="">No State Found! </option>
                                          @else
                                          <option value="">Select State</option>
                                          @foreach ($states->chunk(20) as $groups)
                                            @foreach ($groups as $state)
                                              <option value="{{$state->name}}">{{$state->name}}</option> 
                                            @endforeach
                                          @endforeach
                                        @endif
                                      </select>
                                      @error('state') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                    </div>
                                  </div>
                                @endif
                              
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label font-14">D.O.B</label>
                                  <div class="col-sm-9">
                                      <input type="date" class="form-control" id="d_o_b" wire:model="d_o_b"  placeholder="Date of Birth">
                                      @error('d_o_b') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                  </div>
                              </div>
                                 
                             
                               
                              <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Profile Photo</label>
                                    <div class="col-sm-9">
                                      <!-- <input type="file" class="form-control-file"  accept="image/png, image/gif, image/jpeg" wire:model="profile_photo" id="profile_photo"> -->
                                      <!-- <div wire:loading wire:target="profile_photo" class="text-info font-14 mt-1">Uploading Pls Wait...
                                      <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                                          width="20px" height="20px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                          <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                          <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
                                          </path>
                                        </svg>
                                      </div> -->
                                      <div x-data="{ isUploading: false, progress: 0 }" 
                                          x-on:livewire-upload-start="isUploading = true"
                                          x-on:livewire-upload-finish="isUploading = false"
                                          x-on:livewire-upload-error="isUploading = false"
                                          x-on:livewire-upload-progress="progress = $event.detail.progress"
                                          >
                                          <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg" wire:model="profile_photo" id="profile_photo">
                                          <div x-show="isUploading" class="mt-2">
                                            <progress max="100" x-bind:value="progress"></progress><br>
                                            <span class="badge badge-info">pls... wait for the upload to complete before you proceed!</span>
                                           </div>
                                          
                                      </div>
                                    <p class="text-gray">Note: Photo must not be greater than 5mb</p>
                                    @error('profile_photo') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                    <div class="mt-3">
                                      @if ($currentStep == 1 && $profile_photo)
                                          Preview: <br>
                                          <img src="{{ $profile_photo->temporaryUrl() }}" class="image_fit" height="170" width="214">
                                      @endif
                                    </div>
                                  </div>
                               </div>
                             </div>
                            </div>
                          </div>
                          <div class="card-footer text-left">
                              <a href="{{ route('redirect')}}" class="btn btn-outline-secondary">Skip to Dashboard <i class="fa fa-forward-fast"></i></a>
                              <button class="primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">Next</button>
                           </div>
                          </section>
                        </div>
                       @endif
                      </div>
                  
                      <!-- Step 1 -->
                      <!-- Step 2 -->
                      <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
                        <div class="col-md-12">
                            <section>
                              <div class="card-body mt-3">
                                <div class="text_color">
                                  <h4>Professional Information</h4>
                                  <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                                  </div>
                                   <div class="row mt-5">
                                  
                                   @if ($currentStep == 2 && !empty($pro_infos->about))

                                      @include('teachers.profile-forms.back.step_2')

                                   @elseif(empty($pro_infos->about))
                                     <div class="col-md-12">
                                      <div class="form-group row">
                                          <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
                                          <div class="col-sm-9">
                                            <textarea id="about" wire:model="about" class="form-control" cols="80"  rows="8" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you."></textarea>
                                            @error('about')<div class="text-danger font-13 text-capitalize"> {{$message}} </div>@enderror
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Experiences:</label>
                                          <div class="col-sm-9">
                                            <textarea id="experience" wire:model="experience" class="form-control" cols="80" rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others."></textarea>
                                            @error('experience')<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Introduction video:</label>
                                          <div class="col-sm-9">
                                              <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                                  x-on:livewire-upload-finish="isUploading = false"
                                                  x-on:livewire-upload-error="isUploading = false"
                                                  x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                  <input type="file" class="form-control-file"  accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*" wire:model="onboading_video" id="onboading_video">
                                                  <div x-show="isUploading" class="mt-2">
                                                    <progress max="100" x-bind:value="progress"></progress> <br>
                                                    <span class="badge badge-info">pls... wait for the upload to complete before you proceed!</span>
                                                  </div>
                                                </div>
                                                <span>Upload a one minutes introduction video of your self.</span><br>
                                                <span class="text-gray mt-2">Note: Video size must not be more than 10mb.</span>
                                                  @if ($onboading_video)
                                                   <div class="mt-0">
                                                    <video src="{{ $onboading_video->temporaryUrl() }}" height="180" width="250" controls></video>
                                                   </div>
                                                   @endif
                                                @error('onboading_video')<div class="text-danger font-13 text-capitalize"> {{$message}} </div> @enderror
                                           </div>
                                        </div>
                                     </div>
                                  @endif
                                   </div>
								                  </div>
                               </section>
                              <button class="primary nextBtn btn-lg pull-right ml-5" type="button" wire:click="secondStepSubmit">Next</button>
                             <button class="btn btn-default nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                         </div>
                       </div>
                      <!-- step 2 -->
                      <!-- step 3 -->
                       <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
                        @if ($currentStep ==  3 && $cert_infos->count() > 0 && $education_infos->count() > 0)
                           @include('teachers.profile-forms.back.step_3')
                        @elseif($cert_infos->count() == 0 && $education_infos->count() == 0)
                        <div class="col-md-12">
                           <section>
                              <div class="card-body mt-3">
                                <div class="text_color">
                                      <h4>Education</h4>
                                      <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                                      </div>
                                      <!-- Qualification start -->
                                      <div class="mt-4">
                                      <h3 class="font-16">Qualification</h3>
                                      </div>
                                      <div class="row mt-5">
                                      <div class="col-md-6">  
                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">University / College:</label>
                                              <div class="col-sm-9">
                                                  <!-- <input type="text" class="form-control" placeholder="University / College" wire:model="university.0" id="university.0"> -->
                                                    <select wire:model="university.0" class="form-control" id="front_university_0">
                                                      <option value="">Select University / College</option> 
                                                      @foreach ($universities->chunk(20) as $group)
                                                        @foreach ($group as $college)
                                                            <option value="{{$college->name}}">{{$college->name}}</option> 
                                                          @endforeach
                                                      @endforeach
                                                    </select>
                                                  @error('university.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Result:</label>
                                              <div class="col-sm-9">
                                                  <select wire:model="result.0" id="result.0" class="custom-select">
                                                      <option value="">Select Result</option> 
                                                      <option value="First class">First class</option> 
                                                      <option value="Second class">Second class</option>  
                                                      <option value="Third Class">Third Class</option> 
                                                  </select>
                                                  @error('result.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Upload File:</label>
                                              <div class="col-sm-9">
                                                 <div x-data="{ isUploading: false, progress: 0 }" 
                                                    x-on:livewire-upload-start="isUploading = true"
                                                    x-on:livewire-upload-finish="isUploading = false"
                                                    x-on:livewire-upload-error="isUploading = false"
                                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <input type="file" accept="image/png, image/gif, image/jpeg"  class="form-control-file" wire:model="qualification_upload.0"  id="qualification_upload.0">
                                                    <div x-show="isUploading" class="mt-2">
                                                      <progress max="100" x-bind:value="progress"></progress> <br>
                                                      <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                                                    </div>
                                                  </div><br>

                                                 @error('qualification_upload.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                                  @if ($qualification_upload)
                                                  Preview: <br>
                                                    <img src="{{ $qualification_upload[0]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                                                  @endif
                                              </div>
                                          </div>

                                          <div class="form-group">
                                          <label class="">
                                              <input type="checkbox" wire:model.lazy="edu_visibility.0"  class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                              <span class="custom-switch-description mt-2">Make your qualification visible</span>
                                          </label>
                                       </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Degree:</label>
                                              <div class="col-sm-9">
                                                  <select id="degree.0" wire:model="degree.0" class="custom-select">
                                                    <option value="">Select Degree</option> 
                                                    @if(isset($university[0]))
                                                      @php
                                                          $selected = App\Models\University::where('name','like', "%{$university[0]}%")->first();
                                                        @endphp 
                                                        @if($selected->degree == 1)
                                                         <option value="B.Sc">B.Sc</option> 
                                                          <option value="M.SC">M.SC</option>  
                                                          <option value="Undergraduate">Undergraduate</option>   
                                                          <option value="Postgraduate">Postgraduate</option>  
                                                      @else
                                                          <!-- <option value="O Level">O Level</option>  -->
                                                          <option value="HND">HND</option> 
                                                          <option value="ND">ND</option> 
                                                      @endif  
                                                   @endif
                                                  </select><br>
                                                  @error('degree.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>  
                                          </div>

                                          <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Passing Year:</label>
                                              <div class="col-sm-9">
                                                  <input type="month" class="form-control" placeholder="Passing Year" wire:model="passing_year.0" id="passing_year.0">
                                                  @error('passing_year.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>
                                          <div class="float-right mt-3">
                                        <button class="btn btn-default btn-sm font-14" wire:click.prevent="addQualification({{$i}})"><i class="fa fa-plus"></i> Add more</button>
                                      </div>
                                      </div>
                                    </div>
                            
                                      <!-- more qualifications ends -->
                                      @include('teachers.profile-forms.add_mores.qulifications')
                                      <!-- more Qualification ends -->
                                      
                                      <!-- Certification  start -->
                                    <div class="mt-4">
                                     <hr> <h3 class="font-16">Certification</h3>
                                      </div>
                                      <div class="row mt-5">
                                      <div class="col-md-6">
                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Certificate Name</label>
                                              <div class="col-sm-9">
                                                  <input type="text" class="form-control" placeholder="Certificate Name" wire:model="title.0"  id="title.0">
                                                  @error('title.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Description</label>
                                              <div class="col-sm-9">
                                                  <!-- <input type="text" class="form-control" placeholder="Description" wire:model="description.0" id="description.0"> -->
                                                  <textarea id="experience" wire:model="description.0" id="description.0" class="form-control" cols="80" rows="5" placeholder="Description"></textarea>
                                                  @error('description.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="">
                                            <input type="checkbox" wire:model.defer="cert_visibility.0"  class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description mt-2">Make your Certification visible</span>
                                            </label>
                                          </div>

                                        </div>

                                      <div class="col-md-6">
                                      <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Issued Date</label>
                                              <div class="col-sm-9">
                                                  <input type="month" class="form-control"  wire:model="issued.0" placeholder="Issued" id="issued.0">
                                                  @error('issued.0') <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Upload File:</label>
                                              <div class="col-sm-9">
                                              
                                                  <div x-data="{ isUploading: false, progress: 0 }" 
                                                      x-on:livewire-upload-start="isUploading = true"
                                                      x-on:livewire-upload-finish="isUploading = false"
                                                      x-on:livewire-upload-error="isUploading = false"
                                                      x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                      <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file" wire:model="certification_upload.0" id="certification_upload.0" >
                                                      <div x-show="isUploading" class="mt-2">
                                                          <progress max="100" x-bind:value="progress"></progress> <br>
                                                          <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                                                      </div>
                                                  </div><br>
                                                    @error('certification_upload.0')<span class="text-danger mr-5">{{$message}}</span>@enderror
                                                    @if ($certification_upload)
                                                    Preview: <br>
                                                    <img src="{{ $certification_upload[0]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                                                  @endif
                                              </div>
                                            </div>
                                          <div class="float-right mt-3 mb-5">
                                            <button class="btn btn-default btn-sm font-14" wire:click.prevent="addCertification({{$i}})"> <i class="fa fa-plus"></i> Add more</button>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- more certifications -->
                                      @include('teachers.profile-forms.add_mores.certifications')
                                      <!-- more certifications ends -->

                                      
                                      <!-- Certification ends -->
                                  </div>
                                </section>
                               <div class="card-body ">
                                <button class="primary btn-lg pull-right ml-5" wire:click="thirdStepSubmit" type="button">Next</button>
                                <button class="btn btn-default nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
                             </div>
                          </div>
                       @endif
                      </div>
                  <!-- step 3 -->
                  <!-- step 4 -->
                  <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
                     <div class="col-md-12">
                          <section>
                           <div class="card-body mt-3">
                                <div class="text_color mr-4">
                                    <h4 class="mt-2">Schedule</h4>
                                    <p>Pick the days you would be available as well as the time.</p>
                                  </div> 
                                  @if ($currentStep ==  4 && !empty($subjects_infos->title)  && $schedules_infos->count() > 0)

                                    @include('teachers.profile-forms.back.step_4')

                                  @elseif(empty($subjects_infos->title) && $schedules_infos->count() == 0)
                                   <div class="row mt-5">
                                    <div class="col-md-6">
                                      <div class="form-group row" wire:ignore>
                                        <label class="col-sm-3 col-form-label font-14">Subjects</label>
                                          <div class="col-sm-9">
                                            <select wire:model="subjects" class="form-control" id="select2" multiple="multiple" >
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
                                     
                                  <!-- seleced subjects -->
                                    <div class="form-group row">
                                     @php  $count = 1; @endphp
                                      @if(isset($subjects))
                                        <label for="subjects" class="col-sm-3 col-form-label font-14">Selected Subjects:</label>
                                      @else
                                        <label for="subjects" class="col-sm-3 col-form-label font-14"> </label>
                                      @endif
                                      <div class="col-sm-9">
                                        @if(isset($subjects))
                                          @foreach ($subjects as $subject)
                                           <span class="font-14"> {{$count++}}. {{$subject}} </span> <br>
                                          @endforeach
                                        @endif
                                        <input type="hidden" wire:model="subjects" class="form-control" 
                                            value="@if(isset($subjects))
                                              @foreach ($subjects as $subject)
                                                {{$subject}} 
                                              @endforeach
                                            @endif" readonly>
                                          @error('subjects')<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                                         </div>
                                       </div>
                                     <!-- seleced subjects ends-->
                                   </div>
                                  <div class="col-md-6">
                                   <div class="form-group row">
                                     <label for="category" class="col-sm-3 col-form-label font-14">Levels</label>
                                      <div class="col-sm-9">
                                          <select id="levelSelect" wire:model="levels" class="form-control" multiple="multiple">
                                              <option value="">Select Level</option> 
                                              @foreach ($categories as $category)
                                                <option value="{{$category->title}}">{{$category->title}}</option>   
                                              @endforeach
                                            </select><br>
                                            @error('levels')<span class="text-danger font-13 text-capitalize">{{$message}}</span>@enderror
                                      </div>
                                    </div>
                                  </div>

                                  <!-- add schedule -->
                                 {{-- @foreach($schedule as $key2 => $value) --}}
                                  <div class="card-body">
                                    <div class="text_color mb-3">
                                      <h4 class="font-16">Add Schedule</h4>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 mt-3">
                                        <div class="form-group row" wire:ignore>
                                          <label for="day" class="col-sm-3 col-form-label font-14">Day</label>
                                           <div class="col-sm-9">
                                            <select wire:model="day" class="form-control" id="dayselect" multiple="multiple">
                                                <option value="1">Monday</option> 
                                                <option value="2">Tuesday</option>  
                                                <option value="3">Wednesday</option> 
                                                <option value="4">Thursday</option> 
                                                <option value="5">Friday</option>  
                                                <option value="6">Saturday</option> 
                                                <option value="0">Sunday</option>   
                                             </select><br>
                                            </div>
                                          </div>
                                        <span class="col-sm-4 ml-5"></span>
                                      </div>
                                      <div class="col-md-5 text-right">
                                         @error('day') <span class="text-danger col-sm-9 ml-5 font-13 text-capitalize error">{{$message}}</span>@enderror
                                      </div>
                                     
                                   <div class="row">
                                    @if(isset($day))
                                     @foreach ($day as $key2 => $days)
                                      <div class="col-md-6">
                                       <div class="form-group row">
                                           @php
                                              if(isset($from[$key2]) && isset($to[$key2]))
                                              {
                                                $time_from = date('H:', strtotime($from[$key2]));
                                                $time_to = date('H:',strtotime($to[$key2]));
                                                $convert_time_from = strval($time_from).'00';
                                                $convert_time_to = strval($time_to).'00';
                                                $time_diff[] = abs(strtotime($convert_time_from) - strtotime($convert_time_to))/3600;
                                              }
                                           @endphp
                                          <span class="col-md-12 text-info">Note: Remember to Reselect time limit if you updated schedule time.</span>
                                          <label class="col-sm-3 col-form-label font-14 mt-2">Limit per booking for:
                                            <span class="font-bold text-center font-14"> 
                                              @if ($days == 1) Monday
                                                @elseif ($days == 2) Tuesday  @elseif ($days == 3) Wednesday @elseif ($days == 4) Thursday
                                                @elseif ($days == 5) Friday @elseif ($days == 6) Saturday @elseif ($days == 0) Sunday
                                              @endif
                                           </span>
                                          </label>
                                         <div class="col-sm-9 selectgroup w-100 mt-3">
                                          @if (isset($time_diff[$key2]))
                                            @if ($time_diff[$key2] >=1)
                                              <label class="selectgroup-item">
                                                <input type="radio" wire:model="time_limit.{{ $key2 }}" value="1" class="selectgroup-input-radio">
                                                <span class="selectgroup-button">Once a day</span>
                                              </label>
                                            @endif
                                            @if ($time_diff[$key2] >=2)
                                              <label class="selectgroup-item">
                                                <input type="radio" wire:model="time_limit.{{ $key2 }}" value="2" class="selectgroup-input-radio">
                                                <span class="selectgroup-button">Twice a day</span>
                                              </label>
                                            @endif
                                            @if ($time_diff[$key2] >=3)
                                              <label class="selectgroup-item">
                                                <input type="radio" wire:model="time_limit.{{ $key2 }}" value="3" class="selectgroup-input-radio">
                                                <span class="selectgroup-button">Thrice a day</span><br>
                                              </label>
                                           @endif
                                          @endif
                                         </div>
                                         <span class="col-sm-2  ml-2"></span>
                                         @error('time_limit.'.$key2) <span class="text-danger error font-13 ml-5 text-capitalize font-13 text-capitalize">{{ $message }}</span>@enderror
                                       </div>
                                     </div>
                                     <div class="col-md-6">
                                     <div class="form-group row">
                                            <label for="inputEmail4" class="col-sm-3 font-14 mt-2">Time for:
                                                <span class="font-bold text-center font-14"> 
                                                  @if ($days == 1) Monday
                                                    @elseif ($days == 2) Tuesday @elseif ($days == 3) Wednesday @elseif ($days == 4) Thursday
                                                    @elseif ($days == 5) Friday @elseif ($days == 6) Saturday @elseif ($days == 0) Sunday
                                                  @endif
                                                </span>
                                            </label><br>
                                            <div class="form-row col-sm-9">
                                              <div class="col-md-6">
                                                 <label class="font-14">From</label> 
                                                 <input type="time" wire:model="from.{{ $key2 }}" placeholder="From" class="form-control col-sm-12">
                                                @error('from.'.$key2) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{ $message }}</span>@enderror
                                              </div>
                                              <div class="form-group col-md-6">
                                                 <label class="font-14">To</label>
                                                 <input type="time" wire:model="to.{{ $key2 }}" placeholder="To" class="form-control col-sm-12">
                                                 @error('to.'.$key2) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{ $message }}</span>@enderror
                                              </div>
                                              @if (isset($time_diff[$key2]))
                                                @if($time_diff[$key2] == 0)
                                                  <span class="text-danger ml-2">Schedule time "From" and "To" cant't be same!</span>
                                                @endif
                                             @endif
                                            <span class="text-info font-bold ml-2">
                                               Note:Default schedule times should be in "00" minutes,
                                              The system will use default if other wise.
                                            </span>
                                          </div>
                                        </div>

                                        
                                   
                                    </div> 
                                    @endforeach
                                   
                                     
                                   @endif
                                  </div>
                                  <!-- add more schedule -->
                                    
                                  <!-- add schedule ends -->
                                  
                                  <div class="col-md-12 text-right card-bod mt-3">
                                    <button class="primary btn-lg float-right ml-5" wire:click="fouthStepSubmit" type="button">Preview!</button>
                                    <button class="btn btn-default nextBtn btn-lg float-right" type="button" wire:click="back(3)">Back</button>
                                     @if ($currentStep == 4)
                                      @if(Session::has('error'))
                                      <div class="alert alert-danger col-md-7">
                                          <p class="text-white text-capitalize font-16 font-weight-600"><i class="fa fa-check"></i> {{Session::get('error')}}</p> 
                                      </div>
                                      @endif
                                    @endif 
                                  </div>
                                </div>
							                </div>
                              {{-- @endforeach --}}
                            @endif
                          </div>
                        </section>
                      </div>
                    </div>
                     <!-- step 4 ends-->
                      <!-- preview -->
                      <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
                        <div class="col-md-12">
                            <section class="section">
                              <div class="container">
                                  <div class="row">
                                    <div class="col-12 col-md-12">
                                      <div class="car ">
                                        <!-- <div class="auth-header text-left mt-4 ml-4">
                                          <h4>Preview Profile</h4>
                                          </div> -->
                                          <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            
                                              <div class="card-body">
                                                <form action="">
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                    <div class="card-body">
                                                      <img src="{{ asset($personal_infos->profile_photo )}}" class="image_fit" height="200" width="250" alt="photo">
                                                    <div class="text-center mr-4 text-color">
                                                      <span class="mt-2 font-20 text-capitalize">{{$users_infos->first_name." ".$users_infos->last_name}}</span> <br>
                                                      <span class="font-16">{{$personal_infos->town .", " . $personal_infos->state}}</span><br>
                                                      <span class="text_color font-20">
                                                        @if ($hourly_pay !== null)
                                                          ₦{{$hourly_pay->amount}} / hr
                                                        @endif
                                                      </span>
                                                  </div>
                                                  <div class="mt-1 mb-4">
                                                    @if ($subjects_infos !== null)
                                                      <p class="font-16 font-weight-600 text_color">Subjects:</p>
                                                      @foreach (json_decode($subjects_infos->title) as $subject)
                                                          <span class="">{{$subject}},</span>
                                                      @endforeach
                                                    @endif
                                                  </div>
                                                  <span class="font-16 font-weight-600 text_color">Schedule:</span><br>
                                                     @foreach ($schedules_infos as $schedule)
                                                      <div class="mt-3">
                                                        <span>
                                                          @if ($schedule->day == 1) Monday: @elseif ($schedule->day == 2) Tuseday: @elseif ($schedule->day == 3) Wednesday: @elseif ($schedule->day == 4) Thursday:
                                                          @elseif ($schedule->day == 5)  Friday:  @elseif ($schedule->day == 6)  Saturday: @elseif ($schedule->day == 0)  Sunday:  @endif
                                                          <span class="float-right"> {{date('h:i a', strtotime($schedule->from)).' - '.date('h:i a' , strtotime($schedule->to)) }} </span>
                                                        </span><br>
                                                        <span class="font-14 text-capitalize">limit: <span class="float-right">@if($schedule->time_limit == 1) Once a day @elseif($schedule->time_limit == 2) Twice a day @elseif($schedule->time_limit == 3) Thrice a day @endif</span></span><br>
                                                      </div>
                                                    @endforeach  
                                                </div>
                                              </div>
                                              <div class="col-md-8">
                                                  <div class="card-body">
                                                @if($pro_infos !== null)
                                                  <div class="video_text">
                                                      <p class="font-16 font-weight-600 text_color">Personal Introduction</p>
                                                      <video class="video_fit" src="{{ asset($pro_infos->onboading_video)}}" height="260" width="500" controls></video>
                                                  </div><hr>
                                                  <div class="mt-4">
                                                      <p class="font-16 font-weight-600 text_color">About</p>
                                                      <p class="">{{$pro_infos->about}}</p>
                                                  </div><hr>
                                                  <div class="mt-4">
                                                      <p class="font-16 font-weight-600 text_color">Experiences</p>
                                                      <p class="">{{$pro_infos->experience}}</p>
                                                  </div><hr>
                                                @endif
                                                  @php $countq = 1;@endphp
                                                  <div class="">
                                                    @foreach ($education_infos as $education)
                                                      <div class="row">
                                                        <div class="col-md-5">
                                                          <p class="font-16 font-weight-600 text_color">Education {{$countq++}}</p>
                                                          <img class="image_fit" src="{{ asset($education->upload_file)}}" height="67" width="67" alt="logo">
                                                        </div>
                                                        <div class="col-md-6 mt-5">
                                                          <p class="ml-5 h6">{{$education->university}}</p>
                                                          <p class="ml-5 mt-2 h6">{{$education->degree}}</p>
                                                          <p class="ml-5 mt-2 h6">{{$education->passing_year}}</p>
                                                        </div>
                                                      </div>
                                                      @endforeach
                                                  </div><hr>
                                                  <div class="">
                                                      @php $countc = 1;@endphp
                                                      @foreach ($cert_infos as $certification)
                                                      <div class="row">
                                                          <div class="col-md-5"> 
                                                          <div class="">
                                                          <p class="font-16 font-weight-600 text_color">Certifications {{$countc++}}</p>
                                                          <img class="image_fit" src="{{ asset($certification->upload_file)}}" height="67" width="67" alt="image">
                                                      </div>
                                                      </div>
                                                      <div class="col-md-6 mt-5">
                                                          <p class="ml-5 mt-2 h6">{{$certification->title}}</p>
                                                          <p class="ml-5 mt-2 h6">{{$certification->description}}</p>
                                                          <p class="ml-5 mt-2 h6">{{$certification->issued}}</p>
                                                          <div class="ml-5 mt-2">
                                                          <a target="_blank" href="{{ asset($certification->upload_file)}}" class="btn btn-outline-secondary link-radius">Show Certificate</a>
                                                      </div>
                                                      </div>
                                                    </div>
                                                    @endforeach
                                                    </div><hr>
                                                   </div>
                                                    <div class="card-bod">
                                                    <button type="button" class="primary btn-lg pull-right ml-5" data-toggle="modal" data-target="#exampleModal">Submit</button>
                                                    <button class="btn btn-default nextBtn btn-lg pull-right" type="button" wire:click="back(4)">Back</button>
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
							                  </div>
                              </section>
                              
                          </div>
                       </div>


               <!-- livewire wizard Ends  -->
            </div>
          </div>
       </div>
    </div>

  </div>
</div>
  
   @push('scripts')
  <script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
      <script>
          //  $(document).ready(function () {
          //     window.loadSelect2 = () => {
          //       $('#select2').select2({
          //          placeholder: '{{ __('  Select Subjects') }}',
          //          allowClear: true
          //       }); 
          //         $('#select2').on('change', function (e) {
          //           var data = $('#select2').select2("val");
          //           @this.set('subjects', data);
          //       }); 
          //     }
          //    loadSelect2();
          //      window.livewire.on('loadLevel', ()=> {
          //         loadSelect2();
          //      });
          //    });
    </script>

 


<script>
   
  $(document).ready(function() {
            window.loadsubjects=()=>{
                $('#select2').select2({
                    placeholder: 'Select Subject',
                    allowClear: true});

              
              $('#select2').on('change', function (e) {
                    var data = $('#select2').select2("val");
                    @this.set('subjects', data);
              });
            }
            loadsubjects();
            window.livewire.on('loadSubject',()=>{
              loadsubjects();
            });

        });

        $(document).ready(function() {
            window.SelectLevels=()=>{
                $('#levelSelect').select2({
                    placeholder: 'Select Level',
                    allowClear: true});
                   
              $('#levelSelect').on('change', function (e) {
                    var data = $('#levelSelect').select2("val");
                    @this.set('levels', data);
              });
            }
            SelectLevels();
            window.livewire.on('loadLevel',()=>{
                SelectLevels();
            });
       });


        $(document).ready(function() {
            window.selectDay=()=>{
                $('#dayselect').select2({
                    placeholder: 'Select days',
                    allowClear: true});
                   
              $('#dayselect').on('change', function (e) {
                    var data = $('#dayselect').select2("val");
                    @this.set('day', data);
              });
            }
            selectDay();
            window.livewire.on('loadDay',()=>{
                selectDay();
            });

        });

       
     
    @if($cert_infos->count() > 0 && $education_infos->count() > 0)
     //  load when education tab is not empty
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

      @else
      //  load when education tab is empty
        $(document).ready(function() {
            window.frontUniversitySelect=()=>{
                $('#front_university_0').select2({
                    placeholder: 'Select University / College',
                    allowClear: true});
                   
              $('#front_university_0').on('change', function (e) {
                    var data = $('#front_university_0').select2("val");
                    @this.set('university.0', data);
              });
            }
            frontUniversitySelect();
            window.livewire.on('loadFrontUniversity',()=>{
                frontUniversitySelect();
            });
         });
   
       @endif


        //  load when personal information is not empty
          $(document).ready(function() {
              window.countrySelect=()=>{
                  $('#selectCountry').select2({
                      placeholder: 'Select Country',
                      allowClear: true});
                    
                $('#selectCountry').on('change', function (e) {
                      var data = $('#selectCountry').select2("val");
                      @this.set('country', data);
                });
              }
              countrySelect();
              window.livewire.on('loadcountry',()=>{
                  countrySelect();
              });

          });

        //  load when personal information is empty
          $(document).ready(function() {
              window.frontCountrySelect=()=>{
                  $('#frontCountry').select2({
                      placeholder: 'Select Country',
                      allowClear: true});
                    
                $('#frontCountry').on('change', function (e) {
                      var data = $('#frontCountry').select2("val");
                      @this.set('country', data);
                });
              }
              frontCountrySelect();
              window.livewire.on('loadFrontCountry',()=>{
                  frontCountrySelect();
              });

          });
       
</script>
 
  @endpush
 
 
 
 
 


