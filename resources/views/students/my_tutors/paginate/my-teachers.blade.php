<section>
    <div class="mt-0">
    @if ($my_teachers->count() == 0)
       <div class="mt-5 text-center">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="251" width="377" alt="">
      </div>
        <div class="mt-3">
            <div class="text-center">
            <p class="">You have no Teachers yet. Whenever you book and pay for a teacher, they appear here</p>
            </div>
        </div>
        <div class="mt-5 text-center"> </div>
      @else
      <div class="card-body table-responsive">
       <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Subject</th>
            <th>Status</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($my_teachers as $my_teacher)
        @php
            $users_info = App\Models\PersonalInformation::where('user_id',$my_teacher->teacher_booked)->with('user')->first();
            $hourly_pay = App\Models\HourlyPay::where('user_id',$my_teacher->teacher_booked)->with('user')->first();
        @endphp
        <tr>
            <th scope="row">
            <img src="{{ asset($users_info->profile_photo)}}" class="link-radius"height="32" width="32" alt="">
            <span>{{$my_teacher->teacher->first_name." ".$my_teacher->teacher->last_name}} </span> 
            </th>
            <td>{{$my_teacher->level}}.</td>
            <td>{{$my_teacher->subject}}.</td>
            <td>
              @if($my_teacher->completed == 1)
                  <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
              @elseif($my_teacher->date == today())
                  <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
              @elseif ($my_teacher->date <= today())
                  <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
              @elseif ($my_teacher->date >= today())
                  <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
              @endif
            </td>
            <td>₦{{$hourly_pay->amount}} / hr</td>
            <td>{{$my_teacher->date->format('d')}}  {{date('F', strtotime($my_teacher->date))}} {{$my_teacher->date->format('Y')}}</td>
        </tr>
         @endforeach
          </tbody>
         </table>
         <div class="justify-center">
           {{ $my_teachers->links()}}
         </div>
      </div>
      @endif

    </div>
 </section>