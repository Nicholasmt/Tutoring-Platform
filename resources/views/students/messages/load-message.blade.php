
    <div id="action" class="col-md-12 card mt-2 ">
        <div class="col-md-12 mb-5">
            <div class="mb-5 mt-3 ml-5">
             <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
             <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
           </div>
           </div>
          <div class="text-right mb-5">
            <div class="card-body col-md-6 float-right message_bg2">
             <p class="text_color font-20">You booked {{$message->teacher->first_name." ".$message->teacher->last_name}}</p>
             <p class="mr-5">View booking details below</p>
             <button  class="mr-5 js_button" id="booking_details_btn" value="{{$message->id}}"  data-toggle="modal" data-target="#exampleModal">Booking details 
              <span class="mr-3 ml-3"> view</span>
             </button>
             </div>
          </div> 
          <div class="mt-5 text-left ml-4 mb-5">
            <div class="card-body col-md-6 message_bg1">
             <p class="">You booked {{$message->teacher->first_name." ".$message->teacher->last_name}}</p>
             <a href="{{ route('details',$message->teacher_booked)}}" style="text-decoration-line:none" class="mr-5" >View Profile</a> 
            </div>
          </div> 
        </div>