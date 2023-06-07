 <div class="col-md-12 yes">
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
       <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Country</label>
            <div class="col-sm-9">
                <select wire:model.lazy="country" wire:click="display_state" id="selectCountry" class="form-control">
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
                 Preview: <br>
                 @if(is_string($means_of_ID))
                    <img src="{{ asset($personal_infos->means_of_ID) }}" class="image_fit" height="170" width="214">
                 @else
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

        @else
        <div class="form-group row">
           <label for="inputPassword3" class="col-sm-3 col-form-label font-14">State</label>
           <div class="col-sm-9">
            <select id="state" wire:model="state"  class="custom-select">
                @foreach ($update_state as $state)
                <option value="{{$state->name}}">{{$state->name}}</option>
                @endforeach
            </select>
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
               Preview: <br>
               @if(is_string($profile_photo))
                 <img src="{{ asset($personal_infos->profile_photo) }}" class="image_fit" height="170" width="214">
               @else
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