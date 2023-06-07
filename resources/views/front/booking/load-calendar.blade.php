<p style="font-size:18px;color:black" class="col-md-10 text-center mt-4 mb-4">Day selected 
<span class="text-info">{{$schedule->day}}</span>
</p>
<div class="form-group col-md-10">
<label class="text_color">Pick a Date</label>
 
<input type="hidden" id="day" value="{{$schedule->day}}">
<input type="hidden" id="value" value="{{$schedule->id}}">
<input id="booking_datepicker" placeholder="Select a Date" type="text" class="available_btn form-control mt-3" name="date" readonly>
</div>
<script>
    $( function() {
    let selectdDay = {!!$day!!}
    var arrayDays = [selectdDay];
     $("#booking_datepicker").multiDatesPicker({
      beforeShowDay: function(date){
        var day = date.getDay();
        return [(arrayDays.indexOf(day) != -1)];
      },
      // multiDate: true,
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd',
     });
  });
   
  //  multiDatesPicker
  // datepicker
  
   
 
 
  </script>  
 