<div style="background-color:black" class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="formModal">Decline</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
            <h4 class="text_color">Are you sure you want to Decline?</h4>
            <!-- <p class="mt-3 text_color">If informations provided here are found to be false, Olukotide has the right to discard your application.</p> -->
            </div>
            <div class="mb-5 mt-4 text-center">
              <form action="{{ route('parentspayments.store')}}" method="POST">
                @csrf
                 <button type="button" class="  btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
                 <input type="hidden" value="{{$booking->id}}" name="id">
                 <input type="submit" name="decline_btn" class="btn btn-danger btn-lg ml-5 m-t-15 waves-effect btn-lg text-white" value="Yes, Decline">
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#declineModal").modal('show');
    $(".modal-backdrop").hide();
  </script>