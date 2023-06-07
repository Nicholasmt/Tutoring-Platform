<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Users;
use App\Models\Booking;
use Carbon\Carbon;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');

        if(session()->get('privilege') == 2)
        {
           $user = Users::where('id',$id)->with('role')->first();

            if($user->is_verified == 1)
            {
                $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
                $my_wallet = Wallet::where('user_id',$id)->with('user')->first();
                $transctions = Transaction::where('teacher',$id)->latest()->paginate(10);
                $booking_requests = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>0])
                                            ->with('teacher','who_booked')->get();
                $approved = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>1])
                                    ->whereDate('created_at', '>=', now()->subDays(3))
                                    ->with('teacher','who_booked')->get();
                return view('teachers.wallet.index',compact('my_wallet','personal_infos','transctions','approved','booking_requests'));
            }
            else
            {
                return back();
            }

        }
        elseif(session()->get('privilege') == 3)
        {
            $user = Users::with('role')->find("$id");
            $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
            $my_wallet = Wallet::where('user_id',$id)->first();
            $transctions = Transaction::where('student',$id)->latest()->paginate(10);
            $booking_requests = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>0,'seen'=>0])
                                         ->with('teacher','who_booked')->get();
            $approved = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>1])
                                 ->whereDate('created_at', '>=', now()->subDays(3))
                                 ->with('teacher','who_booked')->get();
            $rejected = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>2])
                                 ->whereDate('created_at', '>=', now()->subDays(3))
                                 ->with('teacher','who_booked')->get(); 
 
       
            return view('students.wallet.index',compact('rejected','my_wallet','user','personal_infos','transctions','approved','booking_requests'));

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
