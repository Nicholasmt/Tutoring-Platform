<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\Booking;
use App\models\MyClass;
use App\models\Activity;
use DB;


class TeachersMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $messages = Booking::where(['teacher_booked'=>$id,'completed'=>0])->with('teacher','who_booked')->get();
        return view('teachers.messages.index',compact('personal_infos','messages'));
    }

    public function load_message($id)
    {
        $message = Booking::where('id',$id)->with('teacher','who_booked')->first(); 
        $users_info = PersonalInformation::where('user_id',$message->booked_by)->with('user')->first();
       return view('teachers.messages.load-message',compact('message','users_info'))->render();
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
        if($request->has('decline_btn'))
        {
           Booking::where('id',$request->booking_id)->update(['status'=>2]);
           return back()->with('success','Booking has been Declined');

        }
        if($request->has('accept_btn'))
        {
            DB::beginTransaction();
            try{
                    Booking::where('id',$request->booking_id)->update(['status'=>1]);
                    $booking = Booking::where('id',$request->booking_id)->with('teacher','who_booked')->first();
                    MyClass::create(['booking_id'=>$booking->id,
                                    'teacher_id'=>$booking->teacher_booked,
                                ]);
                    Activity::create(['type'=>'booking accpted',
                                     'type_id'=>$booking->id,
                                     'user_id'=>$booking->teacher_booked,
                                    ]);
                    DB::commit();
                    return back()->with('success','Booking has been accepted');
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
