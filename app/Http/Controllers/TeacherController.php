<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Cerification;
use App\Models\Education;
use App\Models\ProfessionalInformation;
use App\Models\PersonalInformation;
use App\Models\Schedule;
use App\Models\HourlyPay;
use App\Models\Subjects;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Wallet;
use App\Models\MyClass;
use App\Models\Activity;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\ProfileView;
use App\Models\Notification;
use App\Models\ZoomMeeting;
use App\Models\Refund;
use App\Models\LogTransaction;
use DB;
use Cookie;

class TeacherController extends Controller
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
        $user = Users::where('id',$id)->with('role')->first();
        $my_wallet = Wallet::where('user_id',$id)->first();
        $my_rating = Rating::where('user_id',$id)->first();
        $total_student = MyClass::where('teacher_id',$id)->with('booking')->get();
        $recent_activities = Activity::where(['user_id'=>$id])
                                       ->whereDate('created_at', '>=', now()->subDays(3))
                                       ->latest()->get();

        $accepted_bookings = MyClass::where('teacher_id',$id)
                                     ->whereDate('created_at', '>=', now()->subDays(3))->latest()
                                     ->with('booking')->get();

        $on_going_classes = Booking::where(['teacher_booked'=>$id,'accepted'=>1])
                                    ->whereDate('date','=', today())
                                    ->with('teacher','who_booked')->get();
        $booking_requests = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>0])
                                    ->with('teacher','who_booked')->get();
        $approved = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>1])
                             ->whereDate('created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->get();
         $completed_classes = ZoomMeeting::whereDate('start_time', '=',now())->with('booking')->get();
         // delete all declined bookings after one week
         Booking::where(['accepted'=>2])->whereDate( 'created_at', '<=', now()->subDays(3))->delete();
         // delete all logged transactions after 3 days
         LogTransaction::whereDate('created_at', '<=', now()->subDays(10))->delete();
         //profile view counter
          $users = ProfileView::where('teacher_id',$id)->select('id','created_at')->get()->groupBy(function($users){
             return Carbon::parse($users->created_at)->format('M');
         });
         $refunds = Refund::where('teacher_booked',$id)
                          ->whereDate('created_at', '>=', now()->subDays(3))
                          ->with('meeting')->get();
        $labels = [];
        $data = [];
        foreach ($users->chunk(100) as $groups)
        {
            foreach ($groups as $month => $values)
            {
                $labels[] = $month;
                $data[] = count($values);
            }
         }
        
        return view('teachers.dashboard',compact('accepted_bookings','refunds','on_going_classes','approved','booking_requests','labels','data','personal_infos','completed_classes','user','my_rating','my_wallet','total_student','recent_activities'));
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
    


    public function profile_setting()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $booking_requests = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>0])
                                    ->with('teacher','who_booked')->get();
        $approved = Booking::where(['teacher_booked'=>$id,'completed'=>0,'accepted'=>1])
                             ->whereDate('created_at', '>=', now()->subDays(3))
                             ->with('teacher','who_booked')->get();

        if($user->verify_ready == 0)
        {
            return redirect()->route('teachers-step-wizard');
        }
        elseif($user->is_verified == 1)
        {
            return view('teachers.settings.edit',compact('personal_infos','approved','booking_requests'));
        }
        elseif($user->verify_ready == 1)
        {
            return back();
        }
        
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
        $user_id = session()->get('id');
        $personal = PersonalInformation::where('user_id',$user_id)->with('user')->first();
        $professional = ProfessionalInformation::where('user_id',$user_id)->with('user')->first();
        $rad= substr(rand(0,time()),0,8);
        $tab_name = $request->tab_name;
        // dd($tab_name);
        if($request->has('personal_btn'))
        {
            if($request->has('profile_photo'))
            {
                $rules=['profile_photo'=>'required|mimes:jpg,png,jpeg|max:5000',
                       ];
                $custom_message=['profile_photo.max'=>'photo size must not be greather than 5mb'];

                $validator = \Validator::make($request->all(),$rules,$custom_message);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors())->with('tab_name',$tab_name);
                }
                else
                {

                    //profile photo upload
                    $rad= substr(rand(0,time()),0,8);
                    if(file_exists($personal->profile_photo))
                    {
                        unlink($personal->profile_photo);
                    }
                    // unlink($personal->profile_photo);
                    $path1 = storage_path('imgs/profile');
                    $photo = $request->file('profile_photo');
                    $extension1 = $photo->getClientOriginalExtension();
                    $photo_name =  $rad. '.' . $extension1; 
                    $imagePath = $photo->move($path1, $photo_name);
                    $data['profile_photo'] = 'storage/imgs/profile/'.$photo_name;

                    PersonalInformation::where('user_id',$user_id)
                                        ->update(['profile_photo'=> $data['profile_photo'],]);

                    $users_info = PersonalInformation::where('user_id',$user_id)->with('user')->first();                  
                    $request->session()->put('photo',$users_info->profile_photo);
                }
            }
                Users::where('id',$user_id)->update(['first_name'=>$request->first_name,
                                                     'last_name'=>$request->last_name,
                                                    ]);

                $users = Users::where('id',$user_id)->with('role')->first();
                $request->session()->put('first_name',$users->first_name);   
                PersonalInformation::where('user_id',$user_id)
                                    ->update(['address'=>$request->address,
                                              'town'=>$request->town,
                                             'state'=>$request->state,
                                             'country'=>$request->country,
                                             'phone'=>$request->phone,
                                             ]);

               

                 return redirect()->back()->with('success','personal information updated')->with('tab_name',$tab_name);
                // return redirect()->route('teachers-profile-setting',compact('tab_name'))->with('success','personal information updated');
                
        }
        if($request->has('professional_btn'))
        {
           
            if($request->has('onboading_video'))
           {
                $rules=['onboading_video'=>'required|mimes:mp4,oga,x-flv,webm,ogv,quicktime,mkv|max:10000',
                       ];
                 $custom_message=['onboading_video.max'=>'video size must not be greather than 10mb'];

                $validator = \Validator::make($request->all(),$rules,$custom_message);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors());
                }
                else
                {
                     
                    unlink($professional->onboading_video);
                    //video upload
                    $path5 = storage_path('videos');
                    $video = $request->file('onboading_video');
                    $extension5 = $video->getClientOriginalExtension(); 
                    $video_name =  $rad. '.' . $extension5; 
                    $filePath2 = $video->move($path5, $video_name);
                    $data['onboading_video'] = 'storage/videos/'.$video_name;

                    ProfessionalInformation::where('user_id',$user_id)
                                            ->update(['onboading_video'=> $data['onboading_video'],]);

                    
                }
            } 
            
            ProfessionalInformation::where('user_id',$user_id)
                                     ->update(['about'=>$request->about,
                                               'experience'=>$request->experience,
                                             ]);

              return back()->with('success','professional information updated')->with('tab_name',$tab_name);
            
        }

        if($request->has('subject_btn'))
        {
            HourlyPay::where('user_id',$user_id)->update(['amount'=>$request->amount]);
         
            // dd(json_encode($request->subjects));
            // $subjects = explode(',',$request->subjects);
            Subjects::where('user_id',$user_id)->update(['category_id'=>$request->category,
                                                          'title'=>json_encode($request->subjects),
                                                        ]);
            return back()->with('success','subject updated')->with('tab_pane',$tab_name);

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
                    return back()->withErrors($validator->errors())->with('tab_name',$tab_name);
                }
                else
                {
                  $user=Users::where('id',$user_id)->with('role')->first();
                //   Users::where('id',$user_id)->update(['password'=>\Hash::make($request->confirm_password)]);
                  if(\Hash::check($request->current_password,$user->password))
                  {
                    if(\Hash::check($request->confirm_password,$user->password))
                    {
                        return back()->with('error','New password cannot be same with old password')->with('tab_name',$tab_name);
                    }
                    
                     Users::where('id',$user_id)->update(['password'=>\Hash::make($request->confirm_password)]);
                     return back()->with('success','password updated')->with('tab_name',$tab_name);
                  }
                  else
                  {
                    return back()->with('error','Current password mismatch')->with('tab_name',$tab_name);
                  }
                }
        }

        if($request->has('education_new_btn'))
        {
            
                foreach ($request->education as $items => $value)
                {
                
                        $path3 = storage_path('files/results');
                        $file_uploaded = $value['result_upload'];
                        $extension3 = $file_uploaded->getClientOriginalExtension(); 
                        $file_name =  $rad. '.' . $extension3; 
                        $file_uploaded->move($path3,$file_name);
                        $data['result_upload'] = 'storage/files/results/'.$file_name;
                
                        Education::create(['university'=>$value['university'],
                                            'degree'=>$value['degree'],
                                            'passing_year'=>$value['passing_year'],
                                            'result'=>$value['result'],
                                            'upload_file'=>$data['result_upload'],
                                            'user_id'=>$id,
                                            ]);

                }

            return back()->with('success','Added successfully')->with('tab_pane',$tab_name);

        }

        if($request->has('certifications_new_btn'))
           {
               foreach($request->certificate as $items_2 => $value_2)
                 {           //certification upload
                               $path4 = storage_path('files/certificates');
                               $certificate = $value_2['certification_upload'];
                               $extension4 = $certificate->getClientOriginalExtension(); 
                               $certificate_name =  $rad. '.' . $extension4; 
                               $filePath3 = $certificate->move($path4,$certificate_name);
                               $data['certification_upload'] = 'storage/files/certificates/'.$certificate_name;

                               Cerification::create(['title'=>$value_2['title'],
                                                     'decription'=>$value_2['description'],
                                                     'issued'=>$value_2['issued'],
                                                     'upload_file'=>$data['certification_upload'],
                                                     'user_id'=>$id,
                                                   ]);
                         
                   }

               return back()->with('success','Added successfully')->with('tab_name',$tab_name);

           }

        if($request->has('schedule_new_btn'))
        {
            foreach($request->schedule as $item_3 => $value_3)
            { 
               
                $days_split = array();
                $time_from =strtotime($value_3['from']);
                $time_to =strtotime($value_3['to']);
                $addMins = 60 * 60;
                while($time_from <= $time_to)
                {
                    $days_split[] = date("G:i",$time_from);
                    $time_from += $addMins;
                }
                
                    $break = explode(',',$value_3['break_times']); 
                   
                    Schedule::create(['day'=>$value_3['day'],
                                        'from'=>$value_3['from'],
                                        'to'=>$value_3['to'],
                                        'user_id'=>$id,
                                        'time_split'=>json_encode($days_split),
                                        'break_times'=>json_encode($break),
                                        'time_limit'=>$value_3['time_limit'],
                                    ]);

             }

             return back()->with('success','Added successfully')->with('tab_pane',$tab_name);
             
        }

        if($request->has('notification_btn'))
        {  
              Notification::where('user_id',$user_id)->update(['messages'=>$request->message,
                                                             'activities'=>$request->activities,
                                                             'offers'=>$request->offers,
                                                             'everything'=>$request->everything,
                                                             'send_as_email'=>$request->send_as_email,
                                                             'no_push'=>$request->no_push
                                                            ]);
         
            return back()->with('success','General Settings Updated')->with('tab_name',$tab_name);
        }
    }

    public function select_break(Request $request)
    {
        $id = session()->get('id');
        $user = Users::find("$id");
            $from = $request->from_new;
            $to = $request->to_new;
            $split = array();
            $time_from =strtotime($from);
            $time_to =strtotime($to);
            $addMins = 60 * 60;
            while($time_from <= $time_to)
            {
                $split[] = date("G:i",$time_from);
                $time_from += $addMins;
            }

       
        return view('teachers.profile-forms.break-time',compact('split','user'))->render();
    }

    public function select_breakFormWizard(Request $request)
    {
        $id = session()->get('id');
        $user = Users::find("$id");
            $from = $request->from_2;
            $to = $request->to_2;
            $split = array();
            $time_from =strtotime($from);
            $time_to =strtotime($to);
            $addMins = 60 * 60;
            while($time_from <= $time_to)
            {
                $split[] = date("G:i",$time_from);
                $time_from += $addMins;
            }

            return view('teachers.profile-forms.add-break-time',compact('split','user'))->render();
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
