@section('head')
 <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
 <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row mt-3">
    <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Verify Accounts</h2></li>
      </ol>
    </nav>
  </div>

<div class="section-body row">
<div class="card-body table-responsive">
    <div class="row mt-0">
        <div class="float-left mt-3 mr-5">
            <spanp class="">Awiting Verification </span><br>
        </div>
      </div>
     <table class="table table-bordered mt-4" id="table-1">
      <thead>
       <tr>
        <th scope="col">S/N</th>
        <th scope="col">Teacher</th>
        <th scope="col">Email Address</th>
        <th scope="col">Date Registerd</th>
         <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    @php
       $count=1;
    @endphp
    @foreach ($users->chunk(20) as $groups)
     @foreach($groups as $user)
        <td scope="row">{{$count++}}</td>
        <td>{{$user->first_name." ".$user->last_name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td><a href="{{ route('adminverifications.show',['verification'=>$user->id])}}" class="btn btn-primary">View details</a></td>
    </tr>
    @endforeach
    @endforeach
    
   </tbody>
   </table>
   <div class="justify-center">
        
   </div>
  </div>
</div>
 </section>
    
@endsection
@section('scripts')
<script src="{{ asset('back/assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('back/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('back/assets/js/page/datatables.js')}}"></script>  
@endsection 