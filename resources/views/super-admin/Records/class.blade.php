@section('head')
 <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
 <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb" class="mt-5">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">All Class Records</h2></li>
      </ol>
   </nav>
  </div>

<div class="row">
<div class="card-body table-responsive">
    <div class="row">
        <div class="float-left mr-5">
            <!-- <spanp class="">Complaints</span><br> -->
        </div>
      </div>
     <table class="table table-bordered" id="table-1">
      <thead>
       <tr>
        <th scope="col">S/N</th>
        <th scope="col">Meeting ID</th>
        <th scope="col">Teacher</th>
        <th scope="col">Students</th>
        <th scope="col">Subject</th>
        <th scope="col">Time</th>
        <th scope="col">Duration</th>
        <th scope="col">Date</th>
        <!-- <th scope="col">Actions</th> -->
        </tr>
    </thead>
    <tbody>
    <tr>
    @php
       $count=1;
    @endphp
    @foreach ($classes->chunk(20) as $groups)
     @foreach($groups as $class)
        <td scope="row">{{$count++}}</td>
        <td>{{$class->meeting_id}}</td>
        <td>{{$class->booking->teacher->first_name." ".$class->booking->teacher->last_name}}</td>
        <td>{{$class->booking->who_booked->first_name." ".$class->booking->who_booked->last_name}}</td>
        <td>{{$class->booking->subject}}</td>
        <td>{{date('h: i a', strtotime($class->date_time))}}</td>
        <td>{{$class->duration}} Minutes</td>
        <td>{{$class->created_at->diffForHumans()}}</td>
        <!-- <td><a href="{{ route('admincomplaints.show',['complaint'=>$class->id])}}" class="btn btn-primary">View details</a></td> -->
    </tr>
    @endforeach
    @endforeach
    
   </tbody>
   </table>
    
  </div>
</div>
 </section>
    
@endsection
@section('scripts')
<script src="{{ asset('back/assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('back/assets/js/page/datatables.js')}}"></script>  
@endsection 