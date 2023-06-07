<div class="col-md-12 yes">
   <section>
       <div class="card-body mt-3">
         @if ($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)
             <p class="font-18">Add More Qualification</p>
             <button class="btn btn-default btn-sm mt-3 font-14 mr-3" wire:click.prevent="addQualification({{$i}})"><i class="fa fa-plus"></i> Add more</button>
         @elseif($dynamic_cert == 0 || $dynamic_qualify == 0)
          <div class="text_color">
               <h4>Education</h4>
               <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
          </div>
          <!-- Qualification start -->
         @php  $count = 1 @endphp
         @foreach ($education_infos as $key =>$education)
          <div class="mt-4">
            <h3 class="font-16">Qualification {{$count++}}</h3>
          </div>
          <div class="row mt-5">
              <div class="col-md-6">  
                <div class="form-group row" wire:ignore>
                    <label for="inputPassword3" class="col-sm-3 col-form-label font-14">University / College:</label>
                    <div class="col-sm-9">
                        <select wire:model="university.{{$key}}" id="selectUniversity_{{$key}}" class="custom-select">
                            <option value="">Select University / College</option> 
                            @foreach ($universities->chunk(20) as $group)
                               @foreach ($group as $college)
                                  <option value="{{$college->name}}">{{$college->name}}</option> 
                                 @endforeach
                            @endforeach
                          </select>  
                        <!-- <input type="text"  class="form-control" placeholder="University / College" wire:model="university.{{$key}}"> -->
                        @error('university.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Result:</label>
                    <div class="col-sm-9">
                        <select wire:model="result.{{$key}}" class="custom-select">
                            <option value="">Select Result</option> 
                            <option value="First class">First class</option> 
                            <option value="Second class">Second class</option>  
                            <option value="Third Class">Third Class</option> 
                        </select>
                        @error('result.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
                            <input type="file" accept="image/png, image/gif, image/jpeg"  class="form-control-file" wire:model="qualification_upload.{{$key}}">
                            <div x-show="isUploading" class="mt-2">
                                <progress max="100" x-bind:value="progress"></progress> <br>
                                <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                            </div>
                        </div><br>
                        @error('qualification_upload.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                            Preview: <br>
                            @if (is_string($qualification_upload[$key]))
                                <img src="{{ asset($education->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                            @else
                            @if($dynamic_button == 0)
                                <img src="{{ $qualification_upload[$key]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                            @else
                                <img src="{{ asset($education->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                            @endif
                         @endif
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="">
                        <input type="checkbox" wire:model="edu_visibility.{{$key}}"  class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description mt-2">Make your qualification visible</span>
                    </label>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Degree:</label>
                        <div class="col-sm-9">
                            <select wire:model="degree.{{$key}}" class="custom-select">
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
                                    <!-- <option value="O Level">O Level</option>  -->
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
                    <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Passing Year:</label>
                        <div class="col-sm-9">
                            <input type="month" class="form-control" placeholder="Passing Year" wire:model="passing_year.{{$key}}">
                            @error('passing_year.'.$key) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                        </div>
                       
                    </div>

                    <div class="form-group">
                      <input type="hidden" wire:model="qualification_id.{{$key}}">
                    </div>

                    <div class="float-right mt-3">
                    <button class="btn btn-default btn-sm font-14 mr-3" wire:click.prevent="addQualification({{$i}})"><i class="fa fa-plus"></i> Add more</button>
                    
                 </div>
               </div>
              </div><hr>
             @endforeach
            @endif
             
                <!-- more qualifications ends -->
                    @include('teachers.profile-forms.add_mores.more_qualifications')
                <!-- more Qualification ends -->
                
            <!-- Certification  start -->
            @if ($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)
                <p class="font-18">Add More Certification</p>
                <button class="btn btn-default btn-sm font-14 mr-3" wire:click.prevent="addCertification({{$i}})"> <i class="fa fa-plus"></i> Add more</button>
              @elseif($dynamic_cert == 0 || $dynamic_qualify == 0)

              <?php $cert_count = 1 ?>

              @foreach ($cert_infos as $key2 => $cert)
              <div class="mt-4">
               <h3 class="font-16">Certification {{$cert_count++}}</h3>
              </div>
              <div class="row mt-5">
                <div class="col-md-6">
                   <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Certificate Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Certificate Name" wire:model="title.{{$key2}}">
                            @error('title.'.$key2) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Description</label>
                        <div class="col-sm-9">
                            <textarea id="experience" wire:model="description.{{$key2}}"  class="form-control" cols="80" rows="5" placeholder="Description"></textarea>
                            @error('description.'.$key2) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
                        <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Issued Date</label>
                        <div class="col-sm-9">
                            <input type="month" class="form-control" wire:model="issued.{{$key2}}" placeholder="Issued">
                            @error('issued.'.$key2) <span class="text-danger error font-13 text-capitalize">{{$message}}</span>@enderror
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
                                <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control-file" wire:model="certification_upload.{{$key2}}">
                                <div x-show="isUploading" class="mt-2">
                                    <progress max="100" x-bind:value="progress"></progress> <br>
                                    <span class="text-info">pls... wait for the upload to complete before you proceed!</span>
                                </div>
                            </div><br>
                            @error('certification_upload.'.$key2)<span class="text-danger mr-5">{{$message}}</span>@enderror
                            Preview: <br>
                            @if (is_string($certification_upload[$key2]))
                               <img src="{{ asset($cert->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                            @else
                                @if($dynamic_button == 0)
                                  <img src="{{ $certification_upload[$key2]->temporaryUrl() }}" class="image_fit" alt="" height="170" width="214"> 
                                @else
                                  <img src="{{ asset($cert->upload_file) }}" class="image_fit" alt="" height="170" width="214"> 
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                      <input type="hidden" wire:model="certification_id.{{$key2}}">
                    </div>

                    <div class="float-right mt-3 mb-5">
                        <button class="btn btn-default btn-sm font-14 mr-3" wire:click.prevent="addCertification({{$i}})"> <i class="fa fa-plus"></i> Add more</button>
                    </div>
                  </div>
                </div><hr>
               @endforeach
              @endif

                <!-- more certifications -->
                @include('teachers.profile-forms.add_mores.more_certifications')
                <!-- more certifications ends -->
                
                <!-- Certification ends -->
            </div>
        </section>
        <div class="card-body">
            @if($dynamic_button == 1 || $dynamic_cert == 1 || $dynamic_qualify == 1)
              <button class="primary btn-lg pull-right ml-5" wire:click="moreEducation">Next</button>
            @else
              <button class="primary btn-lg pull-right ml-5" wire:click="UpdateEducation" type="button">Next</button>
            @endif
              <button class="btn btn-default nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
        </div>
    </div>