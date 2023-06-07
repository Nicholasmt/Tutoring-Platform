<section>
    <div class="mt-0">
    @if ($in_progress->count() == 0)
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
            <th>Status</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($in_progress as $pending)
          @php
            $users_info = App\Models\PersonalInformation::where('user_id',$pending->booking->who_booked->id)->with('user')->first();
           @endphp
        <tr>
            <th scope="row">
            <img src="{{ asset($users_info->profile_photo)}}" class="link-radius"height="32" width="32" alt="">
            <span>{{$pending->booking->who_booked->first_name." ".$pending->booking->who_booked->last_name}} </span> 
            </th>
            <td>{{$pending->booking->level}}.</td>
            <td>{{$pending->booking->subject}}.</td>
            <td>
                <span class="font-14">
                   @if ($pending->booking->date == today())
                    <span class="text-success">In Progress</span>
                   @elseif($pending->booking->date > today())
                     <span class="text-black">Upcoming...</span>        
                  @endif
               </span>
            </td>
            <td>₦{{$pending->booking->amount_paid}}</td>
            <td>{{$pending->booking->date->format('d')}}  {{date('F', strtotime($pending->booking->date))}} {{$pending->booking->date->format('Y')}}</td>
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