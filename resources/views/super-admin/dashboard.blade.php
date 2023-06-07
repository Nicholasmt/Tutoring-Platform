@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row mt-5">
   <nav aria-label="breadcrumb" class="">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="">Admin {{Session::get('first_name')}},</h2></li>
      </ol>
   </nav>
  </div>

<div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-statistic-4">
        <div class="align-items-center justify-content-between">
          <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
              <div class="card-content">
                <h5 class="font-14 ml-2">No. of Teachers</h5>
                 <h2 class="mt-4 font-30 mb-4 ml-2">{{$teachers->count()}}</h2>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
              <div class="float-right mt-3 mr-3">
                <i class="text-info font-18 fa fa-users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-statistic-4">
        <div class="align-items-center justify-content-between">
          <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
              <div class="card-content">
                <h5 class="font-14 ml-2">No. of Students</h5>
                <h2 class="mt-4 font-30 mb-4 ml-2">{{$students->count()}}</h2>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
              <div class="float-right mt-3 mr-3">
                <i class="text-info font-18 fa fa-users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-statistic-4">
        <div class="align-items-center justify-content-between">
          <div class="row ">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pr-0 pt-3">
              <div class="card-content">
                <h5 class="font-14 ml-2">Pending Verifications</h5>
                <h2 class="mt-4 font-30 mb-4 ml-2">{{$pending_verifiactions->count()}}</h2>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pl-0">
              <div class="float-right mt-4 mr-3">
                <i class="text-warning font-18 fa fa-spinner"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-statistic-4">
        <div class="align-items-center justify-content-between">
          <div class="row ">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pr-0 pt-3">
              <div class="card-content">
                <h5 class="font-14 ml-2">Pending Complains</h5>
                   <h2 class="mt-4 font-30 mb-4 ml-2"> {{$pending_complains->count()}} </h2> 
                 </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pl-0">
              <div class="float-right mt-4 mr-3">
                <i class="text-warning font-18 fa fa-spinner"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
  <div class="card table-responsive">
    <div class="text_color text-capitalize mt-3 card-body">
      <h4 class="font-18 float-left">Today's on_going classes</h4>
      <a href="" class="btn btn-light float-right">Refresh page</a>
    </div>
    <div class="float-right card-body">
    
    </div>
    @if ($todays_classes->count() == 0)
       <div class="mt-3 mb-5 text-center">
          <img src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
      </div>
      <div class="mt-0 mb-4 text-center">
           <p class="">No on going classes.</p>
      </div>
    @else
    @php $count = 1; @endphp
    <table class="table mt-1">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Meeting_id</th>
          <th>Subject</th>
          <th>Time</th>
          <th>Duration</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-capitalize">
        @foreach ($todays_classes->chunk(10) as $group)
        @foreach ($group as $class)
           <tr class="card-body">
            <td>{{$count++}}</td>
            <td>{{$class->meeting_id}}</td>
            <td>{{$class->booking->subject}}</td>
            <td>{{$class->date_time}}</td>
            <td>{{$class->duration}} Minutes</td>
            <td>
                <span id="copytext">{{$class->password}}</span>
                  <button  onclick="copyContent()" class="btn btn-dark btn-sm">Copy</button>
                @if($class->supervised == 1)
                   <span class="text-success">supervised <i class="fa fa-check"></i></span>
                @else
                   <a href="{{ route('admin-supervise',$class->meeting_id)}}" class="btn btn-primary mt-2" target="_blank">Supervise class</a>
                @endif
            </td>
          </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
    <div class="justify-content-center">
      <div class="">{{$todays_classes->links()}}</div>
    </div>
    @endif
  </div>
 </div>


 </div>
 </section>
    
@endsection
@section('scripts')
  <!-- <script src="{{ asset('back/assets/bundles/morris/morris.min.js')}}"></script> -->
  <script>
  let text = document.getElementById('copytext').innerHTML;
  const copyContent = async () => {
    try {
      await navigator.clipboard.writeText(text);
      alert('copied to clipboard');
    } catch (err) {
      console.error('Failed to copy: ', err);
    }
  }
</script>
 
 @endsection 