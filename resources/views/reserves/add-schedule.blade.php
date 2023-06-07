<div class="col-md-12" id="field_{{date('is')}}">
  <div class="ibox row" id="{{date('is')}}">
   <div class="col-md-6">
    <h3 class="text-left text_color ml-3">Schedule {{$count}}</h3>
     <div class="form-group mt-4 text-left">
        <label for="inputPassword3" class="col-form-label">Day:</label>
         <div class="">
           <select name="schedule[{{$count-1}}][day]" id="day" class="custom-select mt-3 col-md-12" id="inputGroupSelect05">
            <option disabled selected>Select Day</option>
              <option value="1" @if(old('schedule.' . $count-1 . 'day') == 1) selected @endif>Monday</option> 
              <option value="2" @if(old('schedule.' . $count-1 . 'day')) == 2) selected @endif>Tuseday</option>  
              <option value="3" @if(old('schedule.' . $count-1 . 'day') == 3) selected @endif>Wednesday</option> 
              <option value="4" @if(old('schedule.' . $count-1 . 'day') == 4) selected @endif>Thursday</option> 
              <option value="5" @if(old('schedule.' . $count-1 . 'day') == 5) selected @endif>Friday</option>  
              <option value="6" @if(old('schedule.' . $count-1 . 'day') == 6) selected @endif>Saturday</option> 
              <option value="0" @if(old('schedule.' . $count-1 . 'day') == 0) selected @endif>Sunday</option>   
            </select>
          </div>
         </div>
         <div class="form-group text-left">
            <label for="inputPassword3" class="col-form-label">Limit per booking:</label>
            <input type="number" class="mt-3 col-md-12 form-control" name="schedule[{{$count-1}}][time_limit]" required>
            <div class="invalid-feedback">
                Enter booking limit
           </div>
         </div>
       </div>
       <div class="col-md-6 text-left mt-4">
          <label for="inputEmail4" class="">Time:</label><br>
          <div class="row">
             <div class="form-group col-md-12">
                  <label for="inputEmail4">From</label>
                  <input type="time" class="form-control col-md-12" value="{{old('schedule.' . $count-1 . '.from]')}}" name="schedule[{{$count-1}}][from]" required>
                  <div class="invalid-feedback">
                      Enter a schedule time
                  </div>
            </div>
            <div class="form-group col-md-12 mt-3">
                  <label for="inputPassword4">To</label>
                  <input type="time" class="form-control col-md-12 time_btn"  value="{{old('schedule.' . $count-1 . '.to]')}}" name="schedule[{{$count-1}}][to]" required>
                  <div class="invalid-feedback">
                      Enter a schedule time
                  </div>
             </div>
          </div>
           
<!--         
         <div class="form-group col-md-12">
           <label class="font-18">Add break time</label><br>
              <div id="break_times">
                <input type="text" name="schedule[{{$count-1}}][break_times]" class="form-control" required>
                <p class="text-danger">seperate each time with comma</p>
             </div>
             <div id="select_time"></div>
          </div> -->

          <div class="form-group col-md-12">
              <label class="font-18"> <span class="text-info"> Optional:</span> Add break time within your selected time range</label><br>
              <input type="text" name="schedule[{{$count-1}}][break_times]" class="form-control" placeholder="example 9:00,10:00,13:00,15:00,16:00..."><br>
              <span class="text-danger"> Note: Time in 24 hour format and seperate each time with comma.</span>
          </div>
          
        </div>
      </div>
    <div class="col-md-6 ml-5">
      <div class="form-group row"> <a class="btn btn-danger text-white" data-value="{{date('is')}}" id="remove-schedule-btn">Remove <i class="fa fa-window-close"></i></a></div>
   </div>
</div>
 
 
 