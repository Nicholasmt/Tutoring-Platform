@section('head')
<link rel="stylesheet" href="{{ asset('back/assets/bundles/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<script defer src="{{ asset('back/assets/js/alpine.js')}}"></script>
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row">
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2>Settings</h2></li>
      </ol>
   </nav>
</div>

<livewire:teacher-settings/>

</section>
@endsection

@livewireScripts

@section('scripts')
<script src="{{ asset('front/assets/js/form.js')}}"></script> 
<script src="{{ asset('front/assets/js/loader.js')}}"></script> 
<script src="{{ asset('back/assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
 
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

    $(document).ready(function(){
        $("#alert", function(e){
            setTimeout(function(){ $(".alert-success").fadeOut('fast');
            }, 3000);
        });
          
        });
   
 </script>

@stack('scripts')
 
@endsection
