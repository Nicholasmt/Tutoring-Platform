@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row mt-3">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Account Review,</h2></li>
      </ol>
   </nav>
  </div>
  <div class="mb-1">
    <a href="{{ route('adminverifications.index')}}" class="mt-2"> <i class="fa fa-chevron-left"></i> Back</a>
  </div>
  <div class="section-body">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
              <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_name') == 'Mydetails') active  @elseif(empty(Session::get('tab_name'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                          aria-controls="Mydetails" aria-selected="true">Personal information</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link-2  @if(Session::get('tab_name') == 'pro-info') active @endif" id="pro-info-tab" data-toggle="tab" href="#pro-info" role="tab"
                          aria-controls="pro-info" aria-selected="false">Professional informatiom</a>
                      </li>
                      <li class="nav-item @if(Session::get('tab_name') == 'education') active @endif">
                        <a class="nav-link-2" id="education-tab" data-toggle="tab" href="#education" role="tab"
                          aria-controls="education" aria-selected="false">Education</a>
                      </li>
                     </ul>
                     <div style="text-transform:capitalize">
                       @include('back-layout.error')
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <!-- tab1 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'Mydetails') show active  @elseif(empty(Session::get('tab_name'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                        <!-- Personal Information start-->
                       <div class="card-body">
                         <div class="text_color">
                            <h4>Review Personal informations</h4>
                           </div>
                          <div class="row mt-5">
                           <div class="col-md-6">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control"   value="{{$user->first_name}}" readonly>
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-form-label font-14">Last Name</label>
                                    <input type="text" class="form-control"   value="{{$user->last_name}}" readonly>
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" value="{{$user->email}}" readonly>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" value="{{$personal_infos->phone}}" readonly>
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control"  value="{{$personal_infos->address}}" readonly>
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control"  value="{{$personal_infos->town}}" readonly>
                                 </div>
                              </div>
                              <div class="col-6">
                               <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control"  value="{{$personal_infos->state}}" readonly>
                               </div>
                              </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="text-center">
                            <img src="{{ asset($personal_infos->profile_photo)}}" height="200" width="265" alt="photo">
                        </div>
                        <div class="form-group text-center">
                            <label for="inputPassword3" class=" col-form-label font-20 mt-1">uploaded photo</label><br>
                          </div>
                        </div>
                      </div><hr>
                        <div class="text-right">
                            <form action="{{ route('adminverifications.store')}}" method="POST">
                                <input type="hidden" value="Mydetails" name="tab_name">
                                @csrf
                                @if($personal_infos->is_verified == 0)
                                  <input type="hidden" value="{{$personal_infos->id}}" name="id">
                                  <button type="button" value="{{$personal_infos->id}},decline_personal_btn" id="decline_btn_2" class="btn btn-danger mr-5"> Decline </button>
                                  <button type="submit" name="personal_info_btn" class="btn btn-success mr-5">Accept</button>
                                @elseif ($personal_infos->is_verified == 1)
                                  <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                @elseif ($personal_infos->is_verified == 2)
                                  <p class="font-20 badge badge-danger text-white"> Declined <i class="fa fa-times"></i></p>
                                @endif
                            </form>
                        </div>
                     </div>
                   </div>
                      <!-- tab1 ends -->
                      <!-- tab 2 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'pro-info') show active @endif" id="pro-info" role="tabpanel" aria-labelledby="pro-info-tab">
                        <section>
                         <div class="card-body">
                           <div class="text_color">
                                <h4>Review Professional Informations</h4>
                             </div>
                            <div class="row mt-5">
                               <div class="col-md-12">
                                <div class="form-group row">
                                   <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
                                <div class="col-sm-9">
                                    <p class="font-18"> {{$pro_infos->about}}</p>
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Experiences:</label>
                                 <div class="col-sm-9">
                                    <p class="font-18" >{{$pro_infos->experience}}</p>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label font-17">uploaded video:</label>
                                 <div class="col-sm-9">
                                   <video class="video_size" src="{{ asset($pro_infos->onboading_video)}}" height="260" width="500" controls></video>
                                 </div>
                              </div>
                            </div>
                           </div><hr>
                           <div class="text-right">
                             <form action="{{ route('adminverifications.store')}}" method="POST">
                               <input type="hidden" value="pro-info" name="tab_name">
                                @csrf
                                @if ($pro_infos->is_verified == 0)
                                <input type="hidden" value="{{$pro_infos->id}}" name="id">
                                <button type="button"value="{{$pro_infos->id}},decline_pro_btn" id="decline_btn_2" class="btn btn-outline-danger mr-5 text-danger" data-toggle="modal" data-target="#exampleModal">Decline</button>
                                <button type="submit" name="pro_info_btn" class="btn btn-success mr-5">Accept</button>
                                @elseif ($pro_infos->is_verified == 1)
                                  <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                @elseif ($pro_infos->is_verified == 2)
                                  <p class="font-20 badge badge-danger text-white"> Declined <i class="fa fa-times"></i></p>
                                @endif
                            </form>
                        </div>
                        </div>
                        
                     </section>
                    </div>
                    <!-- tab 2 ends -->
                    <!-- tab3 starts -->
                   <div class="tab-pane fade @if(Session::get('tab_name') == 'education') show active @endif" id="education" role="tabpanel" aria-labelledby="education-tab">
                     <section>
                      <div class="card-body">
                        <!-- Qualifications start -->
                        <div class="text_color">
                            <h4>Education</h4>
                            <p>Review Qualification Details</p>
                         </div>
                           @php $q_count = 1; @endphp
                          @foreach ($educations as $education)
                          <div class="mt-4">
                           <h3>Qualification {{$q_count++}}</h3>
                         </div>
                          <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->university}}" readonly>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->result}}" readonly>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Uploaded File:</label>
                                 <div class="col-sm-9">
                                    <a href="{{ asset($education->upload_file)}}" class="btn btn-outline-primary" target="_blank">Show File</a>
                                 </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label"> Degree: </label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->degree}}" readonly>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label"> Passing Year: </label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->passing_year}} Year" readonly>
                                 </div>
                             </div>
                             
                            <div class="text-right">
                              <form action="{{ route('adminverifications.store')}}" method="POST">
                                <input type="hidden" value="education" name="tab_name">
                                @csrf
                                @if ($education->is_verified == 0)
                                  <input type="hidden" value="{{$education->id}}" name="id">
                                  <button type="button" id="decline_btn" value="{{$education->id}},decline_education_btn" class="btn btn-danger mr-5" data-toggle="modal" data-target="#exampleModal"> Decline </button>
                                  <button type="submit" name="education_btn" class="btn btn-success mr-5">Accept</button>
                                @elseif ($education->is_verified == 1)
                                  <p class="font-20 badge badge-success text-white"> Verified <i class="fa fa-check"></i></p>
                                @elseif ($education->is_verified == 2)
                                  <p class="font-20 badge badge-danger text-white"> Declined <i class="fa fa-times"></i></p>
                                @endif
                              </form>
                             </div>
                            </div>
                          </div>
                        </form>
                          @endforeach
                           <!-- Qualifications ends -->
                          <!-- Certifications start -->
                          @php $c_count = 0 @endphp
                          @foreach ($certifications as $certification)
                          <div class="mt-4">
                            <h3>Certifications {{$c_count+=1}}</h3>
                         </div>
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$certification->title}}" readonly>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control"   value="{{$certification->decription}}" readonly>
                                 </div>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control"   value="{{$certification->issued}}" readonly>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label font-17">Uploaded File:</label>
                                 <div class="col-sm-9">
                                    <a href="{{ asset($certification->upload_file)}}" class="btn btn-outline-primary" target="_blank">show File</a>
                                 </div>
                              </div>
                               <div class="text-right">
                               <form action="{{ route('adminverifications.store')}}" method="POST">
                                <input type="hidden" value="education" name="tab_name">
                                  @csrf
                                  @if ($certification->is_verified == 0)
                                    <input type="hidden" value="{{$certification->id}}" name="id">
                                    <button type="button" value="{{$certification->id}},decline_certification_btn" id="decline_btn" class="btn btn-danger mr-5" data-toggle="modal" data-target="#exampleModal">Decline</button>
                                    <button type="submit" name="certification_btn" class="btn btn-success mr-5">Accept</button>
                                  @elseif ($certification->is_verified == 1)
                                    <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                  @elseif ($certification->is_verified == 2)
                                    <p class="font-20 badge badge-danger text-white"> Declined <i class="fa fa-times"></i></p>
                                  @endif
                                </form>
                               </div>
                            </div>
                           </div>  
                        </form>
                        @endforeach
                        </div>
                     </section>
                  </div>
                  <!-- tab3 ends -->
                 </div>
              </div>
           </div>
           <div class="text-right">
             <form action="{{ route('adminverifications.store')}}" method="POST">
               @csrf
               @if ($user->is_verified == 0)
                  <input type="hidden" value="{{$user->id}}" name="id">
                  <button type="submit" name="reject_btn" class="btn btn-danger mr-5"
                    @if($pro_infos->is_verified == 0 || $personal_infos->is_verified == 0) disabled @elseif($pro_infos->is_verified == 2 || $personal_infos->is_verified == 2)  enabled @endif 
                   >Reject</button>
                  <button type="submit" name="verify_btn" class="btn btn-primary mr-5" @if($pro_infos->is_verified == 0) disabled @endif @if($personal_infos->is_verified == 0 ||$personal_infos->is_verified == 2) disabled @endif 
                                                                                      @foreach($educations as $education) @if ($education->is_verified == 0 || $education->is_verified == 2) disabled @endif @endforeach
                                                                                      @foreach($certifications as $certification) @if ($certification->is_verified == 0 || $certification->is_verified == 2) disabled @endif @endforeach
                                                                                    </button>Verify Account</button>
               @elseif ($user->is_verified == 1)
                 <p class="font-20 badge badge-success text-white">Account verified <i class="fa fa-check"></i></p> 
               @elseif ($user->is_verified == 2)
                 <p class="font-20 badge badge-danger text-white">Account Rejected! <i class="fa fa-Times"></i></p> 
              @endif
             </form>
          </div>
        </div>
      </div>
    </div>
   </div>
  </div>
</section>
 </div>
<div id="confirm_reject"></div>


@endsection
@section('scripts')
<script src="{{ asset('front/assets/js/loader.js')}}"></script>
<script src="{{ asset('front/assets/js/form.js')}}"></script> 
@endsection
