 <div id="hide_message" class="col-md-12 card mt-2 ">
        <div class="col-md-12 mb-5">
           <div class="mb-5 mt-3 ml-5">
             <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
             <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
           </div>
           </div>
          <div class="text-left mb-5">
            <div class="card-body col-md-6 message_bg1">
             <p class="text_color font-20">{{$message->teacher->first_name." ".$message->teacher->last_name}} has booked you</p>
             <p class="mr-4">View details below</p>
             <button  class="mr-4 js_button" id="details_btn" value="{{$message->id}}"  data-toggle="modal" data-target="#exampleModal">Booking details 
              <span class="mr-3 ml-3"> view</span>
             </button>
             </div>
          </div> 
          <div class="mt-5 text-right ml-4 mb-5">
            <div class="card-body col-md-6 float-right message_bg2">
            <p class="font-17">Do you accept the booking?</p>
             <p class="font-12">NB: Once booking has been accepted, it cannot be cancelled, else it would sffect your rating</p>
             <div class="row ">
                <div class="text-center ml-5">
                    <a href="" class="mr-5 btn btn-white btn-lg">No</a>
                   <a href="" class="btn btn-primary btn-lg">Yes</a>
                </div>
               </div>
            </div>
        </div>
       </div>