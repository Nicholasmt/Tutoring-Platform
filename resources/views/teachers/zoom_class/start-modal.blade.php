 <!-- modal start -->
 <div class="modal fade modal_bg" data-backdrop="static" data-keyboard="false" id="meetingModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal"></h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <div class="card-body text-left">
             <h4 class="text_color font-weight-600 font-20">{{$title}}</h4>
             <div class="row">
                <div class="col-md-6 mt-4">
                   
                   <p class="font-18">Subject: <span class="font-15"> {{$meeting->booking->subject}}</span></p>
                   <p class="font-18">Meeting ID: <span class="font-15"> {{$meeting->meeting_id}}</span></p>
                   <p class="font-18">Duration: <span class="font-15"> {{$meeting->duration}} Minutes</span></p>
                </div>
                <div class="col-md-6 mt-4">
                   <p class="font-18">Status: <span class="font-15 badge badge-info"> {{$status}}</span></p>
                   <p class="font-18">Password: <span class="font-20"> {{$meeting->password}}</span></p>
                   <p class="font-18">Date & Time: <span class="font-15"> {{$meeting->date_time}}</span></p>
                   
               </div>
             </div>
              <div class="text-center">
                 <a href="{{($meeting->start_url)}}" class="primary">Start Class</a>
              </div>
           </div>
        </div>
      </div>
      
    </div>
  </div>
  <!-- modal Ends -->
  
  <script>
    $("#meetingModal").modal('show');
    $('.modal-backdrop').hide();
 </script>
 
 