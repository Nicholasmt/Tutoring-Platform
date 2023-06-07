<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\PersonalInformation;
use App\Models\Booking;
use App\Models\Wallet;
use App\Models\Activity;
use App\Models\MyClass;
use App\Models\Notification;
use Carbon\Carbon;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Models\ZoomMeeting;
use App\Models\Refund;
use App\Models\LogTransaction;
use DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');
        $today = today()->format('Y-m-d');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $bookings = Booking::where(['booked_by'=>$id,'accepted'=>1])
                             ->whereDate('created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->latest()->paginate(4); 
        $my_wallet = Wallet::where('user_id',$id)->first();
        $recent_activities = Activity::where(['user_id'=>$id])
                                      ->whereDate('created_at', '>=', now()->subDays(3))
                                      ->latest()->get();
        $on_going_classes = Booking::where(['booked_by'=>$id,'accepted'=>1])->whereDate('date', '=' ,now())
                                    ->with('teacher','who_booked')->get();
        $attended_classes = ZoomMeeting::whereDate('start_time', '=',now())->with('booking')->get();
        $recent_booked = Booking::where(['booked_by'=>$id,'accepted'=>1])
                                  ->whereDate('created_at', '>=', now()->subDays(3))
                                  ->with('teacher','who_booked')->get();
        $upcoming_class = Booking::where(['booked_by'=>$id,'accepted'=>1])
                                   ->whereDate('date','>=',now())
                                   ->latest()->with('teacher','who_booked')->get();
     
        $booking_requests = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>0,'seen'=>0])
                                     ->with('teacher','who_booked')->get();
        $approved = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>1])
                            // ->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->whereDate('created_at', '>=', now()->subDays(3))
                            ->with('teacher','who_booked')->get();
    
        $rejected = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>2])
                            ->whereDate( 'created_at', '>=', now()->subDays(3))
                            ->with('teacher','who_booked',)->get();
        $refunds = Refund::where('booked_by',$id)
                          ->whereDate('created_at', '>=', now()->subDays(3))
                          ->with('meeting')->get();

        
     
        // $class_duration = (strtotime('23:07:00') - strtotime('23:11:00')) / 60;
        // dd((int)$class_duration);

        // delete all declined bookings after 3 days
        Booking::where(['accepted'=>2])->whereDate('created_at', '<=', now()->subDays(3))->delete();
        // delete all logged transactions after 3 days
        LogTransaction::whereDate('created_at', '<=', now()->subDays(15))->delete();
       return view('students.dashboard',compact('refunds','attended_classes','approved','booking_requests','rejected','personal_infos','upcoming_class','recent_booked','on_going_classes','bookings','my_wallet','recent_activities'));
        
        
    }


    public function pay_modal($id)
    {
         $booking = Booking::where('id',$id)->with('teacher','who_booked')->first();
         $wallet = Wallet::where('user_id',$booking->booked_by)->first();
         return view('students.modals.make-payment',compact('wallet','booking'))->render();
    }
    public function decline_modal($id)
    {
         $booking = Booking::where('id',$id)->with('teacher','who_booked')->first();
         return view('students.modals.decline',compact('booking'))->render();
    }

  
   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $id = session()->get('id');
        $booking_requests = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>0,'seen'=>0])
                                     ->with('teacher','who_booked')->get();
        $approved = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>1])
                             ->whereDate( 'created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->get();
        $rejected = Booking::where(['booked_by'=>$id,'completed'=>0,'accepted'=>2])
                             ->whereDate( 'created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->get();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        return view('students.settings.create',compact('rejected','personal_infos','booking_requests','approved',));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=['email'=>'required|unique:users',
                'password'=>'required',
                'last_name'=>'required',
                'first_name'=>'required'
               ];
        $validator = \Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            DB::beginTransaction();
            try{
                    $data=['email'=>$request->email,
                            'first_name'=>$request->first_name,
                            'last_name'=>$request->last_name,
                            'role_id'=>3,
                            'password'=>\Hash::make($request->password)
                        ];
                    $student = Users::create($data);
                    PersonalInformation::create(['user_id'=>$student->id]);
                    Wallet::create(['user_id'=>$student->id]);
                    Notification::create(['user_id'=>$student->id]);

                    $request->session()->put('id',$student->id);
                    $request->session()->put('email',$student->email);
                    $request->session()->put('first_name',$student->first_name);
                    $request->session()->put('last_name',$student->last_name);
                    $request->session()->put('privilege',$student->role_id);
                    $request->session()->put('authentication',true);
                    DB::commit();
                    
                    if($student->email_verify == 0)
                    {
                        return redirect('send-mail')->with('success','Email Sent');
                    }
                    else
                    {
                         return redirect('redirect');
                    }
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
        $ids = session()->get('id');
        $personal = PersonalInformation::where('user_id',$ids)->with('user')->first();
        $tab_name = $request->tab_name;

        if($request->has('personal_btn_update'))
        {
            if($request->has('profile_photo'))
            {
                $rules=['profile_photo'=>'required|mimes:jpg,png,jpeg|max:5000',
                       ];
                $custom_message=['profile_photo.max'=>'photo size must not be greather than 5mb'];

                $validator = \Validator::make($request->all(),$rules,$custom_message);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors());
                }
                else
                {
                     //profile photo upload
                    $rad= substr(rand(0,time()),0,8);
                    // dd(Storage::exists($personal->profile_photo));
                    if(file_exists($personal->profile_photo))
                    {
                        unlink($personal->profile_photo);
                    }
                    $path1 = storage_path('imgs/profile');
                    $photo = $request->file('profile_photo');
                    $extension1 = $photo->getClientOriginalExtension();
                    $photo_name =  $rad. '.' . $extension1; 
                    $imagePath = $photo->move($path1, $photo_name);
                    $data['profile_photo'] = 'storage/imgs/profile/'.$photo_name;

                    PersonalInformation::where('user_id',$ids)
                                        ->update(['profile_photo'=> $data['profile_photo'],]);

                    $personal_update = PersonalInformation::where('user_id',$ids)->with('user')->first();

                    $request->session()->put('photo',$personal_update->profile_photo);
                }
            }
                Users::where('id',$ids)->update(['first_name'=>$request->first_name,
                                                  'last_name'=>$request->last_name,
                                                ]);

                $users_update = Users::where('id',$ids)->with('role')->first();
                $request->session()->put('first_name',$users_update->first_name);

               PersonalInformation::where('user_id',$ids)
                                    ->update(['address'=>$request->address,
                                              'town'=>$request->town,
                                             'state'=>$request->state,
                                             'country'=>$request->country,
                                             'phone'=>$request->phone,
                                             ]);

             return back()->with('success','personal information updated')->with('tab_name', $tab_name);
            // return redirect()->route('parents-dashboard')->with('message_code', 2);
        }
        
        if($request->has('personal_btn_new'))
        {
            $rules=['profile_photo'=>'required|mimes:jpg,png,jpeg|max:5000',
                     'country'=>'required',
                     'phone'=>'required',
                     'address'=>'required',
                     'town'=>'required',
                     'state'=>'required',
                    ];
                $custom_message=['profile_photo.max'=>'photo size must not be greather than 5mb'];

                $validator = \Validator::make($request->all(),$rules,$custom_message);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors())->with('tab_name', $tab_name);
                }
                else
                {
                    //profile photo upload
                    $rad= substr(rand(0,time()),0,8);
                    $path1 = storage_path('imgs/profile');
                    $photo = $request->file('profile_photo');
                    $extension1 = $photo->getClientOriginalExtension();
                    $photo_name =  $rad. '.' . $extension1; 
                    $imagePath = $photo->move($path1, $photo_name);
                    $data['profile_photo'] = 'storage/imgs/profile/'.$photo_name;

                    Users::where('id',$ids)
                            ->update(['first_name'=> $request->first_name,
                                      'last_name'=>$request->last_name,
                                      'is_verified'=>1,
                                     ]);

                   $user_update = Users::where('id',$ids)->with('role')->first();
                   $request->session()->put('first_name',$user_update->first_name);
                   PersonalInformation::where('user_id',$ids)->update(['address'=>$request->address,
                                                                    'town'=>$request->town,
                                                                    'state'=>$request->state,
                                                                    'country'=>$request->country,
                                                                    'phone'=>$request->phone,
                                                                    'profile_photo'=> $data['profile_photo'],
                                                                ]);

                    $update_info = PersonalInformation::where('user_id',$ids)->with('user')->first();

                    $request->session()->put('photo',$update_info->profile_photo);

                    return redirect()->route('parents-dashboard')->with('message_code', 2);

                }
        }

        if($request->has('password_btn'))
        {
            $rules=['current_password'=>'required',
                    'new_password'=>'required',
                    'confirm_password'=>'required|same:new_password',
                   ];

                $validator = \Validator::make($request->all(),$rules);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors())->with('tab_name', $tab_name);
                }
                else
                {
                  $user=Users::where('id',$ids)->with('role')->first();
                  if(\Hash::check($request->current_password,$user->password))
                  {
                    if(\Hash::check($request->confirm_password,$user->password))
                    {
                        return back()->with('error','New password cannot be same with old password')->with('tab_name', $tab_name);
                    }
                     Users::where('id',$ids)->update(['password'=>\Hash::make($request->confirm_password)]);
                     return back()->with('success','password updated')->with('tab_name', $tab_name);
                  }
                  else
                  {
                    // Users::where('id',$ids)->update(['password'=>\Hash::make($request->confirm_password)]);
                    return back()->with('error','Current password mismatch')->with('tab_name', $tab_name);
                  }
                }
        }

        if($request->has('notification_btn'))
        {  
              Notification::where('user_id',$ids)->update(['messages'=>$request->message,
                                                             'activities'=>$request->activities,
                                                             'offers'=>$request->offers,
                                                             'everything'=>$request->everything,
                                                             'send_as_email'=>$request->send_as_email,
                                                             'no_push'=>$request->no_push
                                                            ]);
         
            return back()->with('success','Notification Updated')->with('tab_name',$tab_name);
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
