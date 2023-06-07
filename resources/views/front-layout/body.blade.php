@extends('front-layout.app')
@section('body')
<header id="header-wrap" style="margin-top:%">
@include('front-layout.top-nav')
</header>

@include('front-layout.slider')

@include('front-layout.search-bar')

@yield('content')

@include('front-layout.footer')

<a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>

<!-- scripts starts here -->
<script data-cfasync="false" src="{{ asset('front/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>
<!-- <script src="{{ asset('front/assets/js/popper.min.js')}}"></script> -->
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
 <!-- <script src="{{ asset('front/assets/js/jquery.counterup.min.js')}}"></script> -->
<script src="{{ asset('front/assets/js/waypoints.min.js')}}"></script>
<script src="{{ asset('front/assets/js/wow.js')}}"></script>
<script src="{{ asset('front/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/form-validator.min.js')}}"></script>
<script src="{{ asset('front/assets/js/contact-form-script.min.js')}}"></script>
 
@section('scripts')
@show
<!-- scripts ends here -->
@endsection