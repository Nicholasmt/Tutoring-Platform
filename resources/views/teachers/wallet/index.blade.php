@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="ml-3">Wallet</h2></li>
      </ol>
   </nav>
  </div>
  <div class="row">
   <div class="col-md-6">
     <div class="col-xl-12">
       <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content mb-5">
                        <h5 class="font-14 ml-3">My Wallet</h5>
                        @if ($my_wallet->balance == null)
                        <h2 class="mt-4 font-30 mb-4 ml-3" id="hide_balance">₦0.00</h2>
                        <h2 class="mt-4 font-30 mb-4 ml-3" id="show_balance">xxxx xx</h2>
                        @else
                        <h2 class="mt-4 font-30 mb-5 ml-3" id="hide_balance">₦{{number_format($my_wallet->balance)}}</h2>
                        <h2 class="mt-4 font-30 mb-5 ml-3" id="show_balance">xxxx xx</h2>
                        @endif
                       </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="float-right mt-3">
                         <img class="mr-5" id="show_wallet" src="{{ asset('back/assets/img/icons/icon7.png')}}" alt="img">
                         <i class="fa fa-eye-slash text_gray mr-5 font-16" id="hide_wallet"></i>
                    </div>
                    </div>
                  </div><hr>
                  <div class=" col-md-12 text-right mb-4">
                      <a href="" class="ml-4" data-toggle="modal" data-target="#exampleModal" class="normal_link ml-4"> Withdraw</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-12" id="transaction-page_2"></div>

      <div id="close_transaction-page_2" class="col-md-12">

      @include('teachers.wallet.paginate.transactions')

    </div>


    </div>
</section>

<!-- modal start -->
<div style="background-color:black" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text_color" id="formModal">Withdraw Funds</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Amount to withdraw</label>
              <input type="number" class="form-control" name="amount">
            </div>
            <div class="mb-5 mt-4 text-center">
            <button type="button" class="  btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
            <a id="finish-btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg text-white" data-toggle="modal" data-target="#exampleModal">Withdraw</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal Ends -->



   
@endsection
@section('scripts')
<script src="{{ asset('front/assets/js/wallet-actions.js')}}"></script> 
 
 @endsection 