<!-- modal start -->
<div style="background-color:#464749ec" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title yext_color" id="formModal">Booking Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row text-left">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Category</label>
                    <input type="text" class="form-control" value="{{$booking_details->category->title}}" readonly>
                  </div>
                  <div class="form-group">
                    <label class="text-success">Amount paid<i class="fa fa-check"></i></label>
                    <input type="text" class="form-control" value="₦{{$booking_details->amount_paid}}" readonly>
                  </div>
                   <div class="form-group">
                    <label for="">Meet up</label>
                    <input type="text" class="form-control" value="{{$booking_details->meetup}}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Subject</label>
                      <input type="text" class="form-control" value="{{$booking_details->subject}}" readonly>
                    </div>
                     <div class="form-group">
                      <label for="">Date</label>
                      <input type="text" class="form-control" value="{{$booking_details->date->format('d')}}  {{date('F', strtotime($booking_details->date))}} {{$booking_details->date->format('Y')}}" readonly>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="">Schedule</label>
                      <div class="row">
                         <div class="col-md-12">
                           <input type="text" class="form-control" 
                           value="{{date('h:i a', strtotime($booking_details->time_from)).'-'.date('h:i a' , strtotime($booking_details->time_from)) .',  '.
                               $booking_details->date->format('d')}}  {{date('F', strtotime($booking_details->date))}} {{$booking_details->date->format('Y') }}" readonly>
                         </div>
                      </div>
                </div>
              </div>
            </div>
         </div>
      </div>
    </div>
  </div>
  <!-- modal Ends -->
  <script>
    $("#exampleModal").modal('show');
    $(".modal-backdrop").hide();
  </script>
   