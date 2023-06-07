<div class="row">
@foreach ($split as $split)
  <p class="badge badge-info ml-2"> {{$split}}
     <input type="checkbox" value="{{$split}}" name="break_times">
 </p>
 @endforeach
</div>
 
 