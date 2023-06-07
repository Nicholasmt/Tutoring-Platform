<section>
    <div class="mt-0">
    @if ($myclasses->count() == 0)
        <div class="mt-5">
          <div class="text-center">
              <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
              <p class="font-16">You don't have any Classes yet</p>
           </div>
        </div>
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
     
        @foreach ($myclasses as $classes)
        @php
            $users_info = App\Models\PersonalInformation::where('user_id',$classes->booking->who_booked->id)->with('user')->first();
            
        @endphp
        <tr>
            <th scope="row">
            <img src="{{ asset($users_info->profile_photo)}}" class="link-radius"height="32" width="32" alt="">
            <span>{{$classes->booking->who_booked->first_name." ".$classes->booking->who_booked->last_name}} </span> 
            </th>
            <td>{{$classes->booking->level}}.</td>
            <td>{{$classes->booking->subject}}.</td>
            <td>
              @if($classes->booking->completed == 1)
                  <span class="text-success"><i class="fa fa-circle font-8"></i> Completed</span> 
              @elseif($classes->booking->date == today())
                  <span class="text-warning"><i class="fa fa-circle font-8"></i> In Progress</span>
              @elseif ($classes->booking->date <= today())
                  <span class="text-danger"><i class="fa fa-circle font-8"></i> Passed</span>
              @elseif ($classes->booking->date >= today())
                  <span class="text-info"><i class="fa fa-circle font-8"></i> Upcoming</span>
              @endif
            </td>
            <td>₦{{$classes->booking->amount_paid}}</td>
            <td>{{$classes->booking->date->format('d')}}  {{date('F', strtotime($classes->booking->date))}} {{$classes->booking->date->format('Y')}}</td>
        </tr>
         @endforeach
        
          </tbody>
         </table>
         <div class="justify-center">
         </div>
      </div>
      @endif
    </div>
 </section>