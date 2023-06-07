@section('head')
 <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
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
@include('back-layout.error')
<div class="row">
<div class="card-body">
    <div class="row">
      <div class="col-md-6">
         <section>
           <form  class="needs-validation" novalidate="" action="{{ route('adminsettings.update',['setting'=>$admin])}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="text_color">
                <h4 class="text_color">Personal information</h4>
            </div>
             <div class="form-group mt-4">
                <label class="font-17">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{$admin->first_name}}" required>
             </div>
             <div class="form-group">
                <label class="font-17">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{$admin->last_name}}" required>
             </div>
             <div class="form-group">
                <label class="font-17">Email</label>
                <input type="text" class="form-control" name="email" value="{{$admin->email}}" required>
             </div>
             <div class="form-group">
                 <input type="submit" class="btn btn-primary" name="personal_btn" value="save change">
             </div>
           </form>
         </section>
        </div>
        <div class="col-md-6">
        <section>
          <form class="needs-validation" novalidate="" action="{{ route('adminsettings.update',['setting'=>$admin])}}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PATCH')
              <div class="card-body">
                <div class="text_color">
                    <h4 class="text_color">Password</h4>
                    <p>Change your password to protect your account</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                    <div class="form-group">
                            <label for="inputPassword3" class="col-form-label font-14">Current Password</label>
                            <input type="password" class="form-control" placeholder="Current Password" value="" name="current_password" required>
                        </div>
                        <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-form-label font-14">New Password</label>
                            <input type="password" class="form-control" placeholder="New Password" value="" name="new_password" required>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-form-label font-14">Confirm new Password</label>
                            <input type="password" class="form-control" placeholder="Confirm new Password" value="" name="confirm_password" required>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="text-right mb-5">
                       <input type="submit" class="btn btn-primary ml-3" name="password_btn" value="Save change">
                    </div>
                </div>
              </form>
            </section>
        </div>
      </div>
   </div>
  </div>
 </section>
    
@endsection
@section('scripts')
  
@endsection 