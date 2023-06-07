@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/main.css')}}"> -->
@endsection
@extends('back-layout.app')
@section('body')
<body>
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="">
          <img src="{{ asset('front/assets/img/logo.svg')}}" alt="logo">
        </div>
      <div class="section-body mt-3">
       <div class="row">
        <div class="col-12 col-lg-12">
        @if ($personal_infos->comments !== null)
         <div  class="alert alert-danger alert-dismissible show fade mb-1">
           <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>&times;</span>
            </button>
              Personal information was Declined!, {{$personal_infos->comments}} 
            </div>
          </div>
          @endif
          @if ($pro_infos->comments !== null)
           <div  class="alert alert-danger alert-dismissible show fade mb-1">
             <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Professional information was Declined!, {{$pro_infos->comments}}    
            </div>
          </div>
          @endif
          @foreach ($certifications as $certification)
          @if ($certification->comments !== null)
          <div  class="alert alert-danger alert-dismissible show fade mb-1">
            <div class="alert-body">
             <button class="close" data-dismiss="alert">
              <span>&times;</span>
              </button>
              Certification information was Declined!, {{$certification->comments}} 
            </div>
          </div>
          @endif
         @endforeach
         @foreach ($educations as $education)
         @if ($education->comments !== null)
          <div  class="alert alert-danger alert-dismissible show fade mb-1">
            <div class="alert-body">
             <button class="close" data-dismiss="alert">
               <span>&times;</span>
             </button>
             Qualifaiction information was Declined!, {{$education->comments}} 
             </div>
          </div>
         @endif
        @endforeach
           <div class="card">
             <div class="card-bod">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link  @if(Session::get('tab_name') == 'Mydetails') active  @elseif(empty(Session::get('tab_name'))) active @endif" id="Mydetails-tab" data-toggle="tab" href="#Mydetails" role="tab"
                        aria-controls="home" aria-selected="true">My details</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link @if(Session::get('tab_name') == 'pro-info') active @endif" id="pro-info-tab" data-toggle="tab" href="#pro-info" role="tab"
                          aria-controls="profile" aria-selected="false">Professional info</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link  @if(Session::get('tab_name') == 'education') active @endif" id="education-tab" data-toggle="tab" href="#education" role="tab"
                          aria-controls="contact" aria-selected="false">Education</a>
                      </li>
                   </ul>
                    @include('back-layout.error')
                    <div class="tab-content" id="myTabContent">
                      <!-- tab1 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'Mydetails') show active @elseif(empty(Session::get('tab_name'))) show active @endif" id="Mydetails" role="tabpanel" aria-labelledby="Mydetails-tab">
                       <!-- Personal Information start-->
                      <form action="{{ route('teachersform-updates.update',['form_update'=>$personal_infos])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                          <div class="text_color">
                            <h4>Personal info</h4>
                            <p>Update your photo and personal details here.</p>
                           </div>
                          <div class="row mt-5">
                           <div class="col-md-6">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class=" col-form-label font-14">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                                </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-form-label font-14">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-form-label font-14">Email Address</label>
                                 <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Phone Number</label>
                                      <input type="number" class="form-control" name="phone" value="{{$personal_infos->phone}}">
                                 </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">Address</label>
                                <input type="text" class="form-control" name="address" value="{{$personal_infos->address}}">
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                      <label for="inputEmail3" class=" col-form-label font-14">Town/City</label>
                                      <input type="text" class="form-control" name="town" value="{{$personal_infos->town}}">
                                 </div>
                              </div>
                              <div class="col-6">
                               <div class="form-group">
                                  <label for="inputEmail3" class="col-form-label font-14">State</label>
                                  <input type="text" class="form-control" name="state" value="{{$personal_infos->state}}">
                               </div>
                              </div>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="text-center">
                            <img id="profile-img-card" src="{{ asset($personal_infos->profile_photo)}}" alt="photo">
                        </div>
                        <div class="form-group text-center">
                            <label for="inputPassword3" class=" col-form-label font-14">Add a photo Here</label><br>
                            <input type="file" class="form-control-file col-md-6" style="margin-left:30%" accept="image/png, image/gif, image/jpeg" name="profile_photo">
                            <p class="text-danger">Note: Photo must not be greater than 5mb</p>
                         </div>
                        </div>
                      </div><hr>
                       
                        <div class="card-footer text-right">
                        <input type="hidden" value="Mydetails" name="tab_name">
                         @if($personal_infos->is_verified == 2 || $personal_infos->is_verified == 0)
                          <input type="submit" name="personal_btn" class="btn btn-primary" value="save cahnge"><br> 
                          <p class="font-15 text-center badge badge-danger float-left mt-3 col-4 text-white"> Declined <i class="fa fa-times"></i></p>
                          <p class="font-17  text-center alert-danger mt-3">{{$personal_infos->comments}}</p>
                         @elseif ($personal_infos->is_verified == 1)
                          <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                         @endif
                      </div>
                     </div>
                    </form>
                     
                    </div>
                      <!-- tab1 ends -->
                      <!-- tab 2 start -->
                      <div class="tab-pane fade @if(Session::get('tab_name') == 'pro-info') show active @endif" id="pro-info" role="tabpanel" aria-labelledby="pro-info-tab">
                        <section>
                         <div class="card-body">
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$pro_infos])}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PATCH')
                            <div class="text_color">
                                <h4>Professional Info</h4>
                                <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                            </div>
                            <div class="row mt-5">
                               <div class="col-md-12">
                                <div class="form-group row">
                                   <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Tell us about you:</label>
                                <div class="col-sm-9">
                                    <textarea name="about" class="form-control" cols="80" rows="5" placeholder="Tell us about your education, the biggest obstacles you overcame, your achievements, and what drives you. Tell us about your teaching strategies and what your pupils/students can expect from you.">{{$pro_infos->about}}</textarea>
                                </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label font-14">Experiences:</label>
                                 <div class="col-sm-9">
                                    <textarea name="experience" class="form-control" cols="80"  rows="5" placeholder="Tell us more about your education, your peak in career. Your skills that makes your education career different from others.">{{$pro_infos->experience}}</textarea>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Onboading video:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" accept="video/mp4,video/x-m4v,video/mkv,.mkv,video/*"  name="onboading_video" >
                                     <p class="text-danger">Note: Video size must not be more than 10mb</p>
                                 </div>
                              </div>
                            </div>
                           </div><hr>
                          
                          <div class="text-right">
                              <div class="mb-4">
                                <input type="hidden" value="pro-info" name="tab_name">
                                @if ($pro_infos->is_verified == 2 || $pro_infos->is_verified == 0)
                                  <input type="submit" class="btn btn-primary" value="save change" name="professional_btn"><br>
                                  <p class="font-15 text-center badge badge-danger float-left mt-3 col-4 text-white"> Declined <i class="fa fa-times"></i></p>
                                  <p class="font-17 text-center alert-danger mt-3">{{$pro_infos->comments}}</p>
                                  @elseif ($pro_infos->is_verified == 1)
                                  <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                  @endif
                              </div>
                            </div>
                        </div>
                       </form>
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
                            <p>Describe your background briefly. Your public profile will include this information so that potential buyers can learn more about you.</p>
                         </div>
                         @php $q_count = 1; @endphp
                         @foreach ($educations as $education)
                          <div class="mt-4">
                           <h3>Qualification {{$q_count++}}</h3>
                         </div>
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$education])}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                          <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">University / College:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->university}}" name="university">
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Result:</label>
                                 <div class="col-sm-9">
                                     
                                     <select name="result" class="custom-select" id="inputGroupSelect05">
                                          <option value="First class" @if($education->result == 'First class') selected @endif>First class</option> 
                                          <option value="Second class" @if($education->result == 'Second class') selected @endif>Second class</option>  
                                          <option value="Third Class" @if($education->result == 'Third Class') selected @endif>Third Class</option> 
                                      </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg" name="result_upload" >
                                 </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Degree:</label>
                                 <div class="col-sm-9">
                                     <!-- <input type="text" class="form-control" value="" name="degree"> -->
                                     <select name="degree" class="custom-select" id="inputGroupSelect05">
                                          <option value="B.Sc" @if($education->degree == 'B.Sc') selected @endif>B.Sc</option> 
                                          <option value="M.SC" @if($education->degree == 'M.SC') selected @endif>M.SC</option>  
                                          <option value="O Level" @if($education->degree == 'O Level') selected @endif>O Level</option> 
                                          <option value="Undergraduate" @if($education->degree == 'Undergraduate') selected @endif>Undergraduate</option>   
                                          <option value="Postgraduate" @if($education->degree == 'Postgraduate') selected @endif>Postgraduate</option>  
                                          <option value="HND" @if($education->degree == 'HND') selected @endif>HND</option> 
                                          <option value="ND" @if($education->degree == 'ND') selected @endif>ND</option>   
                                      </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Passing Year:</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" value="{{$education->passing_year}}" name="passing_year">
                                 </div>
                              </div>
                              
                               <div class="card-footer text-right">
                                 <input type="hidden" value="education" name="tab_name">
                                 @if ($education->is_verified == 2 || $education->is_verified == 0) 
                                   <input type="submit" class="btn btn-primary" value="save change" name="qualification_btn"><br>
                                   <p class="font-15 text-center badge badge-danger float-left mt-3 col-4 text-white"> Declined <i class="fa fa-times"></i></p>
                                   <p class="font-17 text-center alert-danger mt-3">{{$education->comments}}</p>
                                 @elseif ($education->is_verified == 1)
                                   <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                 @endif
                               </div>
                             </div>
                          </div>
                        </form>
                          @endforeach
                          <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div id="qualification-contents"></div>
                              <div class="text-center">
                              <a href="javascript:void(0)" id="add-qualification-btn" class="btn_add"><i class="fa fa-plus"></i> Add another qualification</a>
                              <input type="hidden" id="counter_1" value="{{$educations->count()}}">
                             </div><hr>
                             <div class="text-right mb-5">
                                
                              <input type="hidden" value="education" name="tab_name">
                              <button type="submit" id="education_btn" class="btn btn-primary btn-lg ml-3" name="education_new_btn" disabled>Save</button>
                            </div>
                          </form>
                          <!-- Qualifications ends -->
                          <!-- Certifications start -->
                          @php $c_count = 0 @endphp
                          @foreach ($certifications as $certification)
                          <div class="mt-4">
                            <h3>Certifications {{$c_count+=1}}</h3>
                         </div>
                         <form action="{{ route('teachersform-updates.update',['form_update'=>$certification])}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                         <div class="row mt-5">
                            <div class="col-md-6">
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Title</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Title" value="{{$certification->title}}" name="title">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Description" value="{{$certification->decription}}" name="description">
                                 </div>
                              </div>
                             </div>

                            <div class="col-md-6">
                            <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Issued</label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" placeholder="Issued" value="{{$certification->issued}}" name="issued">
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="inputPassword3" class="col-sm-3 col-form-label">Upload File:</label>
                                 <div class="col-sm-9">
                                     <input type="file" class="form-control-file" accept="image/png, image/gif, image/jpeg"  name="certification_upload">
                                 </div>
                              </div>
                              
                               <div class="card-footer text-right">
                                 <input type="hidden" value="education" name="tab_name">
                                  @if ($certification->is_verified == 2 || $certification->is_verified == 0)
                                    <input type="submit" class="btn btn-primary" value="save change" name="certification_btn"><br>
                                    <p class="font-15 text-center badge badge-danger float-left mt-3 col-4 text-white"> Declined <i class="fa fa-times"></i></p>
                                    <p class="font-17 text-center alert-danger mt-3">{{$certification->comments}}</p>
                                    @elseif ($certification->is_verified == 1)
                                    <p class="font-20 badge badge-success text-white"> verified <i class="fa fa-check"></i></p>
                                 @endif
                              </div>
                           </div>
                          </div>
                         </form>
                         @endforeach
                         <form class="needs-validation" novalidate="" action="{{ route('teachersprofile-settings.update',['profile_setting'=>$user])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                           <div id="certification-contents"></div>
                           <div class="text-center">
                               <a href="javascript:void(0)"  id="add-certification-btn"  class="btn_add"><i class="fa fa-plus"></i> Add another certification</a>
                               <input type="hidden" id="counter_2" value="{{$certifications->count()}}">
                            </div><hr>
                            <div class="text-right mb-5">
                              
                              <input type="hidden" value="education" name="tab_name">
                              <button type="submit" id="certifications_btn" class="btn btn-primary btn-lg ml-3" name="certifications_new_btn" disabled>Save</button>
                            </div>
                         </div>
                       </form>
                     </section>
                   </div>
                   <!-- tab3 ends -->
                     <form action="{{ route('teachersprofile-resubmits.store')}}" method="POST">
                      @csrf
                      <div class="card-body mb-5">
                          @if ($user->is_verified == 0 || $user->is_verified == 2)
                            <input type="hidden" value="{{$user->id}}" name="id">
                            <div class="float-left">
                               <a href="{{ route('redirect')}}" class="btn btn-outline-secondary">Dashboard <i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="float-right">
                              <button type="submit" class="btn btn-primary">Resubmit</button>   
                            </div>
                        @endif
                    </div>
                 </form>
              </div>
            </div>
           </div>
        </div>
      </div>
     </div>
   </div>
 </section>
 </div>
  <script src="{{ asset('back/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/scripts.js')}}"></script>
   <script src="{{ asset('back/assets/js/custom.js')}}"></script>
  <script src="{{ asset('back/assets/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
  <script src="{{ asset('back/assets/js/page/form-wizard.js')}}"></script>
  <script src="{{ asset('front/assets/js/form.js')}}"></script>
</body>
@endsection

 