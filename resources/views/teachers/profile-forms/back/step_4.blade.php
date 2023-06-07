   <div class="row mt-5 yes card-bod">
    @if($dynamic_schedule == 0)
        <div class="col-md-6">
            <div class="form-group row" wire:ignore>
            <label class="col-sm-3 col-form-label font-14">Subjects</label>
                <div class="col-sm-9">
                <select wire:model="subjects" class="form-control" id="select2" multiple="multiple" >
                    <option value="Mathematics" selected>Mathematics</option>
                    <option value="Quantitative Reasoning">Quantitative Reasoning</option>
                    <option value="Verbal Reasoning">Verbal Reasoning</option>
                    <option value="Social Studies">Social Studies</option>
                    <option value="Biology">Biology</option>
                    <option value="Art">Art</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Physics">Physics</option>
                    <option value="Civic Education">Civic Education</option>
                    <option value="History">History</option>
                    <option value="Moral instruction">Moral instruction</option>
                    <option value="Computer Science">Computer Science</option>
                </select>
                </div>
            </div>
            
        <!-- seleced subjects -->
        <div class="form-group row">
            @php  $count = 1; @endphp
            @if(isset($subjects))
            <label for="subjects" class="col-sm-3 col-form-label font-14">Selected Subjects:</label>
            @else
            <label for="subjects" class="col-sm-3 col-form-label font-14"></label>
            @endif
            <div class="col-sm-9">
       
             @if(isset($subjects))
                @foreach ($subjects as $subject)
                <span class="font-14"> {{$count++}}). {{$subject}} </span> <br>
                @endforeach
             @endif
            <input type="hidden" wire:model="subjects" class="form-control" 
                                    value="@if(isset($subjects))
                                        @foreach ($subjects as $subject)
                                            {{$subject}} 
                                            @endforeach
                                            @endif" readonly>
               @error('subjects')<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                </div>
            </div>
            <!-- seleced subjects ends-->
        </div>
        
       <div class="col-md-6">
        <div class="form-group row" wire:ignore>
            <label for="category" class="col-sm-3 col-form-label font-14">Levels</label>
            <div class="col-sm-9">
                <select  wire:model="levels" class="form-control" id="levelSelect" multiple="multiple">
                    <option value="">Select Level</option> 
                    @foreach ($categories as $category)
                      <option value="{{$category->title}}">{{$category->title}}</option>   
                    @endforeach
                </select><br>
                @error('levels')<span class="text-danger font-13 text-capitalize">{{$message}}</span>@enderror
            </div>
        </div>
        </div>

        <!-- add schedule -->
        <div class="mt-2">
         {{-- @if($dynamic_schedule == 0) --}}
         @php $schedule_count =1  @endphp
           @foreach ($schedules_infos as $key => $schedules)
            <div class="text_color mb-3">
              <h4 class="font-16">Schedule {{$schedule_count++}}</h4>
           </div>
            <div class="row">
              <div class="col-md-6">
               <div class="form-group row" wire:ignore>
                <label for="day" class="col-sm-3 col-form-label font-14">Day {{$day[$key]}}</label>
                <div class="col-sm-9">
                  <select wire:model="day.{{$key}}" class="custom-select">
                    <option value="1"@if($day[$key] == 1) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 1) disabled @endif @endforeach @endif>Monday</option> 
                    <option value="2"@if($day[$key] == 2) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 2) disabled @endif @endforeach @endif>Tuesday</option>  
                    <option value="3"@if($day[$key] == 3) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 3) disabled @endif @endforeach @endif>Wednesday</option> 
                    <option value="4"@if($day[$key] == 4) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 4) disabled @endif @endforeach @endif>Thursday</option> 
                    <option value="5"@if($day[$key] == 5) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 5) disabled @endif @endforeach @endif>Friday</option>  
                    <option value="6"@if($day[$key] == 6) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 6) disabled @endif @endforeach @endif>Saturday</option> 
                    <option value="0"@if($day[$key] == 0) enabled @else @foreach($schedules_infos as $alldays) @if($alldays->day == 0) disabled @endif @endforeach @endif>Sunday</option>   
                    </select><br>
                    @error('day.'.$key)<div class="text-danger font-13 text-capitalize">{{$message}}</div>@enderror
                   </div>
               </div>
                @error('day') <span class="text-danger col-sm-9 ml-5 font-13 text-capitalize error">{{$message}}</span>@enderror
            <div class="form-group row">
            @php
                $time_from = date('H:', strtotime($from[$key]));
                $time_to = date('H:',strtotime($to[$key]));
                $convert_time_from = strval($time_from).'00';
                $convert_time_to = strval($time_to).'00';
                $time_diff[] = abs(strtotime($convert_time_from) - strtotime($convert_time_to))/3600;
            @endphp
            <span class="col-md-12 text-info font-bold">Note: Remember to Reselect limit based on your updated schedule time rage.</span>
            <label class="col-sm-3 col-form-label font-14 mt-2">Limit per booking</label>
            <div class="col-sm-9 selectgroup w-100 mt-3">
            @if ($time_diff[$key] >= 1)
                <label class="selectgroup-item">
                    <input type="radio" wire:model="time_limit.{{$key}}" value="1" class="selectgroup-input-radio">
                    <span class="selectgroup-button">Once</span>
                </label>
            @endif
            @if ($time_diff[$key] >= 2)
                <label class="selectgroup-item">
                    <input type="radio" wire:model="time_limit.{{$key}}" value="2" class="selectgroup-input-radio">
                    <span class="selectgroup-button">Twice</span>
                </label>
            @endif
            @if ($time_diff[$key] >= 3)
                <label class="selectgroup-item">
                    <input type="radio" wire:model="time_limit.{{$key}}" value="3" class="selectgroup-input-radio">
                    <span class="selectgroup-button">Thrice</span><br>
                </label>
            @endif
            </div>
            <span class="col-sm-2  ml-2"></span>
            @error('time_limit.'.$key) <span class="text-danger error font-13 ml-5 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
        </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
            <label for="inputEmail4" class="col-sm-3 font-14 mt-2">Time:</label><br>
            <div class="form-row col-sm-9">
                <div class="col-md-6">
                    <label for="">From</label>
                    <input type="time" id="from" placeholder="From" class="form-control col-sm-12" wire:model="from.{{$key}}">
                    @error('from.'.$key) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">To</label>
                    <input type="time" id="to" placeholder="To" class="form-control col-sm-12" wire:model="to.{{$key}}">
                    @error('to.'.$key) <span class="text-danger error font-13 text-capitalize font-13 text-capitalize">{{$message}}</span>@enderror
                </div>
                @if($time_diff[$key] == 0)
                   <span class="text-danger ml-2">Schedule time "From" and "To" cant't be same!</span>
                 @endif
                <span class="text-info font-bold ml-2">
                    Note: Default schedule times should be in "00" minutes,
                    The system will use default if other wise.
                </span>
            </div>
        </div>
        
        <div class="form-group">
            <input type="hidden" wire:model="schedule_id.{{$key}}">
        </div>
           <button class="btn btn-default  pull-right btn-sm font-14 mr-3" wire:click.prevent="add({{$i}})"><i class="fa fa-plus"></i> Add more</button>
        </div> 
      </div>
    @endforeach
  </div>
  @else
    @include('teachers.profile-forms.add_mores.schedule')
  @endif 
  
   <div class="col-md-12 mt-4">
        @if(Session::has('error'))
        <div class="alert alert-danger text-left">
            <p class="text-white text-capitalize font-16 font-weight-600"><i class="fa fa-check"></i> {{Session::get('error')}}</p> 
        </div>
        @endif
    
    @if ($dynamic_schedule == 0)
        <button class="primary btn-lg pull-right ml-5" wire:click="updateSchedule" type="button">Preview!</button>
    @else 
        <button class="primary btn-lg pull-right ml-5" wire:click="moreSchedule" type="button">Preview!</button>
    @endif
        <button class="btn btn-default nextBtn btn-lg pull-right" type="button" wire:click="back(3)">Back</button>
   </div>
 </div>
{{-- </div> --}}
 
                        