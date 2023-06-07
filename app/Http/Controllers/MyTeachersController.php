<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\ProfessionalInformation;
use App\Models\HourlyPay;
use App\Models\Booking;
use App\Models\Education;
use App\Models\BookingSchedule;
use Carbon\Carbon;
use App\Models\RatedClass;
use App\Models\Rating;

class MyTeachersController extends Controller
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
        $my_teachers = Booking::where(['booked_by'=>$id,'accepted'=>1])->with('teacher','who_booked')->paginate(9);
        $in_progress = Booking::where(['booked_by'=>$id,'accepted'=>1])
                               ->whereDate('date', '=' ,now())
                               ->with('teacher','who_booked')->paginate(9);
        $completed = Booking::where(['booked_by'=>$id,'completed'=>1,'accepted'=>1])->with('teacher','who_booked')->paginate(9);
        $teachers = Booking::where(['booked_by'=>$id,'accepted'=>1])->with('teacher','who_booked')->paginate(9);
        $requests = Booking::where(['booked_by'=>$id,'accepted'=>1])->with('teacher','who_booked')->paginate(9);
        $booking_requests = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>0,'seen'=>0])->with('teacher','who_booked')->get();
        $approved = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>1])
                            ->whereDate( 'created_at', '>=', now()->subDays(3))
                            ->with('teacher','who_booked')->get();
        $rejected = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>2])
                             ->whereDate( 'created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->get();
        return view('students.my_tutors.index',compact('rejected','completed','in_progress','personal_infos','my_teachers','teachers','requests','approved','booking_requests'));
        
    }


    public function loader($id)
    {
        $details = Booking::where(['id'=>$id])->with('teacher','who_booked')->first();
        $users_info = PersonalInformation::where('user_id',$details->teacher_booked)->with('user')->first();
        $hourly_pay = HourlyPay::where('user_id',$details->teacher_booked)->with('user')->first();
        $pro_info = ProfessionalInformation::where('user_id',$details->teacher_booked)->with('user')->first();
        $educations = Education::where('user_id',$details->teacher_booked)->with('user')->get();
        $rated = RatedClass::where(['booking_id'=>$details->id])->first();
        $rating = Rating::where(['user_id'=>$details->teacher_booked])->first();
        return view('students.my_tutors.load-teacher',compact('details','rating','rated','pro_info','users_info','hourly_pay','educations'));
    }

    public function load_request($id)
    {
        $booked_by = session()->get('id');
        $teachers = Booking::where(['booked_by'=>$booked_by,'teacher_booked'=>$id])->with('teacher','who_booked')->get();
        return view('students.my_tutors.load-request',compact('teachers'));
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
