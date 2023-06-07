<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZoomMeeting;
use App\Models\ClassFeedback;
use App\Jobs\MailNofications;
use App\Models\Wallet;
use App\Models\HourlyPay;
use App\Http\Library\Zoom;

class ZoomWebHookController extends Controller
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

    public function webhook_handler(Request $request)
    { 
        $message = 'v0:'.$request->header('x-zm-request-timestamp').':'.$request->getContent();
        $hash = hash_hmac('sha256', $message, 'Ylt3G0eVSsavTfA0DwVqEg');
        $signature = "v0={$hash}";
        $verified = hash_equals($request->header('x-zm-signature'), $signature);
        if($verified)
        {
            $event = json_decode($request->getContent(), true);
            $meeting_id = $event['payload']['object']['id'];
            $zoom_class = ZoomMeeting::where(['meeting_id'=>$meeting_id])->with('booking')->first();
            if($event['event'] == 'meeting.ended')
            {
                if($zoom_class)
                {
                    $end_class = strtotime($zoom_class->class_started) + 60*60;
                    if(strtotime(date('H:i')) <= $end_class)
                    {
                        $class_ended = date('H:i');
                    }
                    elseif(strtotime(date('H:i')) > $end_class)
                    {
                       $class_ended = strval(date('H:')).'00';
                    }
                     
                    ZoomMeeting::where(['meeting_id'=>$meeting_id])->update(['class_ended'=>$class_ended]);
                    $teacher_hourly_Pay = HourlyPay::where('user_id',$zoom_class->booking->teacher_booked)->first();
                    $class_duration = (strtotime($zoom_class->class_started) - strtotime($class_ended)) / 60;
    
                    if((int)$class_duration <= 0)
                    {
                        //teacher will not be paid
                        $status = 3;
                        $percentage = 0;
                        $amount = 0;
                    }
                    elseif((int)$class_duration >= 45)
                    {
                       //full payment
                       $status = 1;
                       $percentage = 100;
                       $amount = $teacher_hourly_Pay->amount;
    
                    }
                    elseif((int)$class_duration <= 20)
                    {
                          $status = 2;
                          $percentage = 25;
                          $amount = $percentage / 100 * ($teacher_hourly_Pay->amount);
                    }
                    elseif((int)$class_duration > 20 && (int)$class_duration <= 35)
                    { 
                      $status = 2;
                      $percentage = 50;
                      $amount = $percentage / 100 * ($teacher_hourly_Pay->amount);
    
                    }
    
                    elseif((int)$class_duration > 35 && (int)$class_duration <= 44)
                    { 
                        $status = 2;
                        $percentage = 75;
                        $amount = $percentage / 100 * ($teacher_hourly_Pay->amount);
    
                    }

                       $feedback = ClassFeedback::where('zoom_id',$zoom_class->id)->with('zoom_class')->first();
                       if(!$feedback)
                       {

                           ClassFeedback::create(['user_id'=>$zoom_class->booking->booked_by,
                                                    'zoom_id'=>$zoom_class->id,
                                                    'ended'=>date('H:i'),
                                                    'amount'=>$amount,
                                                    'percentage'=>$percentage,
                                                    'status'=>$status,
                                                    ]);

        
                       }
                      
                     if($zoom_class->pay == 0 && $zoom_class->attended == 1)
                     {
                        // pay teachers based on system 
                        $teacher_wallet = Wallet::where('user_id',$zoom_class->booking->teacher_booked)->first();
                        $new_balance = $teacher_wallet->balance + $amount;
                        Wallet::where('id',$teacher_wallet->id)->update(['balance'=>$new_balance]);
                        ZoomMeeting::where(['meeting_id'=>$zoom_class->meeting_id])->update(['pay'=>1]);
                     }
                    
                    // send mail to students for class feedback   
                    $data = ['mail'=>'events',
                             'meeting_id'=>$zoom_class->id,
                             'events'=>'ended',
                            ];
    
                    MailNofications::dispatchSync($data);

                    // ClassFeedback::whereDate('created_at', '<=', now()->subDays(15))->delete();   
                    return response()->json((int)$class_duration); 
                }

                
            }

            if($event['event'] == 'meeting.started')
            {
              if($zoom_class)
              {
                  $end_class = strtotime($zoom_class->class_started) + 60*60;
                  if($end_class <= strtotime(date('H:i')))
                   {
                       $zoom_meeting = new Zoom();
                       $data=['action'=>'end'];
                       $meet = $zoom_meeting->update_meeting($meeting_id,$data);
                       
                   }

              }

                return response()->json(strtotime(date('H:i')));
            }

            
            // // for endpoint url validation
            // $zoomData = json_decode($request->getContent(), true);
            // $zoomSecret = 'Ylt3G0eVSsavTfA0DwVqEg';
            // $zoomPlainToken = $zoomData['payload']['plainToken'];
            // $hash = hash_hmac('sha256', $zoomPlainToken, $zoomSecret);
            // $reponseData['plainToken'] = $zoomPlainToken;
            // $reponseData['encryptedToken'] = $hash;
            // return response()->json($reponseData);
            
        }
       
        
             

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
