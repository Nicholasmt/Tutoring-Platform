@extends('front-layout.app')
@section('body')
<header id="header-wrap">
 
</header>
<div class="main-container section-padding mt-5">
<div class="container">
</div>
</div>

<!-- modal start -->
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="formModal"></h5>
          <button type="button" class="close" href="{{ route('bookings',$teacher->id)}}">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
              <img class="img-fluid" src="{{ asset($teacher->profile_photo)}}" height="241" width="173" alt="image">
              <span>
              <img class="img-fluid mt-5" style="margin-left:-5%" src="{{ asset('front/assets/img/details/icon.png')}}" height="48" width="48" alt="image"> 
              </span>
              
              <h5 class="text_color mt-3">Congrats, Booking details has been sent</h5>
               <p class="mt-3 text_color">You would be notified when Bisi accepts your request and replies to your message. </p>
            </div>
            <div class="mb-5 mt-4 text-center">
            <a href="{{ route('explore')}}" class="btn btn-outline-common mr-5" style="border:2px black;">Continue to Exploring Teachers</a>
            <a href="{{ route('parents-dashboard')}}" class="btn btn-common">Continue to your Dashboard</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal Ends -->

<script data-cfasync="false" src="{{ asset('front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/booking.js')}}"></script>

<script>
   $("#exampleModal").modal('show'); </script>

<style>
  .modal-backdrop.show{
      opacity: 0.8;
  }
</style>
@endsection