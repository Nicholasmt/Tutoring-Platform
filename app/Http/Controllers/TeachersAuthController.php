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
use App\Models\Recommendation;
use App\Models\Wallet;
use App\Models\Rating;
use App\Models\Notification;
use App\Models\Session as DBSession;
use App\Jobs\MailNofications;
use DB;


class TeachersAuthController extends Controller
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

    public function redirect()
    {
        
        if(session()->get('authentication') == true && session()->get('privilege') == 1)
        {
          return redirect('admin/dashboard');
        }
        elseif(session()->get('authentication') == true && session()->get('privilege') == 2)
        {
          return redirect('teachers/dashboard');
        }
        elseif(session()->get('authentication') == true && session()->get('privilege') == 3)
        {
          return redirect('parents/dashboard');
        }
    }

    public function authentication(Request $request)
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
            $user = Users::where('email',$request->email)->with('role')->first();
            if($user)
            {
                if(\Hash::check($request->password,$user->password))
                {
                   $users_info = PersonalInformation::where('user_id',$user->id)->with('user')->first();
                   $request->session()->put('id',$user->id);
                   $request->session()->put('email',$user->email);
                   $request->session()->put('first_name',$user->first_name);
                   $request->session()->put('last_name',$user->last_name);
                   $request->session()->put('privilege',$user->role_id);
                   $request->session()->put('photo',$users_info->profile_photo);
                   $request->session()->put('authentication',true);
 
                   if($user->email_verify == 2)
                    {
                        return redirect('send-mail')->with('success','Email Sent');
                    }
                    else
                    {
                        if(session('book_url'))
                        {
                            return redirect(session('book_url'));
                        } 
                            return redirect('redirect');
                    }

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

    public function form2()
    {
        
        $categories = Category::all();
        return view('teachers.profile-forms.form-wizard',compact('categories'));
    }
     
    public function form1()
    {
        return view('teachers.profile-forms.form1');
    }

    public function profile_preview()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        $schedules = Schedule::where('user_id',$id)->with('user')->get();
        $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
        $subjects = Subjects::where('user_id',$id)->with('user')->first();
        $certifications = Cerification::where('user_id',$id)->with('user')->get();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $educations = Education::where('user_id',$id)->with('user')->get();
        return view('teachers.profile-forms.form-preview',compact('user','certifications','pro_infos','personal_infos','educations','subjects','hourly_pay','schedules'));
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
    //    $user = Users::where('email',$request->email)->first();
    //    if($user && Hash::check())
        $rules=['email'=>'required|unique:users',
                'password'=>'required',
                'agree'=>'required',
              ];
        $validator = \Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput();
        }
        else
        {
           DB::beginTransaction();
           try 
           {
             $data=['email'=>$request->email,
                    'role_id'=>2,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'password'=>\Hash::make($request->password)
                  ];
             $teacher = Users::create($data);
             $request->session()->put('id',$teacher->id);
             $request->session()->put('email',$teacher->email);
             $request->session()->put('first_name',$teacher->first_name);
             $request->session()->put('last_name',$teacher->last_name);
             $request->session()->put('privilege',$teacher->role_id);
             $request->session()->put('authentication',true);
            
              PersonalInformation::create(['user_id'=>$teacher->id,
                                            'phone'=>$request->phone
                                         ]);

              Wallet::create(['user_id'=>$teacher->id]);
              Rating::create(['user_id'=>$teacher->id]);
              Notification::create(['user_id'=>$teacher->id]);
              DB::commit();
              if($teacher->email_verify == 0)
              {
                  return redirect('send-mail')->with('success','Email Sent');
              }
              else
              {
                // return redirect()->route('teachers-form1');
                return redirect()->route('teachers-step-wizard');
              }
              
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
            }
           

        }
    }

    public function add_schedule($count)
    {
        $id =  session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        return view('teachers.profile-forms.add-schedule',compact('count','user'))->render();
    }

    public function add_certification($count)
    { 
         $id =  session()->get('id');
         $user = Users::where('id',$id)->with('role')->first();
         return view('teachers.profile-forms.add-certification',compact('count','user'))->render();
    }

    public function add_qualification($count)
    { 
        $id =  session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        return view('teachers.profile-forms.add-qualification',compact('count','user'))->render();
    }

    public function form_completed()
    {
        $id = session()->get('id');
        Users::where('id',$id)->update(['verify_ready'=>1]);
        //send mail
        $data=['mail'=>'welcome_onboard',
               'user_id'=>$id,
              ];
        MailNofications::dispatchSync($data);
        return back()->with('completed', 'yes_done');

    }

    public function wizard_edit()
    {
        
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        $schedules = Schedule::where('user_id',$id)->with('user')->get();
        $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
        $subjects = Subjects::where('user_id',$id)->with('user')->first();
        $certifications = Cerification::where('user_id',$id)->with('user')->get();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $educations = Education::where('user_id',$id)->with('user')->get();
        $categories = Category::all();
        return view('teachers.profile-forms.wizard-edit',compact('user','categories','certifications','pro_infos','personal_infos','educations','subjects','hourly_pay','schedules'));
    }
     

    public function form_wizard(Request $request)
    {   
         
        $id = session()->get('id');
        $rad= substr(rand(0,time()),0,8);
        // profile photo upload
        $path1 = storage_path('imgs/profile');
        $photo = $request->file('profile_photo');
        $extension1 = $photo->getClientOriginalExtension();
        $photo_name =  $rad. '.' . $extension1; 
        $imagePath = $photo->move($path1, $photo_name);
        $data['profile_photo'] = 'storage/imgs/profile/'.$photo_name;
        //Id upload
        $path2 = storage_path('files/IDs');
        $identity = $request->file('means_of_ID');
        $extension2 = $identity->getClientOriginalExtension(); 
        $identity_name =  $rad. '.' . $extension2; 
        $filePath1 = $identity->move($path2, $identity_name);
        $data['means_of_ID'] = 'storage/files/IDs/'.$identity_name;

        //video upload
        $path5 = storage_path('videos');
        $video = $request->file('onboading_video');
        $extension5 = $video->getClientOriginalExtension(); 
        $video_name =  $rad. '.' . $extension5; 
        $filePath2 = $video->move($path5, $video_name);
        $data['onboading_video'] = 'storage/videos/'.$video_name;
         
        // DB::beginTransaction();
        // try{
                Users::where('id',$id)->update(['first_name'=>$request->first_name,
                                                'last_name'=>$request->last_name]);
                $users = Users::where('id',$id)->with('role')->first();
                //store session
                $request->session()->put('first_name',$users->first_name);
                $request->session()->put('last_name',$users->last_name);
                $subjects = explode(',',$request->subjects);
                Subjects::create(['category_id'=>$request->category,
                                'title'=>json_encode($subjects),
                                'user_id'=>$id,
                                ]);

                HourlyPay::create(['user_id'=>$id,
                                    'amount'=>$request->amount,
                                    ]);

                PersonalInformation::where('user_id',$id)
                                                 ->update([ 
                                                            'address'=>$request->address,
                                                            'town'=>$request->town,
                                                            'state'=>$request->state,
                                                            'country'=>$request->country,
                                                            'phone'=>$request->phone,
                                                            'd_o_b'=>$request->d_o_b,
                                                            'means_of_ID'=>$data['means_of_ID'],
                                                            'profile_photo'=> $data['profile_photo'],
                                                        ]);

                    $user_info = PersonalInformation::where('user_id',$id)->first();
                    $request->session()->put('photo',$user_info->profile_photo);

                    ProfessionalInformation::create(['about'=>$about,
                                                    'user_id'=>$id,
                                                    'experience'=>$experience,
                                                    'onboading_video'=> $data['onboading_video'],
                                                    ]);
                     
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
                            

                                Schedule::create(['day'=>$value_3['day'],
                                                    'from'=>$value_3['from'],
                                                    'to'=>$value_3['to'],
                                                    'user_id'=>$id,
                                                    'time_split'=>json_encode($days_split),
                                                    'break_times'=>json_encode($request->break_times),
                                                    'time_limit'=>$value_3['time_limit'],
                                                 ]);

              
                        return redirect('teachers/profile-preview');

                
            
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

        $rad= substr(rand(0,time()),0,8);
        
        if($request->has('personal_btn'))
        {
           $personal = PersonalInformation::where('id',$id)->with('user')->first();

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
                    
                    // unlink($personal->profile_photo);
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

                    PersonalInformation::where('id',$id)
                                        ->update(['profile_photo'=> $data['profile_photo'],
                                                   
                                                 ]);
                    $update_photo = PersonalInformation::where('id',$id)->with('user')->first();
                    $request->session()->put('photo', $update_photo->profile_photo);

                }
           }

           if($request->has('means_of_ID'))
           {
                $rules=['means_of_ID'=>'required',];
                $custom_message=['means_of_ID.required'=>'upload a mean of identification'];

                $validator = \Validator::make($request->all(),$rules,$custom_message);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors());
                }
                else
                {
                     
                    // identification upoload
                    unlink($personal->mean_of_ID);
                    $path2 = storage_path('files/IDs');
                    $identity = $request->file('means_of_ID');
                    $extension2 = $identity->getClientOriginalExtension(); 
                    $identity_name =  $rad. '.' . $extension2; 
                    $filePath1 = $identity->move($path2, $identity_name);
                    $data['means_of_ID'] = 'storage/files/IDs/'.$identity_name;

                    PersonalInformation::where('id',$id)
                                        ->update(['means_of_ID'=> $data['means_of_ID'],]);
                     $users_info = PersonalInformation::where('id',$id)->with('user')->first();                  
                     $request->session()->put('photo',$users_info->profile_photo);
                }
           }
               
                PersonalInformation::where('id',$id)
                                    ->update(['address'=>$request->address,
                                              'town'=>$request->town,
                                               'state'=>$request->state,
                                                'country'=>$request->country,
                                                'phone'=>$request->phone,
                                                'd_o_b'=>$request->d_o_b,
                                                'is_verified'=>0,
                                            ]);

                   Users::where('id',$personal->user_id)->update(['first_name'=>$request->first_name,
                                                   'last_name'=>$request->last_name]);

                   $users = Users::where('id',$personal->user_id)->with('role')->first();
                   //store session
                   $request->session()->put('first_name',$users->first_name);
                   $request->session()->put('last_name',$users->last_name);

                 return back()->with('success','personal information updated')->with('tab_name','Mydetails');;
              
        }
        if($request->has('professional_btn'))
        {
            $professional = ProfessionalInformation::where('id',$id)->with('user')->first();

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

                    ProfessionalInformation::where('id',$id)
                                            ->update(['onboading_video'=> $data['onboading_video'],]);
                }
           }

             ProfessionalInformation::where('id',$id)
                                     ->update(['about'=>$request->about,
                                               'experience'=>$request->experience,
                                               'is_verified'=>0,
                                             ]);
              return back()->with('success','professional information updated')->with('tab_name','pro-info');

        }

        if($request->has('qualification_btn'))
        {
            $qualification = Education::find("$id");

            if($request->has('result_upload'))
           {
                $rules=['result_upload'=>'required',];

                $validator = \Validator::make($request->all(),$rules);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors());
                }
                else
                {
                     
                    unlink($qualification->upload_file);
                    // qualification upload
                    $path3 = storage_path('files/results');
                    $file_uploaded = $request->file('result_upload');
                    $extension3 = $file_uploaded->getClientOriginalExtension(); 
                    $file_name =  $rad. '.' . $extension3; 
                    $file_uploaded->move($path3,$file_name);
                    $data['result_upload'] = 'storage/files/results/'.$file_name;

                    Education::where('id',$id)
                               ->update(['upload_file'=> $data['result_upload'],]);
                }
           }

                Education::where('id',$id)->update(['university'=>$request->university,
                                                    'degree'=>$request->degree,
                                                    'passing_year'=>$request->passing_year,
                                                    'result'=>$request->result,
                                                    'is_verified'=>0,
                                                    'visible'=>$request->edu_visibility
                                                  ]);
                return back()->with('success','Qualification information updated')->with('tab_name','education');

        }
        if($request->has('certification_btn'))
        {
            $cerification = Cerification::find("$id");

            if($request->has('certification_upload'))
           {
                $rules=['certification_upload'=>'required'];

                $validator = \Validator::make($request->all(),$rules);
                if($validator->fails())
                {
                    return back()->withErrors($validator->errors());
                }
                else
                {
                     
                    unlink($cerification->upload_file);
                     //certification upload
                    $path4 = storage_path('files/certificates');
                    $certificate = $request->file('certification_upload');
                    $extension4 = $certificate->getClientOriginalExtension(); 
                    $certificate_name =  $rad. '.' . $extension4; 
                    $filePath3 = $certificate->move($path4,$certificate_name);
                    $data['certification_upload'] = 'storage/files/certificates/'.$certificate_name;

                    Cerification::where('id',$id)
                                 ->update(['upload_file'=> $data['certification_upload'],]);
                }
           }

            
           Cerification::where('id',$id)->update(['title'=>$request->title,
                                      'decription'=>$request->description,
                                      'issued'=>$request->issued,
                                      'is_verified'=>0,
                                      'visible'=>$request->cert_visibility
                                     ]);
          return back()->with('success','cerification information updated')->with('tab_name','education');

        }

        if($request->has('schedule_btn'))
        {  
            // dd(json_encode($request->break_times));
            $days_split = array();
            $time_from =strtotime($request->from);
            $time_to =strtotime($request->to);
            $addMins = 60 * 60;
            while($time_from <= $time_to)
            {
                $days_split[] = date("G:i",$time_from);
                $time_from += $addMins;
            }
             Schedule::where('id',$id)->update(['day'=>$request->day,
                                                'from'=>$request->from,
                                                'to'=>$request->to,
                                                'time_split'=>json_encode($days_split),
                                                'time_limit'=>$request->time_limit,
                                                'break_times'=>json_encode($request->break_times),

                                            ]);
               
            return back()->with('success','schedule information updated')->with('tab_pane','schedule');
        }

        if($request->has('preview_btn'))
        {
            $user_id = session()->get('id');
            $subjects = explode(',',$request->subjects);
            Subjects::where('user_id',$user_id)->update(['category_id'=>$request->category,
                                                         'title'=>json_encode($subjects),
                                                        ]);

            HourlyPay::where('user_id',$user_id)->update(['amount'=>$request->amount,]);

           
             return redirect('teachers/profile-preview');
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
