<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="myLargeModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="card-body">
           <div class="row">
              <div class="col-md-6">
                <img src="{{ asset('back/assets/img/icons/img5.png')}}" height="300" width="300" alt="image">
              </div>
              <div class="col-md-6">
                <div class="text-center">
                  <h4 class="text_color">Success!!</h4>
                   <p class="text_color">Your application has been submitted and is under review. It would take about 3-4 working days for your profile to be reviewed.</p>
                </div>
                <div class="text-center">
                  <h4 class="text_color">What Next?</h4>
                  <div class="row mt-3">
                     <div class="col-md-4">
                       <i class="fa fa-user form-iconpadding2"></i>
                     </div>
                      <div class="col-md-4">
                        <i class="fa fa-users form-iconpadding"></i>
                     </div>
                     <div class="col-md-4">
                       <i class="fa fa-calendar form-iconpadding"></i>
                     </div>
                  </div>
                  <hr class="works_line">
                  </div>
               </div>
               <div class="mt-5 form-but">
                    <a href="{{ route('redirect')}}" class="btn btn-icon form-but2">Go to Dashboard <i class="fa fa-arrow-right"></i></a>
                </div>
           </div>
           </div>
          </div>
      </div>
    </div>
  </div>
  <script>
    $("#completeModal").modal('show');
    // $(".modal-backdrop").hide();
  </script>
