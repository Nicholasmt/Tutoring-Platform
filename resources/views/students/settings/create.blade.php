@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<link rel="stylesheet" href="{{ asset('back/assets/bundles/select2/dist/css/select2.min.css')}}">
<script defer src="{{ asset('back/assets/js/alpine.js')}}"></script>
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Settings</h2></li>
      </ol>
   </nav>
  </div>
    <livewire:student-settings/>
  </div>
  </div>
</section>
@livewireScripts

 
@endsection


@section('scripts')
<script src="{{ asset('front/assets/js/form.js')}}"></script> 
<script src="{{ asset('front/assets/js/notification.js')}}"></script> 
<script>
    $(document).ready(function(){
        window.livewire.on('alert_remove',()=>{
          setTimeout(function(){ $(".alert-success").fadeOut('fast');
          }, 3000);
        });
    });
    $(document).ready(function(){
        window.livewire.on('alert_remove',()=>{
          setTimeout(function(){ $(".alert-danger").fadeOut('fast');
          }, 3000);
        });
    });
 </script>

 @stack('scripts')

@endsection
