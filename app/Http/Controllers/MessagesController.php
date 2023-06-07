<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\Message;
use App\Models\Booking;
use App\Models\BookingSchedule;
use Carbon\Carbon;

class MessagesController extends Controller
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
        $messages = Booking::where(['booked_by'=>$id,'completed'=>0])->with('teacher','who_booked')->get();
        return view('students.messages.index',compact('personal_infos','messages'));
    }
    public function booking_details($id)
    {
        $booking_details = Booking::where('id',$id)->with('teacher','who_booked')->first(); 
        return view('students.messages.view-details',compact('booking_details'))->render();
    }


    public function load_message($id)
    {
        $message = Booking::where('id',$id)->with('teacher','who_booked')->first(); 
        $users_info = PersonalInformation::where('user_id',$message->teacher_booked)->with('user')->first();
        return view('students.messages.load-message',compact('message','users_info'))->render();
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
