<div>
 <div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
              <div class="card-bod">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'Mydetails') active @elseif(empty(Session::get('tab_pane'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                         aria-controls="myDetails" aria-selected="true"><label class="nav_image"> My details</label></a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'password') active @endif" id="password-tab" data-toggle="tab" href="#password" role="tab"
                          aria-controls="password" aria-selected="false"><label class="nav_image">Password</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_pane') == 'notification') active @endif" id="notification-tab" data-toggle="tab" href="#notification" role="tab"
                          aria-controls="notification" aria-selected="false"><label class="nav_image">Notifications</label></a>
                      </li>
                    </ul>
                    <!-- @if(Session::has('message'))
                        <div class="alert alert-success">
                          <p class="text-white text-capitalize font-14 font-weight-600"><i class="fa fa-check"></i> {{Session::get('message')}}</p> 
                        </div>
                      @endif -->
                    <div class="tab-content" id="myTabContent">
                       <!-- tab1 start -->
                      <div class="tab-pane fade @if(Session::get('tab_pane') == 'Mydetails') show active @elseif(empty(Session::get('tab_pane'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                        <!-- Personal Information start-->
                      @if ($personal_infos->phone == null)
                       <form class="needs-validation" novalidate="" enctype="multipart/form-data">
                         <div class="card-body">
                          <div class="text_color">
                            <h4>Personal info</h4>
                            <p>Complete your profile settings details here.</p>
                           </div>
                          <div class="row mt-5">
                           <div class="col-md-6">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label for="first_name" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control" wire:model.lazy="first_name" placeholder="First Name">
                                    @error('first_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                                
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="last_name" class="col-form-label font-14">Last Name</label>
                                   <input type="text" class="form-control" wire:model.lazy="last_name" value="{{$user->last_name}}" placeholder="Last Name">
                                   @error('last_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" wire:model.lazy="email">
                                 @error('email') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="genger" class="col-form-label font-14">Gender</label>
                                 <select wire:model="gender" class="form-control">
                                      <option value="">Select Gender</option>
                                      <option value="Male" >Male</option> 
                                      <option value="Female" >Female</option> 
                                  </select>
                                @error('gender') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group row">
                                  <label for="country" class="col-form-label font-14">Country</label>
                                    <select wire:model="country" id="selectCountry" class="form-control">
                                        <option value="">Select Country</option>
                                         @foreach ($countries->chunk(20) as $group)
                                           @foreach ($group as $country)
                                            <option  value="{{$country->name}}" >{{$country->name}}</option> 
                                          @endforeach
                                      @endforeach
                                    </select>
                                   @error('country') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                             </div>
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="phone" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" wire:model.lazy="phone" placeholder="Phone Number">
                                      @error('phone') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="address" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" wire:model.lazy="address" placeholder="Address">
                                @error('address') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="town" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" wire:model.lazy="town" placeholder="Town">
                                      @error('town') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                              
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
                        @if ($profile_photo)
                          <div class="text-center">
                            <img  id="profile-img-card" src="{{$profile_photo->temporaryUrl()}}" height="200" width="200" alt="photo">
                          </div>
                        @else
                          <div class="text-center">
                            <img  id="profile-img-card" src="{{ asset('back/assets/img/profile-avatar.png')}}" height="200" width="200" alt="photo">
                          </div>
                        @endif
                       
                        <div class="form-group text-center">
                           <label for="photo" class="col-form-label font-14">Add a photo Here</label><br>
                           <div x-data="{ isUploading: false, progress: 0}" 
                                x-on:livewire-upload-start="isUploading = true; progress: 5"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" wire:model.lazy="profile_photo">
                                <div x-show="isUploading" class="mt-2">
                                  <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                            <span class="font-14">Note: Photo must not be greater than 5mb</span><br>
                             @error('profile_photo') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                         </div>
                        </div>
                      </div><hr>
                        <div class="">
                          @error('gender') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                          @error('country') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror 
                          @error('phone') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                          @error('address') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                          @error('town') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                          @error('state') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                          @error('profile_photo') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                      </div>
                         <div class="text-right">
                           <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                          <button type="button" wire:click.prevent="Personal_info({{$user->id}})" class="primary btn-lg ml-2">Save</button>  
                        </div>
                       </div>
                           {{-- <input type="time" step="3600000"/> --}}
                      </form>

                      @elseif ($personal_infos->phone  !== null)
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
                                    <input type="text"  class="form-control" wire:model.lazy="first_name">
                                    @error('first_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="last_name" class="col-form-label font-14">Last Name</label>
                                  <input type="text" class="form-control" wire:model.lazy="last_name">
                                  @error('last_name') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" wire:model.lazy="email" disabled>
                                 @error('email') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-form-label font-14">Gender</label>
                                 <select wire:model="gender" class="form-control" disabled>
                                      <option value="">Select Gender</option>
                                      <option value="Male" >Male</option> 
                                      <option value="Female" >Female</option> 
                                  </select>
                                @error('gender') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-form-label font-14">Country</label>
                                 <input type="text" class="form-control" wire:model.lazy="country" disabled>
                                 @error('country') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="phone" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" wire:model.lazy="phone">
                                      @error('phone') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="address" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" wire:model.lazy="address">
                                @error('address') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="town" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" wire:model.lazy="town">
                                      @error('town') <span class="text-danger font-13 text-capitalize">{{$message}}</span> @enderror
                                 </div>
                              </div>
                              <div class="col-6">
                               <!-- <div class="form-group">
                                  <label for="state" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control" wire:model.lazy="state">
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
                        @if ($profile_photo)
                          <div class="text-center">
                              <img id="profile-img-card" src="{{ $profile_photo->temporaryUrl()}}" height="200" width="265" alt="photo">
                          </div>
                        @else 
                           <div class="text-center">
                              <img id="profile-img-card" src="{{ asset($personal_infos->profile_photo)}}" height="200" width="265" alt="photo">
                          </div>
                        @endif
                        <div class="form-group text-center">
                            <label for="photo" class=" col-form-label font-14">Add a photo Here</label><br>
                             <div x-data="{ isUploading: false, progress: 0}" 
                                x-on:livewire-upload-start="isUploading = true; progress: 5"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" wire:model="profile_photo">
                                <div x-show="isUploading" class="mt-2">
                                  <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                            <p class="text-gray">Note: Photo must not be greater than 5mb</p>
                         </div>
                        </div>
                      </div><hr>

                      <div class="">
                        @error('gender') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                        @error('country') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror 
                        @error('phone') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                        @error('address') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                        @error('town') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                        @error('state') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                        @error('profile_photo') <span class="text-danger  font-13 text-capitalize">{{$message}}</span> <br> @enderror
                     </div>
                     
                        <div class="text-right">
                           <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                           <button wire:click.prevent="updatePersonal_info({{$user->id}})" class="primary btn-lg ml-2">Save</button>
                        </div>
                     </div>
                  </form>
                 @endif
                   </div>
                  <!-- tab1 ends -->
                  <!-- tab 2 start -->
                  <div class="tab-pane fade @if(Session::get('tab_pane') == 'password') show active @endif" id="password" role="tabpanel" aria-labelledby="password-tab">
                   <section>
                    <form class="needs-validation" novalidate="">
                      <div class="card-body">
                        <div class="text_color">
                         <h4 class="text_color ">Password</h4>
                         <p>Change your password to protect your account</p>
                        </div>
                        <div class="row mt-4">
                          <div class="col-md-7">
                            <div class="form-group">
                                 <label for="password" class="col-form-label font-14">Current Password</label>
                                  <input type="password" class="form-control" placeholder="Current Password" wire:model.defer="current_password">
                                  @error('current_password')
                                   <span class="text-danger font-13 text-capitalize">{{$message}}</span>
                                 @enderror
                                  
                             </div>
                             <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="password" class="col-form-label font-14">New Password</label>
                                 <input type="password" class="form-control" placeholder="New Password" wire:model.defer="new_password">
                                 @error('new_password')
                                   <span class="text-danger font-13 text-capitalize">{{$message}}</span>
                                 @enderror
                                  
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="password" class="col-form-label font-14">Confirm new Password</label>
                                 <input type="password" class="form-control" placeholder="Confirm new Password" wire:model.defer="confirm_password">
                                 @error('confirm_password')
                                   <span class="text-danger font-13 text-capitalize">{{$message}}</span>
                                 @enderror
                                   
                                </div>
                              </div>
                            </div>
                          </div>
                         </div><hr>
                           <div class="text-right mb-5">
                             <a href="{{ route('teachers-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                             <button wire:click.prevent="passwordUpdate({{$user->id}})" class="primary btn-lg ml-2">Save</button>
                          </div>
                      </div>
                    </form>
                  </section>
                  </div>
                  <!-- tab2 ends -->
                  <!-- tab3 starts -->
                  <div class="tab-pane fade @if(Session::get('tab_pane') == 'notification') show active @endif"  id="notification" role="tabpanel" aria-labelledby="notification-tab">
                    <div class="card-body">
                     <!-- <form> -->
                       <div class="">
                         <h4 class="font-16 font-weight-bold">Notification</h4>
                         <span class="font-12">Get notified on what you want to see</span>
                       </div><hr>
                       <div class="mt-4">
                          <h5 class="font-14">By Email</h5>
                          <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="message" class="custom-chechbox" id="message">
                            <span class="font-14">Messages</span> <br>
                            <span class="font-14">Get notified when your teacher messages you.</span>
                            <span class="checkmark"></span>
                          </label>  
                          <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="activities" class="custom-chechbox" id="activities">
                            <span class="font-14">Account Activities</span> <br>
                            <span class="font-14">Get notified whenever there is an activity on your dashboard.</span>
                            <span class="checkmark"></span>
                          </label>

                          <label class="check-box mt-3">
                            <input type="checkbox" wire:model.defer="offers" class="custom-chechbox" id="offer">
                            <span class="ml-2 font-14">Offers</span> <br>
                            <span class="ml-4 font-14">Get notified when a teacher accepts or rejects an offer.</span>
                            <span class="checkmark"></span>
                          </label>

                          <div class="mt-5">
                            <h4 class="font-16 font-weight-bold">Push Notifications</h4>
                            <span class="font-12">These are delivered via SMS to your mobile phone.</span>
                          </div>

                          <label class="check-box mt-3">
                              <input type="checkbox" wire:model.defer="everything" class="custom-chechbox" id="everythings">
                              <span class="ml-2 font-14">Everything</span>
                              <span class="checkmark"></span>
                            </label>

                          <label class="check-box mt-3">
                             <input type="checkbox" wire:model.defer="send_as_email" class="custom-chechbox" id="send_as_emails">
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
                            <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-3">Cancel</a>
                            <button class="primary btn-lg" wire:click.prevent="updateNotification({{$user->id}})">Save</button>
                        </div>
                      <!-- </form> -->
                    </div>
                  </div>
                 <!-- tab 3 ends -->
                  @if(Session::has('message'))
                    <div class="alert alert-success col-md-6 meesage_alert">
                      <p class="text-white text-capitalize font-14 font-weight-600"> {{Session::get('message')}}  <i class="fa fa-check"></i></p> 
                    </div>
                  @elseif(Session::has('error'))
                    <div class="alert alert-danger col-md-6 meesage_alert">
                      <p class="text-white text-capitalize font-14 font-weight-600"> {{Session::get('error')}}  <i class="fa fa-times"></i></p> 
                    </div>
                  @endif
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
</script>
@endpush
