 
 
@if ($search_results == null)

<div class="float-left ml-2 mb-4">
   <p class="badge badge-info"> No Result Found!</p>
</div>

@else

@foreach ($search_results as $result)
@if ($subjectsearch == 1)
<div class="float-left ml-1 mb-4">
  <a href="{{ route('details',$result->user_id)}}">  
     <td>{{$result->user->first_name.' '.$result->user->last_name}} -</td>
     <td>( @foreach (json_decode($result->title) as $subject)  {{$subject}}, <br> @endforeach )</td>
   </a>
</div>

@elseif ($teachersearch == 1)  
<div class="float-left ml-1 mb-4"></div>
  <?php 
    $teaching = App\Models\Subjects::where('user_id',$result->id)->first();
    // dd($teaching);
  ?>
   <a href="{{ route('details',$result->id)}}">  
     <td>{{$result->first_name.' '.$result->last_name}} -</td>
     <td>( @foreach (json_decode($teaching->title) as $subject) {{$subject}},  @endforeach )</td>
   </a>
</div> 

@elseif ($scheduleSearch == 1)  
<div class="float-left ml-1 mb-4">
  <a href="{{ route('details',$result->user_id)}}">  
     <td>{{$result->user->first_name.' '.$result->user->last_name}} -</td>
     <td>( 
            @if($result->day == 1)   
            Mondays
            @elseif($result->day == 2)  
            Tuesdays
            @elseif($result->day == 3)  
             Wednesdays
            @elseif($result->day == 4)  
            Thursdays
            @elseif($result->day == 5)   
            Fridays
            @elseif($result->day == 6)   
            Saturdays
            @elseif($result->day == 0)   
            Sundays
            @endif
          )
     </td>
   </a>
</div>
@endif

@endforeach

@endif
 