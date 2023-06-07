@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Messages,</h2></li>
      </ol>
   </nav>
  </div>
  <div class="row">
    @if ($messages->count() == 0)
    <div class="col-md-4 card-body">
     <div class="col-md-12 card mt-3">
         <div class=" mb-5">
           <div class="mt-3">
           <div class="mt-5 log_left text-center">
            <img src="{{ asset('front/assets/img/featured/geology-study.png')}}" height="100" width="150" alt="">
          </div>
            <div class="text-center">
            <p class="font-20 text_color">No Teachers Found!</p>
            <p class="text_color font-14">Teachers will appear here if you have any Bookings</p>
            </div>
            <div class="mt-1 text-center">
           <a href="{{ route('explore')}}" class="btn btn-primary btn-lg">Find teachers</a>
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
      $users_info = App\Models\PersonalInformation::where('user_id',$message->teacher_booked)->first();
    @endphp
        <div class="mb-5 mt-3">
              <button class="js_button" id="message_btn" value="{{$message->id}}">
               <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
               <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
             </button>
          </div>
       @endforeach
     </div>
    </div>
    @endif

    <div class="col-md-8">

     <div id="message-content"></div>

    <div id="action" class="col-md-12 card mt-2 ">
       @foreach ($messages as $message)
        <div class="col-md-12 mb-5">
            @php
              $users_info = App\Models\PersonalInformation::where('user_id',$message->teacher_booked)->first();
           @endphp
           <div class="mb-5 mt-3 ml-5">
             <img src="{{ asset($users_info->profile_photo)}}" height="56" width="56" class="rounded-circle  mr-4">
             <span class="font-20 text_color">{{$message->teacher->first_name." ".$message->teacher->last_name}}</span>
           </div>
           </div>
          <div class="text-right mb-5">
            <div class="card-body col-md-6 float-right message_bg2">
             <p class="text_color font-20">You booked {{$message->teacher->first_name." ".$message->teacher->last_name}}</p>
             <p class="mr-5">View booking details below</p>
             <button  class="mr-5 js_button" id="booking_details_btn" value="{{$message->id}}"  data-toggle="modal" data-target="#exampleModal">Booking details 
              <span class="mr-3 ml-3"> view</span>
             </button>
             </div>
          </div> 
          <div class="mt-5 text-left ml-4 mb-5">
            <div class="card-body col-md-6 message_bg1">
             <p class="">You booked {{$message->teacher->first_name." ".$message->teacher->last_name}}</p>
             <a href="{{ route('details',$message->teacher_booked)}}" style="text-decoration-line:none" class="mr-5" >View Profile</a> 
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