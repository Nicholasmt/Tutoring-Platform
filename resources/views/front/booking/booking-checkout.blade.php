@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/custom-style.css')}}">
@endsection
@extends('front-layout.app')
@section('body')
<header id="header-wrap">
@include('front-layout.top-nav')
</header>
<div class="main-container section-padding mt-5">
 <div class="container">
<div class="text-left">
<!-- <a href="{{ route('parents-schedule-date')}}" class="button_btn">back</a> -->
</div>
 
<!-- aside start -->
<form action="{{ route('parents-store-booking')}}" method="POST"> 
@csrf
<div class="row mt-5 ml-5">
<div class="col-lg-5 col-md-5 col-xs-5">
<aside>
<div class="widge">
<p class="checkout_title">Booking Checkout</p>
<div class="float-left">
<img class="img-fluid mt-5" src="{{ asset($personal_info->profile_photo)}}" height="94" width="132" alt="image">
</div>
<div class="float-left mt-5 ml-4">
<h5 class="text_color text-capitalize">{{$teacher->first_name ." ".$teacher->last_name}}</h5>
<p class="">{{$personal_info->town .",". $personal_info->state}}</p>
<h5 class="mb-5 mt-2 text_color">₦{{number_format($hourly_pay->amount)}} / hr</h5>
</div>
</div>
<?php Session::flash('token','token'); ?>
<input type="hidden" name="booked_dates" value="{{$selected_dates}}">
<!-- <input type="hidden" name="booked_times" value="{{json_encode($times)}}"> -->
<input type="hidden" name="booked_times" value="{{$times}}">
<input type="hidden" name="subject" value="{{$subject}}">
<input type="hidden" name="category" value="{{$category}}">
<input type="hidden" name="meetup" value="{{$meetup}}">
<input type="hidden" name="teacher_id" value="{{$teacher_id}}">
<input type="hidden" name="expectations" value="{{$expectation}}">
<div class="float-left">
<span class="booked_text">Booked Days</span>
@foreach (json_decode($selected_dates) as $date)
<div class="mt-2">
@php $dateformat = new DateTime($date); @endphp
<span class="mt-5">{{$dateformat->format('l')}}, {{$dateformat->format('d')}} {{$dateformat->format('F')}} {{$dateformat->format('Y') }} </span>
<!-- <input style="font-size:25" class="form-control text-center mb-3" value=" " readonly> -->
@foreach (json_decode($times) as $time)
@php
  $list = explode(',', $time);
@endphp
@if ($list[1] == $date)
<span style="font-size:15px" class="ml-5 mt-2">{{date('h:i a',strtotime($list[0]))}}</span>,
 
@endif 
@endforeach 

</div>  
@endforeach

<div class="mt-5 mb-5">
<input type="hidden" id="amount" name="amount" value="{{$total_amount}}">
<span>Total amount</span> 
<span class="float-right booking_amount"> ₦{{number_format($total_amount)}}</span>
</div>
</div>

</div>
</aside>
<div class="col-lg-6 col-md-6 col-xs-6">
<div class="text-left">
<span class="checkout_title">Make Payments</span><br>
<span>Default payment method is your wallet, <br> But you can pay with card due to Insuffient Fund. </span> 
<div class="mt-3">
<!-- wallet -->
 
<div id="with_wallet" class="wallet-link">
<div class="card wallet_bg">
<div class="row">
<div class="card-body col-xl-8 col-md-8 col-sm-8">   
<span class="ml-3 float-left font-14 font-weight-400"> Olukotide Wallet</span> 
</div>
<div class="card-body col-xl-4 col-md-4 col-sm-4">
<img class="ml-4 float-right" src="{{ asset('front/assets/img/favicon.png')}}" height="40" width="40" alt="visa-logo"> 
</div>
</div>
<div class="card-body" id="wallet">
<span>Total Balance</span> 
<span class="booking_amount float-right"> ₦{{number_format($wallet->balance)}}</span>
</div>
</div>
</div>
 
<!-- wallet ends -->
</div>
<!-- debit_card -->
@if($total_amount > $wallet->balance)
<div id="add_debitCard" class="wallet-link">
<div class="card card_bg">
<div class="row">
<div class="card-body col-xl-8 col-md-8 col-sm-8">   
<span class="ml-3 font-14 font-weight-400"> Debit Card
<img class="ml-2" src="{{ asset('back/assets/img/icons/locked_key.png')}}" height="13.33" width="13.33" alt="icon"> 
</span> 
</div>
<div class="card-body col-xl-4 col-md-4 col-sm-4">
  <span class="float-right">
    <img class="mr-1" src="{{ asset('back/assets/img/icons/verve.png')}}" height="21" width="30" alt="verve"> 
    <img class="mr-1" src="{{ asset('back/assets/img/icons/visa-logo.png')}}" height="6.84" width="20" alt="visa-logo"> 
    <img class="" src="{{ asset('back/assets/img/icons/Mastercard.png')}}" height="11.72" width="19.56" alt="mastercard"> 
 </span>
</div>
</div>
<div class="card-body" id="debit_card">
 <div class="card">
<span>*****  *****  *****  **** 1234</span> <span><i class="lni-check"></i></span><br>
<span>06/2024</span>
{{-- <button type="button" id="add_card_btn" class="button_btn text-right">add another card</button> --}}
<div class="mt-3 another_card">
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
</div>
</div>
</div>
@endif
<!-- debit card Ends -->
<!-- paypal -->
<!-- <div id="with_paypal" class="wallet-link">
<div class="card paypal_bg">
<div class="row">
<div class="card-body col-xl-8 col-md-8 col-sm-8">
<span class="ml-3 float-left font-14 font-weight-400">Paypal</span>
</div>
<div class="card-body col-xl-4 col-md-4 col-sm-4">
<img class="ml-4 float-right" src="{{ asset('back/assets/img/icons/paypal.png')}}" width="59" height="22" alt="paypal"> 
</div>
</div>
<div class="card-body paypal_text" id="paypal">
<span class="">You’ll be redirected to PayPal for payment after you <br> click “make payment”</span>
</div>
</div>
</div> -->
<!-- paypal end -->

</div>
<div class="text-right mt-4 mb-5">
  @if($total_amount > $wallet->balance)
   <span id="info" class="text-info font-17 mt-4">Insuffient fund! select card option</span> <br>
   <p id="wallet_button" class="btn btn-danger card-body mt-4">Insuffient Fund!</p><br>
  @else
    @if(!Session::has('fund_success'))
      <button id="wallet_button" type="submit"  class="btn btn-common mt-4">pay ₦{{number_format($total_amount)}}</button>
    @endif
  @endif
  @if(Session::has('fund_success'))
    <span class="alert alert-success">{{ Session::get('fund_success') }} </span><br>
    <button type="submit" class="btn btn-common mt-4">Book</button>
  @else 
    <span class="alert alert-error">{{ Session::get('fund_error') }} </span>
    <a href="javascript:void(0)" id="card_button" class="btn btn-common mt-4">pay ₦{{number_format($total_amount)}}</a>
  @endif
     {{-- <a href="#" id="paypal_button" class="btn btn-common mt-4">Make Payment </a> --}}
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
 
 @include('front-layout.footer')

 <a href="#" class="back-to-top">
<i class="lni-chevron-up"> </i>
</a>
<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>

 <div id="checkout_booking"></div>

 
<script src="{{ asset('front/assets/js/jquery-min.js')}}"></script>

 
<script src="{{ asset('front/assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery-UI-v1.12.1.js')}}"></script>
 
<script src="{{ asset('front/assets/js/multidatePicker.js')}}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('front/assets/js/wow.js')}}"></script>
<script src="{{ asset('front/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="{{ asset('front/assets/js/payment_method.js')}}"></script> 
<script src="https://inline.switchappgo.com/v1/switchapp-inline.js"></script>

 <script>
   const switchappClient = new SwitchAppCheckout({
        publicApiKey: "pk_test_qCzTZySsnSefcfuzrqh7tPgFH"
      }); 

  $("#card_button").on("click", function(){

    var fundAmount = $("#amount").val();
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