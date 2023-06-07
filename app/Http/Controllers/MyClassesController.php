<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\MyClass;
use App\Models\BookingSchedule;
use App\Models\Booking;
use Carbon\Carbon;
// use App\Http\Library\Zoom;
use Nicholasmt\ZoomLibrary\Zoom;
use App\Models\ZoomMeeting;
use App\Models\Users;
use App\Models\Wallet;
use App\Models\Rating;
use App\Models\Activity;
use App\Models\ProfileView;
use App\Jobs\MailNofications;
use Cookie;
use Illuminate\Support\Facades\Session;

class MyClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->first();
        if($user->is_verified == 1)
        {
            $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
            $myclasses = MyClass::where(['teacher_id'=>$id])->with('booking')->get();
            $completed = MyClass::where(['teacher_id'=>$id,'completed'=>1])->with('booking')->get();
            $requests = MyClass::where(['teacher_id'=>$id])->with('booking')->get();
            $in_progress = MyClass::where(['teacher_id'=>$id])
                                   ->whereDate('date', '>=' ,today())
                                   ->with('booking')->get();
            $booking_requests = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>0])
                                         ->with('booking')->get();
            $approved = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>1])
                                 ->whereDate('created_at', '>=', now()->subDays(3))
                                 ->with('booking')->get();
            return view('teachers.myclasses.index',compact('approved','booking_requests','requests','personal_infos','in_progress','completed','myclasses'));
       }
       else
       {
          return back();
       }
    }

    public function load_details($id)
    {
        $class = MyClass::where('id',$id)->with('booking')->first();
        $users_info = PersonalInformation::where('user_id',$class->booking->who_booked->id)->with('user')->first();
        return view('teachers.myclasses.load-details',compact('users_info','class'));
         
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

    public function create_class($id, $time)
    {
        
        $booking = Booking::where('id',$id)->with('who_booked','teacher')->first();
        $ZoomSessionTitle = 'Class Session With '.$booking->who_booked->first_name.' '.$booking->who_booked->last_name;
        $ZoomStartTime = date("Y-m-d H:i:s", strtotime($time));

        if(strtotime(date('H:i:s')) < strtotime($time))
        {
           $current_time = strtotime($time); 
        }
        elseif(strtotime(date('H:i:s')) >= strtotime($time))
        {
           $current_time = strtotime(date('H:i:s')); 
        }
       
        $end_time = strtotime($time) + 60*60; 
        $mins = ($end_time - $current_time) / 60;
        if((int)$mins < 0)
        {
           $ZoomSessionDuration= 0;
        }
        else
        {
           $ZoomSessionDuration = (int)$mins;
        }
 
        $check_class = ZoomMeeting::where('start_time', '=', $ZoomStartTime)->with('booking')->first();

      if(empty($check_class))
      {
            $zoom_meeting = new Zoom();
    
            $data = array();
            $data['topic'] 		= $ZoomSessionTitle;
            $data['start_date'] = $ZoomStartTime;
            $data['duration'] 	= $ZoomSessionDuration;
            $data['type'] 		= 2;
            $data['password'] 	= substr(rand(0,time()),0,6);
        
            try {
                $response = $zoom_meeting->createMeeting($data);
                // dd($response);
                $title = $response->topic;
                $status = $response->status;
                $meeting = ZoomMeeting::create([
                                                'meeting_id'=>$response->id,
                                                'booking_id'=>$booking->id,
                                                'password'=>$response->password,
                                                'start_url'=>$response->start_url,
                                                'join_url'=>$response->join_url,
                                                'duration'=>$response->duration,
                                                'start_time'=>$time,
                                                'class_started'=>date('H:i',$current_time),
                                              ]);
                
                                        
            } catch (Exception $ex) {
    
                return back()->with('error',$response->message, $ex->getMessage());
            }
    
            
            //send mail
            $data = ['mail'=>'events',
                     'meeting_id'=>$meeting->id,
                     'events'=>'started',
                    ];

            MailNofications::dispatchSync($data);
            
            return \Redirect::to($meeting->start_url);

      }
      else
      {
        return back()->with('success','Class has already been created click to start.');
      }
     

    }

    public function join_class($id)
    {
        
        $meeting = ZoomMeeting::where('id',$id)->with('booking')->first();
        ZoomMeeting::where('id',$id)->update(['attended'=>1]);
        return redirect()->away($meeting->join_url);
        
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
