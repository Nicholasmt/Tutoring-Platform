@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
<div class="row mt-3">
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2>Review Complain</h2></li>
      </ol>
   </nav>
  </div>
  <div class="mb-1">
    <a href="{{ route('admincomplaints.index')}}" class="mt-2"> <i class="fa fa-chevron-left"></i> Back</a>
  </div>
  @include('back-layout.error')
  <div class="section-body card">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="col-md-12">
             <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                      <h4 class="text-center"> Parent / Student's information</h4>
                        <div class="text-center mt-3">
                            <img src="{{ asset($student_info->profile_photo)}}" height="200" width="265" alt="photo"><br>
                            <span class="text-center text_color font-20 mt-4 text-capitalize">{{$complain->meeting->booking->who_booked->first_name." ".$complain->meeting->booking->who_booked->last_name}}</span> <br>
                            <span class="text-center font-18">{{$student_info->phone}}</span><br>
                           <span class="text-center font-18">{{$student_info->address}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                      <h4 class="text-center"> Teacher's information</h4>
                        <div class="text-center mt-3">
                            <img src="{{ asset($teacher_info->profile_photo)}}" height="200" width="265" alt="photo"> <br>
                            <span class="text-center font-20 text-capitalize mt-3 text_color">{{$complain->meeting->booking->teacher->first_name." ".$complain->meeting->booking->teacher->last_name}}</span> <br>
                            <span class="text-center font-18">₦{{$hourly_pay->amount}} / hr</span><br>
                            <span class="text-center font-18">{{$teacher_info->phone}}</span> <br>
                            <span class="text-center font-18">{{$teacher_info->address}}</span> <br>
                        </div>
                    </div>
                </div>
             </div>  <hr>
           </div>
          <div class="col-md-12">
            <div class="card-body">
              <div class="text-center">
                <h4>Class Details</h4>
              </div>
              <div class="row mt-3 card-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-18 text_color">Subject:</label><br>
                       <span class="font-16">{{$complain->meeting->booking->subject}}</span>
                    </div>
                    <div class="form-group">
                        <label class="font-18 text_color">Class duration:</label><br>
                        <span class="font-16">{{$complain->meeting->duration}} Minutes</span>
                    </div>
                </div>
                <div class="col-md-6 text">
                   <div class="form-group ml-5">
                      <label class="font-18 text_color ml-5">Date / Time:</label> <br>
                      <span class="font-16 ml-5">{{date('h:i a',strtotime($complain->meeting->date_time))}}</span><br>
                      <span class="font-16 ml-5">{{$complain->meeting->booking->date->format('d')}}  {{date('F', strtotime($complain->meeting->booking->date))}} {{$complain->meeting->booking->date->format('Y')}}</span>
                   </div>
                   <div class="form-group ml-5">
                     <label class="font-18 text_color ml-5">Meeting ID:</label> <br>
                     <span class="font16 ml-5">{{$complain->meeting->meeting_id}}</span>
                   </div>
                 
              </div>
             </div> <hr>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card-body">
              <div class="text-center">
                <h4>Complaint Message</h4>
              </div>
              <div class="mt-4">
                  <div class="form-group">
                        <label class="font-18">Title</label><br>
                        <span class="font-16">{{$complain->title}}</span>
                    </div>
                   <div class="form-group">
                        <label class="font-18">Content</label>
                        <p class="font-16">{{$complain->message}}</p>
                   </div>
               </div>
            </div>
          </div>
          <div class="text-center  col-md-12 mb-5">
            <form action="{{ route('admincomplaints.update',['complaint'=>$complain->id])}}" method="POST">
              @csrf
              @method('PATCH')

              @if($complain->status == 1)
                 <span class="badge badge-info font-20">Reviewed!</span>
              @else
                <button type="submit" name="cancel_btn" class="btn btn-danger mr-5 btn-lg">Cancel</button>
                <button type="submit" name="refund_btn" class="btn btn-primary ml-5 btn-lg">Refund</button>
              @endif

            </form>
        </div>
       </div>
      </div>
    </div>
   </div>
  </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('front/assets/js/form.js')}}"></script> 
@endsection
