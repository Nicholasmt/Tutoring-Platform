<!-- modal start -->
<div style="background-color:black" class="modal fade" id="checkoutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text_color" id="formModal">Booking checkout </h5>
           <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text_color">
        <h5 class="mt-1 mb-3 text-center">Booked Day(s) and Time</h5>
         <form action="{{ route('parents-store-booking')}}" method="POST"> 
          @csrf
            <div class="row">
              <?php Session::flash('token','token'); ?>
              <input type="hidden" name="booked_dates" value="{{$selected_dates}}">
              <input type="hidden" name="booked_times" value="{{json_encode($times)}}">
              <input type="hidden" name="subject" value="{{$subject}}">
              <input type="hidden" name="category" value="{{$category}}">
              <input type="hidden" name="meetup" value="{{$meetup}}">
              <input type="hidden" name="teacher_id" value="{{$teacher_id}}">

                @foreach (json_decode($selected_dates) as $date)
                <div class="col-md-6">
                   @php $dateformat = new DateTime($date); @endphp
                    <input style="font-size:25" class="form-control text-center mb-3" value="{{$dateformat->format('l')}}, {{$dateformat->format('d')}} {{$dateformat->format('F')}} {{$dateformat->format('Y') }} " readonly>
                     @foreach ($times as $time)
                    @php
                       $list = explode(',', $time);
                    @endphp
                    @if ($list[1] == $date)
                     
                      <span style="font-size:15px" class="mt-2">{{date('h:i A',strtotime($list[0]))}}</span>,
                    
                    @endif 
                    @endforeach  
                    </div>  
                @endforeach
              </div><hr>
           @php
                $array_count = count($times);
                $total_amount = $hourly_pay->amount * $array_count;
           @endphp
           <div class="row mt-4 mb-5 text-center">
              <input type="hidden" name="amount" value="{{$total_amount}}">
              <div class="col-6" id="wallet">
                <h5 style="font-size:18px">Wallet Balance: <span style="font-size:24px;color:black; font-weight:600"> ₦{{$wallet->balance}}</span></h5>
                <p style="font-size:15px"  class="badge badge-danger">insufficent fund!</p><br>
                
              </div>
              <div class="col-6" id="amount">
                <h5 style="font-size:20px">Total: <span style="font-size:24px;color:black; font-weight:600"> ₦{{number_format($total_amount)}}</span></h5>
              </div>
           </div>

           <div class="mb-5 mt-4 text-center">
              <button type="button" class="btn btn-outline-default mr-5 te m-t-15 waves-effect" id="close_modal_2" data-dismiss="modal" aria-label="Close">Go back</button>
              <button type="submit" id="walletPay_btn" class="btn btn-common">Pay</button>
              <a id="paydirect" href="#" class="btn btn-common mt-2">Pay direct with card</a>
          </div>
         </form>
        </div>
      </div>
    </div>
  </div>

  <script>
      $("#checkoutModal").modal('show');
      $(".modal-backdrop").hide();
      
   
   var wallet_balance = {!!$wallet->balance!!}
    var amount = {!!$total_amount!!}
    if(amount > wallet_balance)
    {
        $("#wallet").show();
        $("#paydirect").show();
        $("#walletPay_btn").hide();
        // $("#book_btn").attr("disabled",true);
    }
    else
    {
       $("#wallet").hide();
       $("#paydirect").hide();
        // $(".book_btn").removeAttr("disabled"); 
    }
</script>
  
  <!-- modal Ends -->
  <!-- data-keyboard="false" -->