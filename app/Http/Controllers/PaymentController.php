<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Booking;
use App\Models\Wallet;
use App\Models\Activity;
use App\Models\MyClass;
use App\Models\Users;
use App\Models\LogTransaction;
use App\Models\PersonalInformation;
use Nicholasmt\Switchappgo\Switchappgo;
use App\Jobs\MakeApiRequest;
use Illuminate\Support\Facades\Artisan;
use DB;
 
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = Booking::where('id',$request->id)->first();
        if($request->has('decline_btn'))
        {
          
            DB::beginTransaction();
            try{
                  $data=['teacher'=>$booking->teacher_booked,
                          'student'=>$booking->booked_by,
                          'amount'=>$booking->total_amount,
                          'type'=>'payment',
                          'billing_date'=>date('Y-m-d'),
                          'status'=>2,
                          'subject'=>$booking->subject,
                          'invoice'=>'#'.substr(rand(0,time()),0,3),
                      ];
  
                  Transaction::create($data);
                  Booking::where('id',$request->id)->update(['paid'=>2]);
                  Activity::create(['type'=>'decline',
                                    'type_id'=>$booking->id,
                                    'user_id'=>$booking->booked_by,
                                    ]);

                DB::commit();               
                return back()->with('error','payment Declined.');
        }
        catch(\Exception $e)
        {
          DB::rollback();
          return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
        }

      }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }
    public function webhook_handler(Request $request)
    {
            
            $data_request = json_decode($request->getContent(), true);
            $user_id = $data_request['data']['customer']['phone_number'];
            $amount_settled = $data_request['data']['amount_settled'];
            $tx_ref = $data_request['data']['tx_ref'];
            $event = $data_request['event'];
            
            if($event == 'charge.successful')
            {
                $switchapp = new Switchappgo();
                
                $transaction_response = $switchapp->SwitchappAPI('GET','https://api.switchappgo.com/v1/transactions/verify/'.$tx_ref, false);
                $response = json_decode($transaction_response);
                
                if($response->status == 'success')
                {
                     //log transaction
                     LogTransaction::create([
                                             'tx_ref'=>$tx_ref,
                                             'amount'=>$response->data->amount,
                                             'user_id'=>$user_id,
                                             'status'=>1,
                                           ]);
    
                      $log = LogTransaction::where('tx_ref',$tx_ref)->with('user')->first();
                    
                        if($log->completed == 0)
                        { 
                            $users_wallet = Wallet::where('user_id',$user_id)->first();
                            $new_balance = $users_wallet->balance + $log->amount;
            
                            $data=[
                                    'new_balance'=>$new_balance,
                                    'tx_ref'=>$log->tx_ref,
                                    'id'=>$user_id,
                                    'amount'=>$response->data->amount,
                                ];
            
                              MakeApiRequest::dispatchSync($data);
                        } 
                        
                 }
                 else
                 {
                    LogTransaction::create([
                                            'tx_ref'=>$tx_ref,
                                            'amount'=>$response->data->amount,
                                            'user_id'=>$user_id,
                                            'status'=>2,
                                          ]);
                 }

            }
            else
            {
                LogTransaction::create([
                                        'tx_ref'=>$tx_ref,
                                        'amount'=>$amount_settled,
                                        'user_id'=>$user_id,
                                        'status'=>2,
                                      ]);


            }
 
            return response()->json($data_request);  

    }

    public function switchappCallback(Request $request)
    {
         
        $tx_ref = $request->query('tx_ref');
        $switchapp = new Switchappgo();
        $id = session()->get('id');
        $transaction_response = $switchapp->SwitchappAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$tx_ref, false);
        $response = json_decode($transaction_response);
        $logExists = LogTransaction::where(['user_id'=>$id,'tx_ref'=>$tx_ref])->with('user')->first();

         if($response->status == 'success')
          {
               if($logExists)
                { 
                   if($logExists->completed == 0)
                    { 
                        $users_wallet = Wallet::where('user_id',$id)->first();
                        $new_balance = $users_wallet->balance + $logExists->amount;

                        $data=[
                                'new_balance'=>$new_balance,
                                'tx_ref'=>$logExists->tx_ref,
                                'id'=>$id,
                                'amount'=>$logExists->amount,
                            ];

                       MakeApiRequest::dispatchSync($data);
                    }

                      
                } 
                else
                {
                      LogTransaction::create(['tx_ref'=>$tx_ref,
                                                   'amount'=>$response->data->amount,
                                                  'user_id'=>$id,
                                                  'status'=>1,
                                                ]);

                        $log = LogTransaction::where('tx_ref',$tx_ref)->with('user')->first();

                        if($log->completed == 0)
                        { 
                            $users_wallet = Wallet::where('user_id',$id)->first();
                            $new_balance = $users_wallet->balance + $log->amount;

                            $data=[
                                    'new_balance'=>$new_balance,
                                    'tx_ref'=>$log->tx_ref,
                                    'id'=>$id,
                                    'amount'=>$log->amount,
                                ];

                            MakeApiRequest::dispatchSync($data);
                        } 

                
                }
                   
                    return back()->with('fund_success','Transaction was successfull, Your wallet has been Funded');
 
            }
            else
            {
               return back()->with('fund_error',$response->status);
            }
            
           

       
    }


     

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
