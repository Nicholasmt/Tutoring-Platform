@section('head')
 <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
 <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Complains</h2></li>
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
     <table class="table table-bordered mt-4" id="table-1">
      <thead>
       <tr>
        <th scope="col">S/N</th>
        <th scope="col">Teacher</th>
        <th scope="col">Students</th>
        <th scope="col">Date</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    
    @php
       $count=1;
    @endphp
    @foreach ($complains->chunk(20) as $groups)
     @foreach($groups as $complain)
     <tr>
        <td scope="row">{{$count++}}</td>
        <td>{{$complain->meeting->booking->teacher->first_name." ".$complain->meeting->booking->teacher->last_name}}</td>
        <td>{{$complain->meeting->booking->who_booked->first_name." ".$complain->meeting->booking->who_booked->last_name}}</td>
        <td>{{$complain->created_at->diffForHumans()}}</td>
        <td><a href="{{ route('admincomplaints.show',['complaint'=>$complain->id])}}" class="btn btn-primary">View details</a></td>
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