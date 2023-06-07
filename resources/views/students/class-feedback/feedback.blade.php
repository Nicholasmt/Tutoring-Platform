<div style="background-color:#222222d0" class="modal fade" data-backdrop="static" data-keyboard="false" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text_color text-center" id="formModal">How was your Experience with 
            <span class="text-capitalize font-italic"> {{$class_feedback->zoom_class->booking->teacher->first_name ." ". $class_feedback->zoom_class->booking->teacher->last_name}}?</span> 
          </h5>
           {{-- <a href="{{url()->previous()}}"  class="close"  >
            <span aria-hidden="true">&times;</span>
          </a> --}}
        </div>
        <div class="modal-body">
           <div class="row mt-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-4">
              <h5 class="text-center"> Rating</h5>
              <div class="card-body card mt-4">
                <h5 class="text_color text-center"></h5>
                <div class="row mt-3 star_rating">
                  <button class="star font-40 mr-2 ml-4">  &#9734; </button>
                  <button class="star font-40 mr-2 ml-1">  &#9734; </button>
                  <button class="star font-40 mr-2 ml-1">  &#9734; </button>
                  <button class="star font-40 mr-2 ml-1">  &#9734; </button>
                  <button class="star font-40 mr-2 ml-1">  &#9734; </button><br>
                </div>
                <p class="text-center font-17 current_rating"> 0  of  5</p>
               </div>
             </div>

             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="form-group card-body">
                    <h5 class="text-center"> Recommendation</h5>
                    <label class="mt-2 font-16"> Select Option</label> <br>
                    <input type="hidden" name="zoom" value="{{$attend->id}}">
                    <input type="hidden" name="booking" value="{{$class_feedback->zoom_class->booking_id}}">
                    <label class="ml-2 mt-1 font-15">Awesome!
                      <input type="radio" class="" value="Awesome" name="title">
                   </label>
                   <label class="ml-2 mt-1 font-15">Good!
                    <input type="radio" class="" value="Good" name="title">
                   </label>
                   <label class="ml-2 mt-1 font-15">Fairly Good!
                    <input type="radio" class=""  value="Fairly Good" name="title">
                  </label> 
                  <label class="ml-2 mt-1 font-15">Bad!
                    <input type="radio" class="" value="Bad" name="title">
                   </label><br>
                    <textarea name="message" type="text" class="form-control" cols="30" rows="10" placeholder="Feedback Message"></textarea>
                </div>
               </div>
               <div class="card-body text-center">
                 <button type="button" id="save_rating_btn" value="{{$feedback->id}}" class="btn btn-primary col-8 btn-lg" class="btn btn-primary"  data-toggle="modal" data-target="#ratedModal">
                    Submit
                 </button>
               </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('front/assets/js/rating.js')}}"></script>
 
 
 