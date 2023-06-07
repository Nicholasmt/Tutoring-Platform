   <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3 navbar-left">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
              <li class="">
                @if (Session::get('privilege') == 3)
                   <div class="search-element ml-2">
                    <input type="hidden" id="privilege" value="{{Session::get('privilege')}}">
                    <input class="form-control" id="search" type="search" placeholder="Search for Teachers, Subjects & Schedules" aria-label="Search" data-width="300">
                    <button class="btn" type="submit"> <i class="fas fa-search"></i> </button>
                  </div>
                @endif
               </li>
             </ul>
             @if (Session::get('privilege') == 3)
             <ul class="navbar-nav mr-3 navbar-left">
               <li class="">
                   <a href="{{ route('explore')}}" class="primary mobile_button btn-sm"> Find a tutor</a>
               </li>
            </ul>
             @endif
            <div id="result" class="dropdown-menu dropdown-list dropdown-menu-left pullDown search_list">
              <div class="dropdown-heade card-body">
                 <div class="font-16" id="result_list"></div>
              </div>
           </div>
         </div>
         <ul class="navbar-nav navbar-right">
          <!-- notification nav starts -->
          <li class="dropdown dropdown-list-toggle mr-3">
          @if (Session::get('privilege') == 3 || Session::get('privilege') == 2)
            <a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"> <img src="{{ asset('back/assets/img/icons/alert-icon.svg')}}" height="17" width="20" alt="">  
              <span class="badge headerBadge2">{{$booking_requests->count()}}</span>
            </a>
           @endif 
           <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown pull_left">
              <div class="dropdown-header">
                <span class="font-14 font-weight-600 text-color">Notifications</span>
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
                </div>
              </div>
              <!-- students / parents notifications -->
              @if (Session::get('privilege') == 3)
              <div class="dropdown-list-content dropdown-list-icons">
                
              @if($booking_requests->count() > 0)
                @foreach ($booking_requests as $request)
                @php
                  $personal_info = App\Models\PersonalInformation::where('user_id',$request->teacher_booked)->first();
                @endphp
                  <a href="javascript:void(0)" id="view_orders" value="{{$request->id}}" class="dropdown-item dropdown-item-unread"> 
                    <span class="dropdown-item-icon  text-white"> 
                      <!-- <i class="fas fa-code"></i> -->
                      <img src="{{ asset($personal_info->profile_photo)}}" class="link-radius" height="38" width="38" alt="img">
                    </span> 
                    <span class="dropdown-item-desc">Pending Book request to {{$request->teacher->first_name." ".$request->teacher->last_name}} <br> 
                        <span class="font-12 text-warning">awaiting approval...</span>
                        <span class="time text-lowercase">{{$request->created_at->diffForHumans()}} </span>
                    </span>
                  </a> 
                  @endforeach
                @endif
               @if($approved->count() > 0)
                 @foreach ($approved as $accepted)
                    @php
                      $personal_info = App\Models\PersonalInformation::where('user_id',$accepted->teacher_booked)->first();
                    @endphp
                    <a href="javascript:void(0)" id="view_orders" value="{{$accepted->id}}" class="dropdown-item dropdown-item-unread"> 
                      <span class="dropdown-item-icon  text-white"> 
                        <!-- <i class="fas fa-code"></i> -->
                        <img src="{{ asset($personal_info->profile_photo)}}" class="link-radius" height="38" width="38" alt="img">
                      </span> 
                      <span class="dropdown-item-desc">Your booking has been accepted by {{$accepted->teacher->first_name." ".$accepted->teacher->last_name}} <br> 
                          <span class="font-12 text-success">Enjoy the Class!</span>
                          <span class="time text-lowercase">{{$accepted->created_at->diffForHumans()}} </span>
                      </span>
                    </a> 
                   @endforeach
                  @endif

                  @if($rejected->count() > 0)
                  @foreach ($rejected as $rejected)
                    @php
                      $personal_info = App\Models\PersonalInformation::where('user_id',$rejected->teacher_booked)->first();
                    @endphp
                    <a href="javascript:void(0)" id="view_orders" value="{{$rejected->id}}" class="dropdown-item dropdown-item-unread"> 
                      <span class="dropdown-item-icon  text-white"> 
                        <img src="{{ asset($personal_info->profile_photo)}}" class="link-radius" height="38" width="38" alt="img">
                      </span> 
                      <span class="dropdown-item-desc">Your booking has been rejected by {{$rejected->teacher->first_name." ".$rejected->teacher->last_name}} <br> 
                          <span class="font-12 text-danger">Rejected 
                            <!-- <a href="{{ route('explore')}}"> Find a tutor</a> -->
                          </span>
                          <span class="time text-lowercase">{{$rejected->created_at->diffForHumans()}} </span>
                      </span>
                    </a> 
                   @endforeach
                  @endif

                 @if($approved->count() == 0 && $booking_requests->count() == 0 && $rejected->count() == 0)
                  <div class="mt-5 text-center">
                    <img src="{{ asset('back/assets/img/vectors/no-notifications.png')}}" height="24" width="24" alt=""><br>
                  </div>
                  <div class="dropdown-footer text-center normal_link mt-5">
                    <span class="font-12 font-weight-400">You have no notifications yet</span><br>
                    <span class="font-12 font-weight-400">Notifications on messages and alerts would appear here</span>
                  </div>
                @endif
              </div>
              <!-- teachers notifications -->
              @elseif (Session::get('privilege') == 2)
              <div class="dropdown-list-content dropdown-list-icons">
               
               @if($booking_requests->count() > 0)
                @foreach ($booking_requests as $request)
                  @php
                    $personal_info = App\Models\PersonalInformation::where('user_id',$request->booked_by)->first();
                  @endphp
                  <a href="javascript:void(0)" id="booking_request" value="{{$request->id}}" data-toggle="modal" data-target="#BookingModal" class="dropdown-item dropdown-item-unread"> 
                    <span class="dropdown-item-icon  text-white"> 
                       <img src="{{ asset($personal_info->profile_photo)}}" class="link-radius" height="38" width="38" alt="img">
                    </span> 
                    <span class="dropdown-item-desc">You have booking request from {{$request->who_booked->first_name." ".$request->who_booked->last_name}} <br> 
                        <span class="font-12 text-info">view to accept or decline bookings</span>
                        <span class="time text-lowercase">{{$request->created_at->diffForHumans()}} </span>
                    </span>
                 </a> 
                  @endforeach
                @endif
               
                @if($approved->count() == 0 && $booking_requests->count() == 0)
                  <div class="mt-5 text-center">
                    <img src="{{ asset('back/assets/img/vectors/no-notifications.png')}}" height="24" width="24" alt=""><br>
                  </div>
                  <div class="dropdown-footer text-center normal_link mt-5">
                    <span class="font-12 font-weight-400">You have no notifications yet</span><br>
                    <span class="font-12 font-weight-400">Notifications on messages and alerts would appear here</span>
                  </div>
                @endif
              @if($approved->count() > 0)
                 @foreach ($approved as $accepted)
                    @php
                      $personal_info = App\Models\PersonalInformation::where('user_id',$accepted->booked_by)->first();
                    @endphp
                    <div class="dropdown-item dropdown-item-unread"> 
                      <span class="dropdown-item-icon text-white"> 
                        <img src="{{ asset($personal_info->profile_photo)}}" class="link-radius" height="38" width="38" alt="img">
                      </span> 
                      <span class="dropdown-item-desc">You accepted booking from {{$accepted->who_booked->first_name." ".$accepted->who_booked->last_name}} <br> 
                          <span class="font-12 text-success">Enjoy the Class!</span>
                          <span class="time text-lowercase">{{$accepted->created_at->diffForHumans()}} </span>
                      </span>
                    </div> 
                   @endforeach
                  @endif
              </div>
              @endif
            </div>
          </li>
          <!-- notification nav ends  -->
          <!-- profile nav -->
          <li class="dropdown">
            @if(Session::get('privilege') == 2 || Session::get('privilege') == 3)
              <a href="#" data-toggle="dropdown"class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              @if ($personal_infos->profile_photo == null)
               <img alt="image" src="{{ asset('back/assets/img/user.svg')}}" height="32" width="32" class="rounded">  
              @else
                <img alt="image" src="{{ asset(Session::get('photo'))}}" class="link-radius"> 
              @endif
              <span class="d-sm-none d-lg-inline-block mr-2 text-capitalize" style="color:black;"> {{Session::get('first_name') ." ".Session::get('last_name')}} <i class="fa fa-chevron-down font-12"></i></span>  
            </a>
            @endif
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"></div>
              @if(Session::get('privilege') == 2)
              <a href="{{ route('teachers-profile-setting')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile
              </a> 
              <a href="{{ route('teachers-profile-setting')}}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              @elseif(Session::get('privilege') == 3)
              <a href="{{ route('parentssettings.create')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile
              </a>
                <a href="{{ route('parentssettings.create')}}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              @endif
              <div class="dropdown-divider"></div>
              <a href="{{ route('app-logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div id="booking_requests"></div>

    
		