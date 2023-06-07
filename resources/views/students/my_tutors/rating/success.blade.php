<div style="background-color:#222222d0" class="modal fade" data-backdrop="static" data-keyboard="false" id="ratedModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text_color" id="formModal"> </h5>
           <a href="{{ route('parents-dashboard')}}"  class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </a>
        </div>
        <div class="modal-body">
            <div class="text-center">
              <p class="font-20 text_color text-success">Your Rating has been Submitted</p><br>
              <span class="text_color font-17"> Thanks for your Feedback</span>
           </div>
         </div>
      </div>
    </div>
  </div>
  <script>
    $("#ratedModal").modal('show');
    $(".modal-backdrop").hide();
  </script>
  <!-- <script src="{{ asset('front/assets/js/rating.js')}}"></script> -->
 