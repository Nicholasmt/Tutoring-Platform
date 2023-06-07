<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Cerification;
use App\Models\Education;
use App\Models\Subjects;
use App\Models\ProfessionalInformation;
use App\Models\PersonalInformation;
use App\Models\Schedule;
use App\Models\HourlyPay;

class VerificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::where(['verify_ready'=>1, 'role_id' =>2,'is_verified'=>0])->with('role')->get();
        return view('super-admin.verify-accounts.index',compact('users'));
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
        // dd($request->id);
        // accept account
        if($request->has('personal_info_btn'))
        {
            PersonalInformation::where('id',$request->id)->update(['is_verified'=>1,'comments'=>null]);
            return back()->with('success','personal information has been verified')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('pro_info_btn'))
        {
            ProfessionalInformation::where('id',$request->id)->update(['is_verified'=>1,'comments'=>null]);
            return back()->with('success','professional information has been verified')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('education_btn'))
        {
            Education::where('id',$request->id)->update(['is_verified'=>1,'comments'=>null]);
            return back()->with('success','Education Qualification information has been verified')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('certification_btn'))
        {
            Cerification::where('id',$request->id)->update(['is_verified'=>1,'comments'=>null]);
            return back()->with('success','Cerification information has been verified')->with('tab_name',$request->tab_name);
        }

        // decline account
        elseif($request->has('decline_personal_btn'))
        {
            PersonalInformation::where('id',$request->id)->update(['is_verified'=>2,'comments'=>$request->comment]);
            return back()->with('error','personal information has been Declined')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('decline_pro_btn'))
        {
            ProfessionalInformation::where('id',$request->id)->update(['is_verified'=>2,'comments'=>$request->comment]);
            return back()->with('error','professiomal information has been Declined')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('decline_education_btn'))
        {
            Education::where('id',$request->id)->update(['is_verified'=>2,'comments'=>$request->comment]);
            return back()->with('error','education information has been Declined')->with('tab_name',$request->tab_name);
        }
        elseif($request->has('decline_certification_btn'))
        {
            Cerification::where('id',$request->id)->update(['is_verified'=>2,'comments'=>$request->comment]);
            return back()->with('error','cerification information has been Declined')->with('tab_name',$request->tab_name);
        }

        //verify account
        elseif($request->has('verify_btn'))
        {
           Users::where('id',$request->id)->update(['verify_ready'=>2,'is_verified'=>1]);
           Subjects::where('user_id',$request->id)->update(['is_verified'=>1]);
           Cerification::where('user_id',$request->id)->update(['is_verified'=>1]);
           PersonalInformation::where('user_id',$request->id)->update(['is_verified'=>1]);
           ProfessionalInformation::where('user_id',$request->id)->update(['is_verified'=>1]);
           Education::where('user_id',$request->id)->update(['is_verified'=>1]);
           HourlyPay::where('user_id',$request->id)->update(['is_verified'=>1]);
           Schedule::where(['user_id'=> $request->id])->update(['is_verified'=>1]);
           
           return redirect()->route('adminverifications.index')->with('success','Account has been verified');
        }
        elseif($request->has('reject_btn'))
        {
            Users::where('id',$request->id)->update(['verify_ready'=>2,'is_verified'=>2]);
            return redirect()->route('adminverifications.index')->with('error','Account has been Rejected');
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
        $user = Users::where('id',$id)->with('uroleer')->first();
        $certifications = Cerification::where('user_id',$id)->with('user')->get();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $educations = Education::where('user_id',$id)->with('user')->get();
        return view('super-admin.verify-accounts.show',compact('user', 'certifications','pro_infos','personal_infos','educations'));
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

    public function confirm_decline(Request $request)
    {
       $array = explode(',', $request->value);
       //dd($array[1]);
       $btn = $array[1];
       $teacher_id = $array[0];
       return view('super-admin.verify-accounts.decline',compact('teacher_id','btn'))->render();

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
