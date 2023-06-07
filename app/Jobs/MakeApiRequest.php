<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\LogTransaction;
use App\Models\Wallet;
use App\Models\Activity;
use App\Models\Transaction;

class MakeApiRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //credit users wallet  
        Wallet::where('user_id',$this->data['id'])->update(['balance'=>$this->data['new_balance']]);
        LogTransaction::where('tx_ref',$this->data['tx_ref'])->update(['completed'=>1]);
       
        $tx =  Transaction::create([ 
                           'student'=>$this->data['id'],
                           'amount'=> $this->data['amount'],
                           'type'=>'Fund wallet',
                           'billing_date'=>date('Y-m-d'),
                           'status'=>1,
                           'invoice'=>$this->data['tx_ref'],
                        ]);

       Activity::create(['type'=>'Fund wallet',
                         'type_id'=>$tx->id,
                          'user_id'=>$this->data['id'],
                       ]);

    }
}
