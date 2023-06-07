@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Messages</h2></li>
      </ol>
   </nav>
  </div>
  @include('back-layout.error')
  <div class="row">
    @if ($messages->count() == 0)
    <div class="col-md-4 card-body">
     <div class="col-md-12 card mt-3">
         <div class=" mb-5">
           <div class="mt-3">
            <div class="text-center">
            <p class="font-20 text_color">No Message Found!</p>
            <p class="text_color font-14">Students/Parents will appear here if you have any Booking Request</p>
            </div>
           </div>
        </div>
     </div>
    </div> 
   @else
  <div class="col-md-4 card">
   <div class="col-md-12 mt-3">
   @foreach ($messages as $message)
    @php
      $users_info = App\Models\PersonalInformation::where('user_id',$message->booked_by)->first();
    @endphp
        <div class="mb-5 mt-3">
              <button class="js_button" id="message_view_btn" value="{{$message->id}}">
               <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
               <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
             </button>
          </div>
       @endforeach
     </div>
    </div>
    @endif

    <div class="col-md-8">

     <div id="message-content2"></div>

    <div id="hide_message" class="col-md-12 card mt-2 ">
       @foreach ($messages as $message)
        <div class="col-md-12 mb-5">
            @php
              $users_info = App\Models\PersonalInformation::where('user_id',$message->booked_by)->first();
           @endphp
           <div class="mb-5 mt-3 ml-5">
             <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
             <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
           </div>
           </div>
          <div class="text-left mb-5">
            <div class="card-body col-md-6 message_bg1">
             <p class="text_color font-20">{{$message->teacher->first_name." ".$message->teacher->last_name}} has booked you</p>
             <p class="mr-4">View details below</p>
             <button  class="mr-4 js_button" id="details_btn" value="{{$message->id}}"  data-toggle="modal" data-target="#exampleModal">Booking details 
              <span class="mr-3 ml-3"> view</span>
             </button>
             </div>
          </div> 
          <div class="mt-5 text-right ml-4 mb-5">
            <div class="card-body col-md-6 float-right message_bg2">
            <p class="font-17">Do you accept the booking?</p>
             <p class="font-12">NB: Once booking has been accepted, it cannot be cancelled, else it would affect your rating</p>
             <div class="row ">
                <div class="text-center ml-5">
                  <form action="{{ route('teachersmessages.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$message->id}}" name="booking_id">
                    <input type="submit" name="decline_btn" value="No" class="mr-5 btn btn-white btn-lg">
                    <input type="submit" name="accept_btn" value="Yes" class="btn btn-primary btn-lg">
                   </form>
                </div>
              </div>
            </div>
             @break
          @endforeach  
        </div>
       </div>
    </div>
</section>

<div id="booking-details"></div>

@endsection
@section('scripts')
 <script src="{{ asset('front/assets/js/loader.js')}}"></script>
 @endsection 