<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use App\Models\Users;
use App\Models\Complain;
use App\Models\ZoomMeeting;


class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $students = Users::where(['is_verified'=>1,'role_id'=>3])->with('role')->get();
        $teachers = Users::where(['is_verified'=>1,'role_id'=>2])->with('role')->get();
        $pending_verifiactions = Users::where(['verify_ready'=>1, 'role_id' =>2])->with('role')->get();
        $pending_complains = Complain::where('status',0)->with('meeting')->get();
        $todays_classes = ZoomMeeting::where(['date_time'=>date('Y:m:d')])->with('booking')->paginate(15);
        // $todays_classes = ZoomMeeting::paginate(5);
        return view('super-admin.dashboard',compact('todays_classes','students','teachers','pending_complains','pending_verifiactions'));
    }
    public function index()
    {
       return view('auths.super-admin.login');
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

    public function classRecords()
    {
         $classes = ZoomMeeting::with('booking')->all();
         return view('super-admin.Records.class',compact('classes'));
    }

    public function supervise_class($id)
    {
        $meeting = ZoomMeeting::where('meeting_id',$id)->with('booking')->first();
        ZoomMeeting::where('id',$meeting->id)->update(['supervised'=>1]);
        return \Redirect::to($meeting->join_url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=['email'=>'required',
                'password'=>'required'
              ];
            $validator = \Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return back()->withErrors($validator->errors());
            }
            else
            {
                $user = SuperAdmin::where('email',$request->email)->first();
                if($user)
                {
                    if(\Hash::check($request->password,$user->password))
                    {
                    
                    $request->session()->put('id',$user->id);
                    $request->session()->put('email',$user->email);
                    $request->session()->put('first_name',$user->first_name);
                    $request->session()->put('privilege',$user->role_id);
                    $request->session()->put('authentication',true);
                     return redirect('redirect');
                    }
                    else
                    {
                        return back()->with('error','Email and Password Mismatch');
                    }
                }
                else
                {
                    return back()->with('error','Account does not Exist!');
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
        $admin = SuperAdmin::where('id',$id)->first();
        return view('super-admin.settings.show',compact('admin'));
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
         if($request->has('personal_btn'))
         {
            $rules=['email'=>'required'];
            $validator = \Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return back()->withErrors($validator->errors());
            }
            else
            {
                SuperAdmin::where('id',$id)->update(['first_name'=>$request->first_name,
                                                    'last_name'=>$request->last_name,
                                                    'email'=>$request->email,
                                                ]);

                   return back()->with('success','personal information updated');

            }
          }
         
         elseif($request->has('password_btn'))
         {
            
                $rules=['current_password'=>'required',
                        'new_password'=>'required',
                        'confirm_password'=>'required|same:new_password',
                       ];
    
                    $validator = \Validator::make($request->all(),$rules);
                    if($validator->fails())
                    {
                        return back()->withErrors($validator->errors());
                    }
                    else
                    {
                      $user=Users::where('id',$user_id)->with('role')->first();
                      if(\Hash::check($request->current_password,$user->password))
                      {
                        if(\Hash::check($request->confirm_password,$user->password))
                        {
                            return back()->with('error','New password cannot be same with old password');
                        }
                        
                         Users::where('id',$user_id)->update(['password'=>$request->confirm_password]);
                         return back()->with('success','password updated');
                      }
                      else
                      {
                        return back()->with('error','Current password mismatch');
                      }
                    }
            
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
