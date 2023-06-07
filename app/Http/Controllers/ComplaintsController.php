<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PersonalInformation;
use App\Models\Complain;
use App\Models\HourlyPay;
use App\Models\BookingSchedule;
use App\Models\MyClass;
use App\Models\Wallet;
use Carbon\Carbon;
use App\Models\ZoomMeeting;
use App\Models\Refund;
class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $complains = Complain::where('status',0)->with('meeting')->get(); 
       return view('super-admin.complains.index',compact('complains'));
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

    public function complain_modal($id)
    {
        $class = ZoomMeeting::where(['id'=>$id])->with('booking')->first();
        return view('students.modals.complaints',compact('class'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = ['title'=>$request->title,
                'message'=>$request->message,
                'meeting_id'=>$request->id, 
               ];

       Complain::create($data);
       Booking::where('id',$request->id)->update(['completed'=>2]);
       MyClass::where('booking_id',$request->id)->update(['completed'=>2]);
       return back()->with('success','Complain logged sucessfullyy');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complain = Complain::where('id',$id)->with('meeting')->first();
        $teacher_info =  PersonalInformation::where('user_id',$complain->meeting->booking->teacher_booked)->with('user')->first(); 
        $student_info =  PersonalInformation::where('user_id',$complain->meeting->booking->booked_by)->with('user')->first();
        $hourly_pay = HourlyPay::where('user_id',$complain->meeting->booking->teacher_booked)->with('user')->first();
        // $duration =  Carbon::parse($complain->booking->hire_to)->diffInDays($complain->booking->hire_from);
        // $booking_schedules = BookingSchedule::where('booking_id',$complain->booking_id)->get();
        return view('super-admin.complains.show',compact('complain','teacher_info','student_info','hourly_pay'));
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
        $complain = Complain::where('id',$id)->with('meeting')->first();
        $booking = Booking::where('id',$complain->meeting->booking_id)->with('teacher','who_booked')->first();

        if($request->has('cancel_btn'))
        {
            Complain::where('id',$id)->update(['status'=>1]); 
            return back()->with('success','Reviewed!');
        }
        elseif($request->has('refund_btn'))
        {
            $teachers_wallet = Wallet::where('user_id',$booking->teacher_booked)->with('user')->first();
            $student_wallet = Wallet::where('user_id',$booking->booked_by)->with('user')->first();
            $teachers_pay = HourlyPay::where('user_id',$booking->teacher_booked)->with('user')->first();
            // dd($teachers_pay, $teachers_wallet);
            $teachers_new_balance = $teachers_wallet->balance - $teachers_pay->amount;
            $student_new_balance = $student_wallet->balance + $teachers_pay->amount;
            //  dd($teachers_new_balance,$student_new_balance);
            Wallet::where('user_id',$booking->booked_by)->update(['balance'=>$student_new_balance]);
            Wallet::where('user_id',$booking->teacher_booked)->update(['balance'=>$teachers_new_balance]);

            Booking::where('id',$booking->id)->update(['completed'=>3]);
            MyClass::where('booking_id',$booking->id)->update(['completed'=>3]);
            Complain::where('id',$id)->update(['status'=>1]); 

            Refund::create([
                             'teacher_booked'=>$booking->teacher_booked,
                             'booked_by'=>$booking->booked_by,
                             'meeting_id'=>$complain->meeting_id,
                             'amount'=>$teachers_pay->amount,
                           ]);

            return back()->with('success','Refund was successfull!');

        }
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
