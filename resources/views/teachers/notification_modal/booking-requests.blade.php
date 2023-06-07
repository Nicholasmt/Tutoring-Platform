 <!-- modal start -->
 <div class="modal fade modal_bg" id="BookingModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row card-body">
          @if (Session::get('privilege') == 2)
            <div class="col-md-6">
               <h4 class="text_color font-18">Student/Parents</h4>
                 <img src="{{ asset($personal_info->profile_photo)}}" class="image_fit mt-2 mb-2" height="153" width="236" alt="img"> <br>
                 <span class="mt-4 font-18 font-capitalize ml-5">{{$request->who_booked->first_name." ".$request->who_booked->last_name}}</span>
            </div>
            @elseif (Session::get('privilege') == 3)
            <div class="col-md-6">
               <h4 class="text_color font-18">Teacher Booked</h4>
                 <img src="{{ asset($personal_info->profile_photo)}}" class="image_fit mt-2 mb-2" height="153" width="236" alt="img"> <br>
                 <span class="mt-4 font-18 font-capitalize ml-5">{{$request->teacher->first_name." ".$request->teacher->last_name}}</span>
            </div>
            @endif
            <div class="col-md-6">
                <h4 class="text_color font-18">Booking Details</h4>
                <p class="font-15">Subject
                  <br> <span class="font-13">{{$request->subject}}</span>
               </p>
                <p class="font-15">Scheduled Date 
                 <br> <span class="font-13">{{ $request->date->format('d')}}  {{date('F', strtotime($request->date))}} {{$request->date->format('Y') }}</span>
                </p>
                <p class="font-15">Scheduled Time<timefa-borderbr></timefa-borderbr> <br>
                  <span class="font-13"> 
                    @if (is_array(json_decode($request->booked_times)))
                      @foreach (json_decode($request->booked_times) as $time)
                        {{date('h:i A', strtotime($time))}},
                      @endforeach
                    @else
                        {{date('h:i A', strtotime($request->booked_times))}},
                    @endif
                  </span>
                 </p>
              </div>
           </div>
           @if (Session::get('privilege') == 2)

           @if ($request->accepted == 0)
             @if ($request->expectations !== null)
              <p class="mt-3 text-center font-18">Expectations. <span class="text-danger font-14">Note: Read the "expectations" carefully, if you will not compley please don't accept </span> </p>
              <p class="">{{$request->expectations}}</p>
            @endif
           
            <div class="mb-5 mt-4 text-center">
            <form action="{{ route('teachers-booking-orders')}}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{$request->id}}">
              <button type="submit" name="decline" class="btn btn-outline-danger btn-lg mr-5 text-danger">Decline</button>
              <button type="submit" name="accept" class="primary btn-lg ml-5 m-t-15">Accept</button>
           </form>
          </div>
          @elseif($request->accepted == 1 || $request->accepted == 2)

            @if ($request->accepted == 1)
                <p class="font-16 text-center" >Status: <span class="badge badge-success">Accepted!</span></p>
            @elseif ($request->accepted == 2)  
              <p class="font-16 text-center" >Status: <span class="badge badge-danger">Declined!</span></p>
            @elseif ($request->accepted == 0)   
                <p class="font-16 text-center" >Status: <span class="badge badge-warning">Pending...!</span></p>
            @endif

           @endif
          @endif 

          @if(Session::get('privilege') == 3)
          @if ($request->accepted == 1)
          <p class="font-16 text-center">Status: <span class="badge badge-success">Accepted!</span></p>
           @elseif ($request->accepted == 2)  
             <p class="font-16 text-center">Status: <span class="badge badge-danger">Declined!</span></p>
           @elseif ($request->accepted == 0)   
              <p class="font-16 text-center">Status: <span class="badge badge-warning">Pending!...</span></p>
           @endif
         @endif
        </div>
      </div>
      
    </div>
  </div>
  <!-- modal Ends -->
  <script>
    $("#BookingModal").modal('show');
    $('.modal-backdrop').hide();
  </script>
 