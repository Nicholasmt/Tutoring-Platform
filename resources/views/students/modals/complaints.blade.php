<div style="background-color:#222222d0" class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-info" id="formModal">Make Complaint</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-left">
              <p class="font-16">Report <span class="text_color font-17 text-capitalize">{{$class->booking->teacher->first_name." ".$class->booking->teacher->last_name}}</span> for any issues concerning your class</p>
           </div>
            <div class="mb-5">
             <form action="{{ route('parents-save-complain')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$class->id}}" name="id">
                <div class="form-gruop">
                    <label class="font-15">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-gruop">
                  <label class="font-15">Message</label>
                  <textarea type="text" name="message" class="form-control" cols="30" rows="10" required></textarea>
                </div>
                <div class="text-center mt-2">
                   <button type="button" class="btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
                   <button type="submit" name="accept_btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg text-white">submit</button>
                </div>
             </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#complaintModal").modal('show');
    $(".modal-backdrop").hide();
  </script>
