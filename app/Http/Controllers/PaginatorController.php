<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\ProfessionalInformation;
use App\Models\HourlyPay;
use App\Models\Booking;
use App\Models\Wallet;
use App\Models\Payment;

class PaginatorController extends Controller
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
    public function requests(Request $request)
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $my_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1])->with('teacher','who_booked')->paginate(9);
        $current_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1,'completed'=>0])->with('teacher','who_booked')->paginate(9);
        $requests = Booking::where(['booked_by'=>$id])->with('teacher','who_booked')->paginate(9);
        return view('students.my_tutors.paginate.requests',compact('personal_infos','my_teachers','current_teachers','requests'))->render();
    }

    public function my_teachers(Request $request)
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $my_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1])->with('teacher','who_booked')->paginate(9);
        $current_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1,'completed'=>0])->with('teacher','who_booked')->paginate(9);
        $requests = Booking::where(['booked_by'=>$id])->with('teacher','who_booked')->paginate(9);
        return view('students.my_tutors.paginate.my-teachers',compact('personal_infos','my_teachers','current_teachers','requests'))->render();
    }

    public function my_teachers_grid(Request $request)
    {
        
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $my_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1])->with('teacher','who_booked')->paginate(9);
        $current_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1,'completed'=>0])->with('teacher','who_booked')->paginate(9);
        $requests = Booking::where(['booked_by'=>$id])->with('teacher','who_booked')->paginate(9);
        return view('students.my_tutors.paginate.my-teacher-grid',compact('personal_infos','my_teachers','current_teachers','requests'))->render();
    }

    public function current_teachers(Request $request)
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('teacher','who_booked')->first();
        $my_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1])->with('teacher','who_booked')->paginate(9);
        $current_teachers = Booking::where(['booked_by'=>$id,'status'=>1,'paid'=>1,'completed'=>0])->with('teacher','who_booked')->paginate(9);
        $requests = Booking::where(['booked_by'=>$id])->with('teacher','who_booked')->paginate(9);
        return view('students.my_tutors.paginate.current-teacher',compact('personal_infos','my_teachers','current_teachers','requests'))->render();
    }

    public function transactions()
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $my_wallet = Wallet::where('user_id',$id)->first();
        $transctions = Transaction::where('student',$id)->paginate(10);
        if(session()->get('privilege') == 3)
        {
            return view('students.wallet.paginate.transaction',compact('personal_infos','my_wallet','transctions'))->render();
        }
        elseif(session()->get('privilege') == 3)
        {
            return view('teachers.wallet.paginate.transactions',compact('personal_infos','my_wallet','transctions'))->render();
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
