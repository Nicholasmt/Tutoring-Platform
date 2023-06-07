@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('back-layout.body')
@section('content')
<section class="section">
  <div class="row">
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
        <li class="breadcrumb-item text-info text_gh"><h2 class="ml-1">Wallet</h2></li>
      </ol>
   </nav>
  </div>
   @include('back-layout.error')
   {{-- Transaction message Start --}}
   @if(Session::has('fund_success'))
    <div style="border-left: 4px solid rgb(3, 54, 17)" class="alert alert-success alert-dismissible show fade mb-2">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
         </button>
         <span class="text- ">{{Session::get('fund_success')}}  </span>
       </div>
   </div>
    @endif
    @if(Session::has('fund_error'))
     <div style="border-left: 4px solid red" class="alert alert-light alert-dismissible show fade mb-2">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
         </button>
         <span class="text-danger">{{Session::get('fund_error')}}</span>  
       </div>
   </div>
    @endif
  {{-- Transaction message Ends --}}
  <div class="row">
   <div class="col-md-6">
     <div class="">
       <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content mb-5">
                        <p class="font-14 ml-3 font-weight-bold"> My Wallet</p>
                        @if ($my_wallet->balance == null)
                        <h2 class="mt-4 font-30 mb-4 ml-3" id="hide_balance">₦0.00</h2>
                        <h2 class="mt-4 font-30 mb-4 ml-3" id="show_balance">xxxx xx</h2>
                        @else
                        <h2 class="mt-4 font-30 mb-5 ml-3" id="hide_balance"> ₦{{number_format($my_wallet->balance)}}</h2>
                        <h2 class="mt-4 font-30 mb-5 ml-3" id="show_balance">xxxx.xx</h2>
                        @endif
                       </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="float-right mt-3">
                        <img class="mr-4" id="show_wallet" src="{{ asset('back/assets/img/icons/icon7.png')}}" alt="img">
                        <i class="fa fa-eye-slash text_gray mr-4 font-16" id="hide_wallet"></i>
                      </div>
                    </div>
                  </div><hr>
                  <div class=" col-md-12 text-right mb-4">
                     <a href="javascript:void(0)" data-toggle="modal" data-target="#fundModal" class=""> Fund Wallet</a>
                     <a href="" class="ml-4" data-toggle="modal" data-target="#withdrawModal" class="normal_link ml-4"> Withdraw</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

     <div class="col-md-6">
       <div class="row">
         <div class="col-xl-12">
           <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="card-content mt-4 mb-3">
                    <div class="float-left">
                      <h5 class="font-16 text_color ml-3">Payment method</h5>
                      <p class="font-12 ml-3">Change how you pay for your services.</p>
                    </div>
                    <div class="float-right">
                       <a href="" data-toggle="modal" data-target="#paymentMethodModal" class="btn_default mr-5"> View payment method</a> 
                    </div>
                     
                  </div>
                <div class="row custom_card mb-4">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3  debit_card">
                      <div class="card-content mb-5">
                        <div class="float-left">
                        <i style="color:#5181C4" class="fab fa-cc-visa font-40"></i> 
                        </div>
                        <div class="float-right">
                          <h5 class="font-12 text_color">Visa ending in 1234</h5>
                          <span class="font-11">Expiry 06/2024</span><br>
                          <span class="font-11 mb-2"><i class="fas fa-envelope"></i> evelynadebayo@gmail.com</span>
                        </div>
                       </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="mb-5 mt-4 text-right">
                          <a href="" style="font-weight: 400 !important;" class="btn btn-light mr-4 font-weight-400">Edit</a>
                       </div>
                      </div>
                   </div>
                </div>
              </div>
            </div>
            
          </div>
         </div>
      </div>

     <div class="col-md-12" id="transaction-page"></div>

     <div id="close_transaction-page" class="col-md-12">
        @include('students.wallet.paginate.transaction')
     </div>

    </div>
</section>

<!-- view payment method modal start -->
<div class="modal fade modal_bg" id="paymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modal_title" id="formModal">Payment Method</h5><br>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span class="card-body font-12 ml-1 font-weight-400 modal_margin">Choose your preferred payment method</span>
        <div class="modal-body">
          <a id="add_debitCard" class="wallet-link">
           <div class="card card_bg">
             <div class="row">
                <div class="card-body col-xl-8 col-md-8 col-sm-8">   
                  <span class="ml-3 float-left font-14 font-weight-400"> Debit Card
                    <img class="ml-2" src="{{ asset('back/assets/img/icons/locked_key.png')}}" height="13.33" width="13.33" alt="icon"> 
                  </span> 
                </div>
                <div class="card-body col-xl-4 col-md-4 col-sm-4">
                  <span class="float-right">
                    <img class="mr-2" src="{{ asset('back/assets/img/icons/verve.png')}}" height="21" width="30" alt="verve-logo"> 
                    <img class="mr-2" src="{{ asset('back/assets/img/icons/visa-logo.png')}}" height="6.84" width="20" alt="visa-logo"> 
                    <img class="mr-2" src="{{ asset('back/assets/img/icons/Mastercard.png')}}" height="11.72" width="19.56" alt="mastercard"> 
                 </span>
               </div>
              </div>
              <div class="card-body" id="debit_card">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Card Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Card Number">
                </div>
                <div class="form-group row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4">
                    <input type="text" class="form-control" placeholder="Expiration Date">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4">
                  <input type="text" class="form-control" placeholder="CVV">
                  </div>
                </div>
             </div>
            </div>
            </a>
            
            <a id="with_paypal" class="wallet-link">
              <div class="card paypal_bg">
                <div class="row">
                  <div class="card-body col-xl-8 col-md-8 col-sm-8">
                    <span class="ml-3 float-left font-14 font-weight-400">Paypal</span>
                  </div>
                  <div class="card-body col-xl-4 col-md-4 col-sm-4">
                  <img class="float-right" src="{{ asset('back/assets/img/icons/paypal.png')}}" width="59" height="22" alt="paypal"> 
                  </div>
                </div>
                <div class="card-body paypal_text" id="paypal">
                  <span class="">You’ll be redirected to PayPal for payment after you <br> click “make payment”</span>
                </div>
              </div>
            </a>

            <div class="text-right">
              <a href="" id="card_button" class="primary ">Add</a>
              <a href="" id="paypal_button" class="primary ">Make Payment</a>
            </div>
         </div>
       </div>
     </div>
  </div>
  <!-- view payment method modal Ends -->

<!-- withdraw modal start -->
<div style="background-color:#3d4044c5" class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
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
               <button type="button" class="btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
               <a id="finish-btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect text-white" data-toggle="modal" data-target="#exampleModal">Withdraw</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- withdraw modal Ends -->



<!-- Fund modal start -->
<div style="background-color:#3d4044c5" class="modal fade" id="fundModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header ml-5">
         
          {{-- <h5 class="modal-title text_color" id="formModal">Fund your Wallet</h5> --}}
          <img src="{{ asset('back/assets/img/switchapp-icon.svg')}}" alt="" class="ml-5">
          <span class="font-18 text_color ml-2 mt-2">Switchapp</span><br>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('parents-fundWallet')}}" method="POST" class="needs-validation" novalidate="">
          @csrf
         <div class="modal-body">
           <div class="card-body">
              <div class="form-group">
                 <input type="number" class="form-control" id="amount" placeholder="Amount" required>
                 <div class="invalid-feedback"> Enter Amount. </div>
              </div>
             </div>
            <div class="card-body text-center mt-3 mb-5">
              <button type="button" class="btn btn-outline-primary btn-lg float-left" data-dismiss="modal" aria-label="Close">Go back</button>
              <button type="button" id="fund" class="btn btn-primary btn-lg float-right btn-lg">Fund Wallet</button>
            </div>
          
         </div>
      </form>
      </div>
    </div>
  </div>
  <!-- Deposit modal Ends -->
 
@endsection

@section('scripts')
 <script src="{{ asset('front/assets/js/paginator.js')}}"></script> 
 <script src="{{ asset('front/assets/js/wallet-actions.js')}}"></script> 
 <script src="{{ asset('front/assets/js/payment_method.js')}}"></script> 
 <script src="https://inline.switchappgo.com/v1/switchapp-inline.js"></script>

 <script>
   const switchappClient = new SwitchAppCheckout({
        publicApiKey: "pk_test_qCzTZySsnSefcfuzrqh7tPgFH"
      }); 

  $("#fund").on("click", function(){

    var fundAmount;
    fundAmount = $("#amount").val();
    
    $('#fundModal').modal('toggle');
      // alert(fundAmount);

      function onClose(args) {
            // alert("Modal closed with args: " + args);
            console.log("Modal closed with args: ", args);
          }

          function onSuccess(args) {
            // alert("payment successful with args: " + args);
            console.log("payment successful with args: ", args);
          }
      
         const paymentDetails = {
            country: "NG",
            currency: "NGN",
            amount: fundAmount,
            customer: {
              full_name: "{!!$user->first_name.' '.$user->last_name!!}",
              email: "{!!$user->email!!}",
              phone_number: "{{$user->id}}"
            },

            // (OPTIONAL) Customize the checkout page
            title: "Fund Wallet",
            logo_url: "https://olukotide.picanasavings.com/front/assets/img/logo.svg",
            description: "This is a test payment",
            
            // (OPTIONAL) Extra helpful data to the payment
            metadata: {
              cartId: 12,
              flightId: "x-404-251",
            },

            // (OPTIONAL) Specify actions to run upon closing the checkout page or completing payment
            onClose,
            onSuccess,
          }

          switchappClient.showCheckoutModal(paymentDetails)
           .then((p) => {
        console.log(`Successfully initialized a new payment`);
    });
  });
 </script>
  
 @endsection 


  