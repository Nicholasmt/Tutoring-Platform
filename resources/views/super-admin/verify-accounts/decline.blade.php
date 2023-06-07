  <!-- modal start -->
  <div style="background-color:black" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="formModal">Reject Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="text-left">
           <form action="{{ route('adminverifications.store')}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="">Decline Comment</label>
                <input type="hidden" value="{{$teacher_id}}" name="id">
                <textarea rows="" cols="" type="text" class="form-control" name="comment" required></textarea>
              </div>
                <div class="invalid-feedback">Enter decline message </div>
              <div class="mb-5 mt-4 text-center">
               <button type="button" class="btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
               <button type="submit" name="{{$btn}}" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg">Submit</button>
             </div>
          </form>
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