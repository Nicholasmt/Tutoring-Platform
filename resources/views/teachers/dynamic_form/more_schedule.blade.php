@foreach($schedules as $key => $value)
  <h3 class="font-16 text_color text-capitalize card-body">More Schedule</h3>
    {{-- <div class="mt-3 "> --}}
     <div class="col-md-12 card-body mt-3">
      <div class="form-group row" wire:ignore>
        <label for="day" class="col-sm-2 col-form-label font-14">Day</label>
        <div class="col-sm-9">
        <select wire:model="more_day.{{$key}}" class="form-control" id="more_day_{{$key}}" multiple="multiple">
            <option value="1">Monday</option> 
            <option value="2">Tuesday</option>  
            <option value="3">Wednesday</option> 
            <option value="4">Thursday</option> 
            <option value="5">Friday</option>  
            <option value="6">Saturday</option> 
            <option value="0">Sunday</option>   
         </select><br>
        </div>
      </div>
      <span class="col-sm-4 ml-5"></span>
      @error('more_day.'.$key) <span class="text-danger col-sm-9 ml-5 font-13 text-capitalize error">{{$message}}</span>@enderror
    </div>
 {{-- </div> --}}
 {{-- @endforeach --}}

 <div class="row card-body">
  @if(isset($more_day))
    @foreach ($more_day as $key_2 => $days)
     <div class="col-md-6">
      <div class="form-group row">
         @error('more_day.'.$key_2)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
      </div>
      <div class="form-group row">
        @php
            if(isset($more_from[$key_2]) && isset($more_to[$key_2]))
                {
                    $time_from = date('H:', strtotime($more_from[$key_2]));
                    $time_to = date('H:',strtotime($more_to[$key_2]));
                    $convert_time_from = strval($time_from).'00';
                    $convert_time_to = strval($time_to).'00';
                    $time_diff2[] = abs(strtotime($convert_time_from) - strtotime($convert_time_to))/3600;
               }
        @endphp
       <span class="col-md-12 text-info">Note: Remember to Reselect time limit if you updated schedule time.</span>
        <label class="col-sm-3 col-form-label font-14">Limit per booking for:
            <span class="font-bold text-center font-14"> 
              @if ($days == 1) Monday
                @elseif ($days == 2) Tuesday  @elseif ($days == 3) Wednesday @elseif ($days == 4) Thursday
                @elseif ($days == 5) Friday @elseif ($days == 6) Saturday @elseif ($days == 0) Sunday
              @endif
            </span>
        </label>
       
        <div class="col-sm-9 selectgroup w-100">
          @if (isset($time_diff2[$key_2]))
             @if($time_diff2[$key_2] >= 1)
                <label class="selectgroup-item">
                   <input type="radio" wire:model="more_time_limit.{{$key_2}}" value="1" class="selectgroup-input-radio">
                   <span class="selectgroup-button">Once</span>
                </label>
             @endif
            @if($time_diff2[$key_2] >= 2)
                <label class="selectgroup-item">
                    <input type="radio" wire:model="more_time_limit.{{$key_2}}" value="2" class="selectgroup-input-radio">
                    <span class="selectgroup-button">Twice</span>
                </label>
             @endif
           
            @if($time_diff2[$key_2] >= 3)
               <label class="selectgroup-item">
                    <input type="radio" wire:model="more_time_limit.{{$key_2}}" value="3" class="selectgroup-input-radio">
                    <span class="selectgroup-button">Thrice</span><br>
                </label>
             @endif
          @endif
        </div>
        <span class="col-sm-2  ml-2"></span>
        @error('more_time_limit.'.$key_2) <span class="text-danger error font-13 ml-5 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
    </div>
    {{-- @endforeach --}}
   </div>

    <div class="col-md-6 mt-5">
      <div class="form-group row">
       <label for="inputEmail4" class="col-sm-3 font-14 mt-2">Time for:
          <span class="font-bold text-center font-14"> 
            @if ($days == 1) Monday
                @elseif ($days == 2) Tuesday @elseif ($days == 3) Wednesday @elseif ($days == 4) Thursday
                @elseif ($days == 5) Friday @elseif ($days == 6) Saturday @elseif ($days == 0) Sunday
            @endif
          </span>
        </label><br>
        <div class="form-row col-sm-9">
            <div class="col-md-6">
              <label for="">From</label>
             <input type="time" placeholder="From" class="form-control col-sm-12" wire:model="more_from.{{$key_2}}">
            @error('more_from.'.$key_2) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
            </div>
            <div class="form-group col-md-6">
                 <label for="">To</label>
                <input type="time" placeholder="To" class="form-control col-sm-12" wire:model="more_to.{{$key_2}}">
                @error('more_to.'.$key_2) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
            </div>
             @if (isset($time_diff2[$key_2]))
              @if($time_diff2[$key_2] ==0)
                <span class="text-danger ml-2">Schedule time "From" and "To" cant't be same!</span>
              @endif
             @endif
            <span class="text-info font-bold ml-2">
              Note:Default schedule times should be in "00" minutes,
              The system will use default if other wise.
            </span>
         </div>
        </div>
        
       </div>
       @endforeach
      <div class=" col-md-12 text-right mt-4 mb-4">
        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})"> <i class="fa fa-trash"></i> Remove</button>
     </div>
    @endif
   </div> 
 @endforeach
<!-- add more schedule -->
  
 <script>
  @foreach($schedules as $key6 => $schedule) 
     $(document).ready(function() {
        window.selectMoreDays=()=>{
            $('#more_day_{{$key6}}').select2({
                placeholder: 'Select Day',
                allowClear: true});
          $('#more_day_{{$key6}}').on('change', function (e) {
                var data = $('#more_day_{{$key6}}').select2("val");
                @this.set('more_day', data);
          });
        }
        selectMoreDays();
        window.livewire.on('loadDay',()=>{
          selectMoreDays();
        });
    });
   @endforeach
 </script>
 
 