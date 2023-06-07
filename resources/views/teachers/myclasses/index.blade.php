@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Classes</h2></li>
      </ol>
   </nav>
  </div>
  
  <div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="car">
              <div class="card-bod">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                       <ul class="nav nav-tabs" id="subTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link_switch switcher active" id="grid-tab" data-toggle="tab" href="#grid" role="tab"
                                aria-controls="grid" aria-selected="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="#6D747D" xmlns="http://www.w3.org/2000/svg">
                                  <path class="tab_icon" d="M10 3H3V10H10V3Z"    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M21 3H14V10H21V3Z"   stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M21 14H14V21H21V14Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M10 14H3V21H10V14Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link_switch_2 switcher" id="list-tab" data-toggle="tab" href="#list" role="tab"
                                aria-controls="list" aria-selected="false">
                                <!-- <img class="tab_icon" src="{{ asset('front/assets/img/featured/list.svg')}}" height="24" width="24"> -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="#6D747D" xmlns="http://www.w3.org/2000/svg">
                                  <path class="tab_icon" d="M8 6H21"    stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M8 12H21"   stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M8 18H21"   stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 6H3.01"  stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 12H3.01" stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path class="tab_icon" d="M3 18H3.01" stroke="#6D747D"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                              </a>
                            </li>
                        </ul>
                       <li class="nav-item nav_border ml-5 tab_margin tab_nav">
                          <a class="nav-link show active" id="students-tab" data-toggle="tab" href="#students" role="tab"
                            aria-controls="students" aria-selected="false"> <label class="nav_image nav_text"> Students </label></a>
                        </li>
                      <li class="nav-item nav_border-2 tab_nav">
                          <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab"
                            aria-controls="classes" aria-selected="false"> <label class="nav_image nav_text"> Classes </label></a>
                        </li>
                        <li class="nav-item nav_border-3 tab_nav">
                          <a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab"
                            aria-controls="requests" aria-selected="false"><label class="nav_image nav_text"> Requests </label></a>
                        </li>
                  </ul>
                    @include('back-layout.error')
                    <div class="tab-content" id="myTabContent">
                        <!-- tab1 start -->
                      <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab">
                        <div class="card-bod">
                           @include('teachers.myclasses.students')
                       </div>
                    </div>
                   
                  <!-- tab 2 start-->
                  <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                       @include('teachers.myclasses.subtabs.classes')
                  </div>
                   <!-- tab 2 ends-->

                  <!-- tab 3 start-->
                  <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
                       @include('teachers.myclasses.subtabs.requests')
                  </div>
                  <!-- tab 3 ends-->
                  
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
<script src="{{ asset('front/assets/js/loader.js')}}"></script> 
@endsection
