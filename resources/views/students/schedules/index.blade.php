@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<link rel="stylesheet" href="{{ asset('back/assets/bundles/fullcalendar/fullcalendar.min.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Schedule</h2></li>
      </ol>
   </nav>
  </div>
     <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="fc-overflow">
                      <div id="myEvent">
                          
                        </div>
                    </div>
                  </div>
                 </div>
                 </div>
              </div>
            </div>
          </div>
     
</section>
 
   
@endsection
@section('scripts')
<script src="{{ asset('back/assets/bundles/fullcalendar/fullcalendar.min.js')}}"></script>
<!-- <script src="{{ asset('back/assets/js/page/calendar.js')}}"></script> -->
<script>
var today = new Date();
year = today.getFullYear();
month = today.getMonth();
day = today.getDate();
var calendar = $('#myEvent').fullCalendar({
  height: 'auto',
  defaultView: 'month',
  editable: false,
  selectable: true,
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay,listMonth'
  },
 events: [
  @if (Session::get('privilege') == 3)
   @foreach ($bookings as $booking)
   @if(is_array(json_decode($booking->booked_times)))

   @foreach ((json_decode($booking->booked_times)) as $time)
    <?php $endtime = strtotime($time) + 60*60; ?>
      {
      title: '{{$booking->subject}}',
      start: '{{$booking->date->toDateString()}}' + 'T' + '{{$time}}',
      end: '{{$booking->date->toDateString()}}' + 'T' + '{{$time}}',
      display: 'background',
      description: '{{$booking->teacher->first_name}}' + ' {{$booking->teacher->last_name}}'  +' {{ date('h:i A', strtotime($time))."-". date('h:i A', $endtime)}}',
      },  
    @endforeach

   @else

   <?php $endtime = strtotime($booking->booked_times) + 60*60; ?>
    {
      title: '{{$booking->subject}}',
      start: '{{$booking->date->toDateString()}}' + 'T' + '{{$booking->booked_times}}',
      end: '{{$booking->date->toDateString()}}' + 'T' + '{{$booking->booked_times}}',
      display: 'background',
      description: '{{$booking->who_booked->first_name}}' + ' {{$booking->who_booked->last_name}}'  +' {{ date('h:i A', strtotime($booking->booked_times))."-". date('h:i A', $endtime)}}',
     }, 
   
   @endif
   
   @endforeach

   @elseif (Session::get('privilege') == 2)
  
   @foreach ($bookings as $booking)

   @if (is_array(json_decode($booking->booked_times)))

   @foreach ((json_decode($booking->booked_times)) as $time)
    <?php $endtime = strtotime($time) + 60*60; ?>

    {
      title: '{{$booking->subject}}',
      start: '{{$booking->date->toDateString()}}' + 'T' + '{{$time}}',
      end: '{{$booking->date->toDateString()}}' + 'T' + '{{$time}}',
      display: 'background',
      description: '{{$booking->who_booked->first_name}}' + ' {{$booking->who_booked->last_name}}'  +' {{ date('h:i A', strtotime($time))."-". date('h:i A', $endtime)}}',
     }, 
   @endforeach

   @else
   <?php $endtime = strtotime($booking->booked_times) + 60*60; ?>
    {
      title: '{{$booking->subject}}',
      start: '{{$booking->date->toDateString()}}' + 'T' + '{{$booking->booked_times}}',
      end: '{{$booking->date->toDateString()}}' + 'T' + '{{$booking->booked_times}}',
      display: 'background',
      description: '{{$booking->who_booked->first_name}}' + ' {{$booking->who_booked->last_name}}'  +' {{ date('h:i A', strtotime($booking->booked_times))."-". date('h:i A', $endtime)}}',
     }, 
   
   @endif
   @endforeach

   @endif

    ],

     eventRender: function(eventObj, $el) {
      $el.popover({
        title: eventObj.title,
        content: eventObj.description,
        trigger: 'hover',
        placement: 'top',
        container: 'body',
      });
    },

    eventColor: '#5181C4',
});
</script>
 @endsection 