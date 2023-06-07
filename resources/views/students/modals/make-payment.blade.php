<div style="background-color:#222222d0" class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="formModal">Make Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-left">
              <p class="font-16">you are about to pay <span class="text_color font-17">{{$booking->teacher->first_name." ".$booking->teacher->last_name}}</span> for booked services </p>
           </div>
           <div class="row mt-3">
            <div class="col-md-6">
              <div class="card-body card">
                <p class="text_color">Total Amount</p>
                <h2 class="font-20">₦{{$booking->total_amount}}</h2>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card-body card">
                <p class="text_color">Wallet balance</p>
                @if ($wallet->balance < $booking->total_amount)
                   <h2 class=" text-danger font-20"> ₦{{$wallet->balance}}.00</h2>
                   <p class="text-danger">Insuficent Fund</p>
                  <a href="{{ route('parentswallets.index')}}" class="text-right">Add money to wallet</a>
                @else
                  <h2 class="font-20"> ₦{{$wallet->balance}}</h2>
                @endif
              </div>
              <div class="text-right">
               
              </div>
            </div>
           </div>
            <div class="mb-5 text-center">
             <form action="{{ route('parentspayments.store')}}" method="POST">
                @csrf
               <button type="button" class="btn btn-outline-primary btn-lg mr-5 te m-t-15 waves-effect" data-dismiss="modal" aria-label="Close">Go back</button>
               <input type="hidden" value="{{$booking->id}}" name="id">
               <button type="submit" name="accept_btn" class="btn btn-primary btn-lg ml-5 m-t-15 waves-effect btn-lg text-white"@if($wallet->balance < $booking->total_amount) disabled @endif>Pay</button>
             </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#payModal").modal('show');
    $(".modal-backdrop").hide();
  </script>
