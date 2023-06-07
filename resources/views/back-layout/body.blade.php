@extends('back-layout.app')
@section('body')
<body class="body_font">
<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('back-layout.top-nav')
        @include('back-layout.sidebar')
          <!-- Main Content Start -->
           <div class="main-content">
             @yield('content')
            
           </div>
         <!-- Main Content End-->
        @include('back-layout.footer')
    </div>
  </div> 

 
   
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('front/assets/js/search.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
  <script src="{{ asset('back/assets/js/custom.js')}}"></script>  
  <script src="{{ asset('front/assets/js/booking.js')}}"></script> 
 
 
  @section('scripts')
  @show

  <script>
  $(document).ready( function (e) {
    
    var url = window.location.pathname; //sets the variable "url" to the pathname of the current window
    var activePage = url.substring(url.lastIndexOf('/') + 1); //sets the variable "activePage" as the substring after the last "/" in the "url" variable
        $('.current_menu li a').each(function () { //looks in each link item within the primary-nav list
            var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1); //sets the variable "linkPage" as the substring of the url path in each &lt;a&gt;
            if (activePage == linkPage) { //compares the path of the current window to the path of the linked page in the nav item
                $(this).parent('li').addClass('active'); //if the above is true, add the "active" class to the parent of the &lt;a&gt; which is the &lt;li&gt; in the nav list
            }
    });
  });
</script>

 

</body>
@endsection