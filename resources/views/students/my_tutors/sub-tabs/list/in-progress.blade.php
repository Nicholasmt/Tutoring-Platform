<section>
    <div class="mt-0">
      @if ($in_progress->count() == 0)
        <div class="mt-5 text-center">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
        </div>
        <div class="mt-3">
            <div class="text-center">
            <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
            </div>
        </div>
        <div class="mt-5 text-center"></div>
        @else
      <div class="card-body table-responsive">
       <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Subject</th>
            <th>Class Completion</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
       
        @foreach ($in_progress as $pending)
        @php
            $users_info = App\Models\PersonalInformation::where('user_id',$pending->teacher_booked)->first();
            $hourly_pay = App\Models\HourlyPay::where('user_id',$pending->teacher_booked)->first();
        @endphp
        <tr>
            <th scope="row">
            <img src="{{ asset($users_info->profile_photo)}}" class="link-radius"height="32" width="32" alt="">
            <span>{{$pending->teacher->first_name." ".$pending->teacher->last_name}} </span> 
            </th>
            <td>{{$pending->level}}.</td>
            <td>{{$pending->subject}}.</td>
            <td>
              @if ($pending->completed == 1)
                <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span>
                @else
                <span class="text-info"><i class="fa fa-circle font-8"></i> In Progress</span>
              @endif
            </td>
            <td>₦{{$hourly_pay->amount}} / hr</td>
            <td>{{$pending->date->format('d')}}  {{date('F', strtotime($pending->date))}} {{$pending->date->format('Y')}}</td>
        </tr>
         @endforeach
        
          </tbody>
         </table>
         <div class="justify-center">
           {{ $in_progress->links()}}
         </div>
      </div>
      @endif
    </div>
 </section>