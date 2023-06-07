<div class="table-responsive">
    <div class="mt-5">
        <div class="float-left mt-3 mb-4">
            <span class="font-16 font-weight-bold">Transactions </span><br>
            <span class="">See payment history below</span>
        </div>
       <div class="float-right mt-3 ml-5"> 
           <a href="" class="btn btn-light"><i class="fa fa-cloud-download-alt"></i> Download all</a>
        </div>
    </div>
    @if($transctions->count() == 0)
         <div class="mt-5">
              <div class="text-center">
                <img class="mt-5" src="{{ asset('front/assets/img/featured/empty.png')}}" height="140" width="101" alt="">
                <p class="">You have no payment/transaction history</p>
              </div>
         </div>
     @else
    <table class="table table-bordered mt-4">
     <thead class="">
      <tr>
        <th><input type="checkbox" class="form-check" id="customCheck1"></th>
        <th scope="col">Invoice</th>
        <th scope="col">Billing Date</th>
        <th scope="col">Teacher</th>
        <th scope="col">Amount</th>
        <th scope="col">Type</th>
        <th scope="col">Status</th>
        <th scope="col">Subject</th>
      </tr>
     </thead>
     <tbody>
    
       <tr class="text-capitalize">
        @foreach ($transctions as $transction)
        <td><input type="checkbox" class="form-check" id="customCheck1"></td>
        <td scope="row">{{$transction->invoice}}</td>
        <td scope="row"> {{date('F', strtotime($transction->billing_date)) ." ".$transction->billing_date->format('d') ." ". $transction->billing_date->format('Y') }}</td>
        <td>
            @if ($transction->teacher !== null)
              {{$transction->teachers->first_name." ".$transction->teachers->last_name}}
            @endif
        </td>
        <td>₦{{number_format($transction->amount)}}</td>
        <td>{{$transction->type}}</td>
        <td class="font-10">
            @if ($transction->status == 0)
                <p class="">Pending</p>
            @elseif ($transction->status == 1)
            <p class="badge badge-success"><i class="fa fa-check"></i> success</p>
            @elseif ($transction->status == 2)
            <p class="badge badge-danger"> <i class="fa fa-check"></i> Cancelled</p>
            @endif
        </td>
        <td>{{$transction->subject}}</td>
        </tr>
        @endforeach
       
        </tbody>
    </table>
    @endif
    <div class="justify-center">
        {{$transctions->links()}}
    </div>
</div>
