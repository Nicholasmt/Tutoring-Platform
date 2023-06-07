 <!-- <div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
              <div class="card-bod">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'Mydetails') active @elseif(empty(Session::get('tab_name'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                         aria-controls="myDetails" aria-selected="true"><label class="nav_image"> My details</label></a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'password') active @endif" id="password-tab" data-toggle="tab" href="#password" role="tab"
                          aria-controls="password" aria-selected="false"><label class="nav_image">Password</label></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2 @if(Session::get('tab_name') == 'notifications') active @endif" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab"
                          aria-controls="notifications" aria-selected="false"><label class="nav_image">Notifications</label></a>
                      </li>
                    </ul>
                    @include('back-layout.error')
                    <div class="tab-content" id="myTabContent">
                       
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'Mydetails') show active @elseif(empty(Session::get('tab_name'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                      
                      @if ($personal_infos->phone == null)
                       <form class="needs-validation" novalidate="" action="{{ route('parentssettings.update',['setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
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
                                    <label for="inputEmail3" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="First Name" required>
                                    <div class="invalid-feedback">
                                      Enter First Name.
                                    </div>
                                </div>
                                
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-form-label font-14">Last Name</label>
                                   <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="Last Name" required>
                                   <div class="invalid-feedback">
                                     Enter Last Name.
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Country</label>
                                 <input type="text" list="select_country" class="form-control" name="country" placeholder="Country" required>
                                 <datalist id="select_country">
                                   <option value="Nigeria">Nigeria</option>
                                 </datalist>
                                 <div class="invalid-feedback">
                                    Enter Country.
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" name="phone" placeholder="Phone Number" required>
                                      <div class="invalid-feedback">
                                        Enter Phone Number.
                                   </div>
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address" required>
                                <div class="invalid-feedback">
                                  Enter Address.
                                </div>
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" name="town" placeholder="Town" required>
                                      <div class="invalid-feedback">
                                        Enter Town/city.
                                      </div>
                                 </div>
                              </div>
                              <div class="col-6">
                               <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">State</label>
                                
                                  <select name="state" class="custom-select" >
                                    @include('teachers.profile-forms.state')
                                  </select>
                                  <div class="invalid-feedback">
                                    Enter State.
                                  </div>
                               </div>
                              </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                       <div class="text-center">
                          <img  id="profile-img-card" src="{{ asset('back/assets/img/profile-avatar.png')}}" height="200" width="200" alt="photo">
                        </div>
                        <div class="form-group text-center">
                           <label for="inputPassword3" class="col-form-label font-14">Add a photo Here</label><br>
                           <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" name="profile_photo" required>
                           <span class="font-14">Note: Photo must not be greater than 5mb</span>
                          <span class="invalid-feedback font-12">Upload Profile Photo.</span>
                         </div>
                        </div>
                      </div><hr>
                         <div class="text-right">
                           <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                         <input type="submit" class="primary btn-lg ml-2" name="personal_btn_new" value="Save"> 
                        </div>
                       </div>
                      </form>
                      @elseif ($personal_infos->phone  !== null)
                      <form action="{{ route('parentssettings.update',['setting'=>$user])}}" method="POST" enctype="multipart/form-data">
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
                                    <label for="inputEmail3" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-form-label font-14">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Country</label>
                                 <input type="text" class="form-control" name="country" value="{{$personal_infos->country}}">
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
                                      <label for="inputEmail3" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" name="town" value="{{$personal_infos->town}}">
                                 </div>
                              </div>
                              <div class="col-6">
                               <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control" name="state" value="{{$personal_infos->state}}">
                               </div>
                              </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="text-center">
                            <img id="profile-img-card" src="{{ url($personal_infos->profile_photo)}}" height="200" width="265" alt="photo">
                        </div>
                        <div class="form-group text-center">
                            <label for="inputPassword3" class=" col-form-label font-14">Add a photo Here</label><br>
                            <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" name="profile_photo">
                            <p class="text-gray">Note: Photo must not be greater than 5mb</p>
                         </div>
                        </div>
                      </div><hr>
                        <div class="text-right">
                          <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                          <input type="hidden" value="Mydetails" name="tab_name">
                          <input type="submit" class="primary btn-lg ml-2" name="personal_btn_update" value="Save"> 
                        </div>
                     </div>
                  </form>
                 @endif
                   </div>
                  
                  <div class="tab-pane fade @if(Session::get('tab_name') == 'password') show active @endif" id="password" role="tabpanel" aria-labelledby="password-tab">
                   <section>
                    <form class="needs-validation" novalidate="" action="{{ route('parentssettings.update',['setting'=>$user])}}" method="POST" enctype="multipart/form-data">
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
                                 <label for="inputPassword3" class="col-form-label font-14">Current Password</label>
                                 <input type="password" class="form-control" placeholder="Current Password" value="" name="current_password" required>
                                  @error('current_password')
                                   <p class="text-danger">{{$message}}</p>
                                 @enderror
                                 <div class="invalid-feedback">
                                     Enter Current Password
                                  </div>
                             </div>
                             <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="inputPassword3" class="col-form-label font-14">New Password</label>
                                 <input type="password" class="form-control" placeholder="New Password" value="" name="new_password" required>
                                 @error('new_password')
                                   <p class="text-danger">{{$message}}</p>
                                 @enderror
                                 <div class="invalid-feedback">
                                     Enter New Password.
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                 <label for="inputPassword3" class="col-form-label font-14">Confirm new Password</label>
                                 <input type="password" class="form-control" placeholder="Confirm new Password" value="" name="confirm_password" required>
                                 @error('confirm_password')
                                   <p class="text-danger">{{$message}}</p>
                                 @enderror
                                 <div class="invalid-feedback">
                                     Enter Confirm Password.
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                         </div><hr>
                           <div class="text-right mb-5">
                            <a href="{{ route('teachers-dashboard')}}" class="btn btn-default mr-4">Cancel</a>
                            <input type="hidden" value="password" name="tab_name">
                            <input type="submit" class="primary btn-lg ml-2" name="password_btn" value="Save">
                          </div>
                      </div>
                    </form>
                  </section>
                  </div>
                  
                  <div class="tab-pane fade @if(Session::get('tab_name') == 'notification') show active @endif"  id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                    <div class="card-body">
                     <form action="{{ route('parentssettings.update',['setting'=>$user])}}" method="POST">
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
                            <span class="ml-4 font-14">Get notified when your teacher messages you.</span>
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
                            <span class="ml-4 font-14">Get notified when a teacher accepts or rejects an offer.</span>
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
                            <a href="{{ route('parents-dashboard')}}" class="btn btn-default mr-3">Cancel</a>
                            <input type="submit" class="primary btn-lg" value="Save" name="notification_btn">
                        </div>
                      </form>
                    </div>
                  </div>
                 

              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->


    <!-- filter_list -->

    
