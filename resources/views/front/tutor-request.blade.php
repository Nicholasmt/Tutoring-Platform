@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.app')
@section('body')

@include('front-layout.top-nav')

<div class="main-container section-padding">
<div class="container mt-4">
<div class="row">
<div class="col-lg-8 col-md-8 col-xs-8 mt-4">
<h4 class="mt-5">We can help you find the perfect tutor</h4>
<p class="mt-4 explore-sub-hero text_secondary">Our team is on standby and ready to help! Our tailored matching service is <br> free and easy-to-use, with no obligations.</p>
</div>
<div class="col-lg-4 col-md-4 col-xs-4 mt-4">
<img src="{{ asset('front/assets/img/featured/geology-study.png')}}" class="image_fit mr-4" height="200" width="300" alt="">
</div>
</div>

<livewire:tutor-requests/>

</div>
</div>
 
<!-- @include('front-layout.outcomes') -->
@include('front-layout.teachers-list')
@include('front-layout.footer')

<a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>

<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/advanced_fliter.js')}}"></script>
@endsection
@livewireScripts

@stack('scripts')
<script>
       $(document).ready(function(){
        window.livewire.on('alert_remove',()=>{
          setTimeout(function(){ $(".alert-success").fadeOut('fast');
          }, 3000);
        });
    });
</script>