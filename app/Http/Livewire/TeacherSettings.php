<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
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
use App\Models\State;
use App\Models\Country;
use App\Models\University;

class TeacherSettings extends Component
{
   use WithFileUploads;

   public $user,$notifications,$categories,$education_infos,$pro_infos,$personal_infos;
   public $hourly_pay,$schedules_infos,$cert_infos,$subjects,$successMsg;
   public $no_push,$send_as_email,$everything,$offers,$message,$activities;
   public $first_name,$last_name,$country,$phone,$address,$town,$state,$profile_photo,$email;
   public $confirm_password,$new_password,$current_password;
   public $onboading_video,$experience,$about;
   public $qualification=[], $certifications=[], $schedules =[];
   public $university,$qualification_upload,$passing_year,$result,$degree,$edu_visibility;
   public $title,$description,$issued,$certification_upload,$cert_visibility;
   public $msg_display = 0,$currentTab = 0,$i = 1,$dynamic_button = 0,$dynamic_qualify,$dynamic_cert,$dynamic_schedule;
   public $amount,$subject,$break_times=[];
   public $from,$to,$time_limit,$day,$subjects_infos,$levels,$schedule_id;
   public $universtities,$certification_id,$qualification_id;
   public $time_diff2;
   
   public $more_title,$more_description,$more_issued,$more_certification_upload,$more_cert_visibility;
   public $more_university,$more_qualification_upload,$more_passing_year,$more_result,$more_degree,$more_edu_visibility;
   public $more_from,$more_to,$more_time_limit,$more_day,$more_time_split;

   public function add($i)
   {
       $this->dynamic_button = 1;
       $this->currentTab = 4;
       $this->dynamic_schedule = 1;
       $i = $i + 1;
       $this->i = $i;
       array_push($this->schedules ,$i);
   }
   public function addCertification($i)
   {
      $this->dynamic_button = 1;
      $this->currentTab = 3;
      $this->dynamic_cert = 1;
       $i = $i + 1;
       $this->i = $i;
       array_push($this->certifications ,$i);
   }

   public function addQualification($i)
   {

       $this->dynamic_button = 1;
       $this->currentTab = 3;
       $this->dynamic_qualify = 1;
       $i = $i + 1;
       $this->i = $i;
       array_push($this->qualification ,$i);
   }

   public function remove($i)
   {
       if($i == null){ $this->dynamic_button = 0; $this->dynamic_schedule = 0;}
       $this->currentTab = 4;
       unset($this->schedules[$i]);
   }
   public function remove_qualification($i)
   {
       if($i == null){ $this->dynamic_qualify = 0; $this->dynamic_button = 0; }
       $this->currentTab = 3;
       unset($this->qualification[$i]);
   }
   public function remove_certification($i)
   {
        if($i == null){ $this->dynamic_cert = 0; $this->dynamic_button = 0; }
        $this->currentTab = 3;
        unset($this->certifications[$i]);
   }

   public function hydrate()
   {
       $this->emit('loadSubject');
       $this->emit('loadState');
       $this->emit('loadUniversity');
       $this->emit('loadMoreUniversity');
       $this->emit('loadMoreDay');
       $this->emit('loadLevels');
   }


   public function mount()
   {

     $id = session()->get('id');
     $this->user = Users::with('role')->find("$id");
     $this->schedules_infos = Schedule::where('user_id',$id)->with('user')->get();
     $this->hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
     $this->subjects_infos = Subjects::where('user_id',$id)->with('user')->first();
     $this->cert_infos = Cerification::where('user_id',$id)->with('user')->get();
     $this->personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
     $this->pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
     $this->education_infos = Education::where('user_id',$id)->with('user')->get();
     $this->categories = Category::all();
     $this->notifications = Notification::where('user_id',$id)->with('user')->first();
    //notifications
    $this->message = $this->notifications->messages;
    $this->send_as_email = $this->notifications->send_as_email;
    $this->activities = $this->notifications->activities;
    $this->no_push = $this->notifications->no_push;
    $this->everything = $this->notifications->everything;
    $this->offers = $this->notifications->offers;
    //personal_info
    $this->first_name = $this->user->first_name;
    $this->last_name = $this->user->last_name;
    $this->country = $this->personal_infos->country;
    $this->state = $this->personal_infos->state;
    $this->address = $this->personal_infos->address;
    $this->phone = $this->personal_infos->phone;
    $this->town = $this->personal_infos->town;
    $this->email = $this->user->email;

    // professional informations
    $this->about = $this->pro_infos->about;
    $this->experience = $this->pro_infos->experience;
    $this->onboading_video = $this->pro_infos->onboading_video;
    
    //qualification informations
    foreach($this->education_infos as $education)
    {
        $this->edu_visibility[] = $education->visible;
        $this->result[] = $education->result;
        $this->passing_year[] = $education->passing_year;
        $this->degree[] = $education->degree;
        $this->university[] = $education->university;
        $this->qualification_upload[] = $education->upload_file;
        $this->qualification_id[] = $education->id;
    }
    //  certification informations
    foreach($this->cert_infos as $cert)
    {
        $this->cert_visibility[] = $cert->visible;
        $this->issued[] = $cert->issued;
        $this->description[] = $cert->decription;
        $this->title[] = $cert->title;
        $this->certification_upload[] = $cert->upload_file;
        $this->certification_id[] = $cert->id;
    }

        $this->levels = json_decode($this->subjects_infos->levels);
        $this->subjects = json_decode($this->subjects_infos->title);
        $this->amount = $this->hourly_pay->amount;
        foreach($this->schedules_infos as $key4 => $schedule)
        {
            $this->day[] = $schedule->day;
            $this->from[] = $schedule->from;
            $this->to[] = $schedule->to;
            $this->time_limit[] = $schedule->time_limit;
            $this->schedule_id[] = $schedule->id;
            
            
        }

   }

  



    public function render()
    {  
       
        if($this->currentTab == 3)
        {
           session()->flash('tab_pane','education');
        }
        elseif($this->currentTab == 2)
        {
          session()->flash('tab_pane','pro-info');
        }
        elseif($this->currentTab == 4)
        {
           session()->flash('tab_pane','schedule');
        }
    
        if($this->country)
        {
            $country = Country::where('name','like', "%{$this->country}%")->first();
            $this->states = State::where(['country_id'=> $country->id])->with('country')->get();
           
        }

        $this->universities = University::all();
        return view('livewire.teacher-settings');
        
    }

    public function updatePersonalInfo($id)
    {
       $this->validate(['first_name'=>'required',
                        'last_name'=>'required',
                        // 'country'=>'required',
                        'phone'=>'required',
                        'address'=>'required',
                        'town'=>'required',
                        'state'=>'required',
                        'profile_photo'=>'max:5120',
                       ]);

      if($this->profile_photo) 
        {
            $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
            if(file_exists($personal_infos->profile_photo))
            {
               unlink($personal_infos->profile_photo);
            }
            $photo =  $this->profile_photo->storeAs('imgs/profile', substr(rand(0,time()),0,5).'.png');
            PersonalInformation::where('user_id',$id)
                                 ->update(['profile_photo'=>'storage/app/'.$photo]);
 
            $personal_updated = PersonalInformation::where('user_id',$id)->with('user')->first();
            session()->put('photo',$personal_updated->profile_photo);
 
         } 
          
            Users::where('id',$id)->update(['first_name'=>$this->first_name,
                                           'last_name'=>$this->last_name,
                                           ]);
 
             $users_update = Users::with('role')->find("$id");
             session()->put('first_name',$users_update->first_name);
 
             PersonalInformation::where('user_id',$id)
                                 ->update(['address'=>$this->address,
                                         'town'=>$this->town,
                                         'state'=>$this->state,
                                         'country'=>$this->country,
                                         'phone'=>$this->phone,
                                         ]);
   
         $this->successMsg = session()->flash('message','Personal Information Updated.');
         $this->tab_name = session()->flash('tab_pane','Mydetails');
         $this->emit('alert_remove');
 
    }
    
    public function updateProInfo($id)
    {
        $this->tab_name = session()->flash('tab_pane','pro-info');
        $this->validate([
                        'about' => 'required',
                        'experience' => 'required',
                        'onboading_video' => 'required',
                       ]);

        if($this->onboading_video)
        {
            $professional_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();

            if(file_exists($professional_infos->onboading_video))
            {
               unlink($professional_infos->onboading_video);
            }
            $video_path =  $this->onboading_video->storeAs('videos', substr(rand(0,time()),0,5));
            ProfessionalInformation::where('user_id',$id)->update(['onboading_video'=>'storage/app/'.$video_path]);
        }
                      
        ProfessionalInformation::where('user_id',$id)->update(['about'=>$this->about,
                                                                'experience'=>$this->experience,
                                                              ]);

        $this->successMsg = session()->flash('message','Professional Information Updated.');
        $this->tab_name = session()->flash('tab_pane','pro-info');
        $this->emit('alert_remove');

    }
    
    public function updateGeneralSettings($id)
    {
        $this->currentTab = 6;
        if($this->message == true){ $message = 1; } else {$message = 0;}
        if($this->activities == true){ $activities = 1; } else {$activities = 0;}
        if($this->offers == true){ $offers = 1; } else {$offers = 0;}
        if($this->everything == true){ $everything = 1; } else {$everything = 0;}
        if($this->send_as_email == true){ $send_as_email = 1; } else {$send_as_email = 0;}
        if($this->no_push == true){ $no_push = 1; } else {$no_push = 0;}

        Notification::where('user_id',$id)->update(['messages'=>$message,
                                                    'activities'=>$activities,
                                                    'offers'=>$offers,
                                                    'everything'=>$everything,
                                                    'send_as_email'=>$send_as_email,
                                                    'no_push'=>$no_push
                                                    ]);

            $this->successMsg = session()->flash('message','Notification Updated.');
            $this->tab_name = session()->flash('tab_pane','notification');
            $this->emit('alert_remove');
        
    }

    public function updatePassword($id)
    {
        $this->currentTab = 5;
        $this->tab_name = session()->flash('tab_pane','password');
       
        $this->validate(['confirm_password'=>'required|same:new_password',
                         'new_password'=>'required',
                         'current_password'=>'required',
                       ]);
          
        $user=Users::where('id',$id)->with('role')->first();
       if(\Hash::check($this->current_password,$user->password))
        {
            if(\Hash::check($this->confirm_password,$user->password))
            {
                $this->successMsg = session()->flash('error','New password cannot be same with old password.');
                $this->tab_name = session()->flash('tab_pane','password');
                $this->emit('alert_remove');
            }
                Users::where('id',$id)->update(['password'=>\Hash::make($this->confirm_password)]);
                $this->successMsg = session()->flash('message','Password Updated.');
                $this->tab_name = session()->flash('tab_pane','password');
                $this->emit('alert_remove');
        }
        else
        {
           $this->successMsg = session()->flash('error','Current password mismatch.');
           $this->tab_name = session()->flash('tab_pane','password');
           $this->emit('alert_remove');
        }

        $this->tab_name = session()->flash('tab_pane','password');

    }

    
    public function UpdateEducation()
    {
        $this->validate([
                       'university.0'=>'required',
                       'passing_year.0'=>'required',
                       'result.0'=>'required',
                       'degree.0'=>'required',
                       'qualification_upload.0'=>'max:5120',
                       'university.*'=>'required',
                       'passing_year.*'=>'required',
                       'result.*'=>'required',
                       'degree.*'=>'required',
                       'qualification_upload.*'=>'max:5120',

                       'title.0'=>'required',
                       'description.0'=>'required',
                       'issued.0'=>'required',
                       'certification_upload.0'=>'max:5120',
                       'title.*'=>'required',
                       'description.*'=>'required',
                       'issued.*'=>'required',
                       'certification_upload.*'=>'max:5120',
                       ]);

       $qulification_array = $this->education_infos->count();
       $certification_array = $this->cert_infos->count();
     
        foreach ($this->education_infos as $key1 => $qualication) 
        {
           $id =  $this->qualification_id[$key1];
           $education_info = Education::where('id',$id)->with('user')->first();
         
       //    if(!$key1 > $qulification_array-1)
       //    {
               if(is_string($this->qualification_upload[$key1]))
               {
                   if($this->edu_visibility[$key1] == true){ $visibility= 1; } else {$visibility = 0;}
                   Education::where('id',$id)->update(['university'=>$this->university[$key1],
                                                       'degree'=>$this->degree[$key1],
                                                       'passing_year'=>$this->passing_year[$key1],
                                                       'result'=>$this->result[$key1],
                                                       'visible'=>$visibility,
                                                       'upload_file'=>$education_info->upload_file,
                                                   ]);
               }
               else
               {
       
                   if(file_exists($education_info->upload_file))
                   {
                       unlink($education_info->upload_file);
                   }
                   
                   $qualification_file = $this->qualification_upload[$key1]->storeAs('files/results', substr(rand(0,time()),0,5).'.png');
                   if($this->edu_visibility[$key1] == true){ $visibility = 1; } else {$visibility = 0;}
                   Education::where('id',$id)->update(['university'=>$this->university[$key1],
                                                       'degree'=>$this->degree[$key1],
                                                       'passing_year'=>$this->passing_year[$key1],
                                                       'result'=>$this->result[$key1],
                                                       'visible'=>$visibility,
                                                       'upload_file'=>'storage/app/'.$qualification_file,
                                                   ]); 
               }

         }
        foreach ($this->cert_infos as $key2 => $cert) 
        {
              $cert_id = $this->certification_id[$key2];
              $certification_info = Cerification::where('id',$cert_id)->with('user')->first();
              
              if(is_string($this->certification_upload[$key2]))
               {
                   if($this->cert_visibility[$key2] == true){ $visibility = 1; } else {$visibility = 0;}
                   Cerification::where('id',$cert_id)->update(['title'=>$this->title[$key2],
                                                       'decription'=>$this->description[$key2],
                                                       'issued'=>$this->issued[$key2],
                                                       'visible'=>$visibility,
                                                       'upload_file'=>$certification_info->upload_file,
                                                       ]);

               }
               else
               {
                   if(file_exists($certification_info->upload_file))
                   {
                       unlink($certification_info->upload_file);
                   }

                   $certification_file = $this->certification_upload[$key2]->storeAs('files/certificates', substr(rand(0,time()),0,5).'.png');
                   if($this->cert_visibility[$key2] == true){ $visibility = 1; } else {$visibility = 0;}
                   Cerification::where('id',$cert_id)->update(['title'=>$this->title[$key2],
                                                       'decription'=>$this->description[$key2],
                                                       'issued'=>$this->issued[$key2],
                                                       'visible'=>$visibility,
                                                       'upload_file'=>'storage/app/'.$certification_file
                                                       ]);
               }

           
        }

        
        $this->successMsg = session()->flash('message','Education Information Saved.');
        $this->tab_name = session()->flash('tab_pane','education');
        $this->emit('alert_remove');
        $this->msg_display = 1;
         
     
    }


    public function moreEducation()
    {
      
        if($this->dynamic_qualify == 1)
        {
           $this->validate(['more_university.0'=>'required',
                            'more_passing_year.0'=>'required',
                            'more_result.0'=>'required',
                            'more_degree.0'=>'required',
                            'more_qualification_upload.0'=>'required',
                            'more_university.*'=>'required',
                            'more_passing_year.*'=>'required',
                            'more_result.*'=>'required',
                            'more_degree.*'=>'required',
                            'more_qualification_upload.*'=>'required',
                           ],
                           [
                            'more_university.0.required' => 'university field is required',
                            'more_passing_year.0.required' => 'passing year field is required',
                            'more_result.0.required' => 'result field is required',
                            'more_qualification_upload.0.required' => 'qualification file field is required',
                            'more_degree.0.required' => 'degree field is required',
                            'more_university.*.required' => 'university field is required',
                            'more_passing_year.*.required' => 'passing year field is required',
                            'more_result.*.required' => 'result field is required',
                            'more_qualification_upload.*.required' => 'qualification file field is required',
                            'more_degree.*.required' => 'degree field is required',
                           ]);
        }
        if($this->dynamic_cert == 1)
        { 
            $this->validate([
                             'more_title.0'=>'required',
                             'more_description.0'=>'required',
                             'more_issued.0'=>'required',
                             'more_certification_upload.0'=>'required',
                             'title.*'=>'required',
                             'more_description.*'=>'required',
                             'more_issued.*'=>'required',
                             'more_certification_upload.*'=>'required',
                            ],
                            [
                            'more_title.0.required' => 'title field is required',
                            'more_description.0.required' => 'description field is required',
                            'more_issued.0.required' => 'issued date field is required',
                            'more_certification_upload.0.required' => 'certification field is required',
                            'more_title.*.required' => 'title field is required',
                            'more_description.*.required' => 'description field is required',
                            'more_issued.*.required' => 'issued date field is required',
                            'more_certification_upload.*.required' => 'certification field is required',
                            ]);
            
        }
       
             $id = session()->get('id'); 
            if($this->more_university)
            {
               foreach ($this->more_university as $key_1 => $edu) 
                {
                    if(!empty($this->more_qualification_upload[$key_1]) && !empty($this->more_degree[$key_1]) && !empty($this->more_university[$key_1]) && !empty($this->more_passing_year[$key_1]) && !empty($this->more_result[$key_1]))
                    {

                        if(empty(($this->more_edu_visibility[$key_1]))){ $visible = 0; } elseif($this->edu_visibility[$key_1] == true) {$visible = 1;}
                                    $qualification_file = $this->more_qualification_upload[$key_1]->storeAs('files/results', substr(rand(0,time()),0,5).'.png');
                                    Education::create(['university'=>$this->more_university[$key_1],
                                                        'degree'=>$this->more_degree[$key_1],
                                                        'passing_year'=>$this->more_passing_year[$key_1],
                                                        'result'=>$this->more_result[$key_1],
                                                        'upload_file'=>'storage/app/'.$qualification_file,
                                                        'user_id'=>$id,
                                                        'visible'=>$visible,
                                                        ]);

                       //remove appended form    
                       $this->remove_qualification($key_1);

                    }
  
                }

            
            }
            

    
        if($this->more_title)
        {
            foreach ($this->more_title as $key_2 => $cert) 
            {
                if(!empty($this->more_certification_upload[$key_2]) && !empty($this->more_title[$key_2]) && !empty($this->more_description[$key_2]) && !empty($this->more_issued[$key_2]))
                {
                    if(empty($this->more_cert_visibility[$key_2])){ $visible = 0; } elseif($this->more_cert_visibility[$key_2] == true) {$visible = 1;}
                      $certification_file = $this->more_certification_upload[$key_2]->storeAs('files/certificates', substr(rand(0,time()),0,5).'.png');
                            
                         Cerification::create(['title'=>$this->more_title[$key_2],
                                              'decription'=>$this->more_description[$key_2],
                                              'issued'=>$this->more_issued[$key_2],
                                              'upload_file'=>'storage/app/'.$certification_file,
                                              'user_id'=>$id,
                                              'visible'=>$visible,
                                            ]);
    
                      //remove appended form 
                      $this->remove_certification($key_2);


                }


            }


             
        }

          $this->clearMoreEducation();
          $this->successMsg = session()->flash('success','Education Information Saved.');
          $this->tab_name = session()->flash('tab_pane','education');
          $this->emit('alert_remove');
          $this->msg_display = 1;
          return redirect('teachers/settings');
           
                      
    }

    public function clearMoreEducation()
    {
        $this->more_issued = '';
        $this->more_description = '';
        $this->more_title = '';
        $this->more_cert_visibility = '';
        $this->more_certification_upload = '';
        
        $this->more_result = '';
        $this->more_passing_year = '';
        $this->more_degree = '';
        $this->more_university = '';
        $this->more_qualification_upload ='';
        $this->more_edu_visibility = '';

    }
    
     

    public function educationTab()
    {
        $this->currentTab = 3;
    }
    public function proTab()
    {
        $this->currentTab = 2;
    }
    public function personalTab()
    {
        $this->currentTab = 1;
    }
    public function updatedSubjects()
    {
        $this->currentTab = 4;
    } 
    
    public function updatedLevels()
    {
         $this->currentTab = 4;
    }
    public function updatedTo()
    {
         $this->currentTab = 4;
    }

    public function updatedFrom()
    {
         $this->currentTab = 4;
    }

    public function updatedTime_limit()
    {
        $this->currentTab = 4;
    }

    // public function updated()
    // {
    //      $this->levels;
    //      $this->subjects;
    //      $this->currentTab = 4;
    // }





    public function updateSchedule()
    {
         $validatedData = $this->validate([
             'subjects' => 'required',
             'levels'=> 'required',
 
             'day.0'=> 'required',
             'time_limit.0'=> 'required',
             'from.0'=> 'required',
             'to.0'=> 'required',
             'day.*'=> 'required',
             'time_limit.*'=> 'required',
             'from.*'=> 'required',
             'to.*'=> 'required',
         ],
         [
             'day.0.required' => 'day field is required',
             'time_limit.0.required' => 'booking time limit field is required',
             'from.0.required' => 'time From field is required',
             'to.0.required' => 'time To field is required',
             'day.*.required' => 'day field is required',
             'time_limit.*.required' => 'booking time limit field is required',
             'from.*.required' => 'time from field is required',
             'to.*.required' => 'time to field is required',
         ]);
 
             $id = session()->get('id');
             Subjects::where('user_id',$id)->update(['levels'=>json_encode($this->levels),
                                                      'title'=>json_encode($this->subjects),
                                                    ]);
             
                                                
 
             foreach ($this->schedules_infos as $key3 => $schedule) 
             {
                //  first approach
                // $f = date('H:', strtotime($this->from[$key3]));
                // $t = date('H:',strtotime($this->to[$key3]));
                // $cf = strval($f).'00';
                // $ct = strval($t).'00';
                //  $days_split = array();
                //  $time_from = strtotime($cf); 
                //  $time_to = strtotime($ct);
                //  $addMins = 60 * 60;
                //  while($time_from <= $time_to)
                //  {
                //      $days_split[] = date("G:i",$time_from);
                //      $time_from += $addMins;
                //  }
                //    dd($days_split);

                // second approach
                $schedule_id =  $this->schedule_id[$key3];
                Schedule::where('id',$schedule_id)->update(['day'=>$this->day[$key3],
                                                            'from'=>$this->from[$key3],
                                                            'to'=>$this->to[$key3],
                                                          ]);

                $times = Schedule::where('id',$schedule_id)->with('user')->first();
                $converted_from = substr_replace($times->from, "00:00", -5);
                $converted_to = substr_replace($times->to, "00:00", -5);
                // check if time not same
                $check_time[] = abs(strtotime($converted_from) - strtotime($converted_to))/3600;
                // dd($check_time[$key3]);
               if($check_time[$key3] == 0)
               {
                  \Session::forget('message');
                  $this->successMsg = session()->flash('error','Schedule time "From" and "To" cannot be same!');
                  $this->emit('alert_remove');
                  $this->tab_name = session()->flash('tab_pane','schedule'); 
                  break;
                }
               else
               {
                    $days_split = array();
                    $time_from = strtotime($converted_from); 
                    $time_to = strtotime($converted_to);
                    $addMins = 60 * 60;
                    while($time_from <= $time_to)
                    {
                        $days_split[] = date("G:i",$time_from);
                        $time_from += $addMins;
                    }
                    
                    //$this->time_split = $days_split;
                    Schedule::where('id',$schedule_id)->update([
                                                                'from'=>$converted_from,
                                                                'to'=>$converted_to,
                                                                'time_split'=>json_encode($days_split),
                                                                'time_limit'=>$this->time_limit[$key3],
                                                                ]);

               

                        $this->successMsg = session()->flash('message','Schedule Information Saved.');
                        $this->emit('alert_remove');
                        $this->tab_name = session()->flash('tab_pane','schedule');  
               }

              
                   
             }

 
            
 
    }
 
    public function moreSchedule()
    {
         $validatedData = $this->validate([
             'subjects' =>'required',
             'levels'=>'required',
 
             'more_day.0'=> 'required',
             'more_time_limit.0'=> 'required',
             'more_from.0'=> 'required',
             'more_to.0'=> 'required',
             'more_day.*'=> 'required',
             'more_time_limit.*'=> 'required',
             'more_from.*'=> 'required',
             'more_to.*'=> 'required',
         ],
         [
             'more_day.0.required' => 'day field is required',
             'more_time_limit.0.required' => 'booking time limit field is required',
             'more_from.0.required' => 'time From field is required',
             'more_to.0.required' => 'time To field is required',
             'more_day.*.required' => 'day field is required',
             'more_time_limit.*.required' => 'booking time limit field is required',
             'more_from.*.required' => 'time from field is required',
             'more_to.*.required' => 'time to field is required',
         ]);
 
 
 
         $id = session()->get('id');
         $schedule_array = $this->schedules_infos->count();
         Subjects::where('user_id',$id)->update(['levels'=>json_encode($this->levels),
                                                  'title'=>json_encode($this->subjects),
                                                ]);
 
         foreach($this->more_day as $key => $day) 
         {
 
            if(!empty($this->more_from[$key]) && !empty($this->more_to[$key]) && !empty($this->more_time_limit[$key]))
            {

                $time_from = date('H:', strtotime($this->more_from[$key]));
                $time_to = date('H:',strtotime($this->more_to[$key]));
                $convert_time_from = strval($time_from).'00';
                $convert_time_to = strval($time_to).'00';

                    $days_split = array();
                    $time_from =strtotime($convert_time_from); 
                    $time_to =strtotime($convert_time_to);
                    $addMins = 60 * 60;
                    while($time_from <= $time_to)
                    {
                        $days_split[] = date("G:i",$time_from);
                        $time_from += $addMins;
                    }

                    $this->more_time_split = $days_split;

                    $dayExist = Schedule::where(['user_id'=>$id,'day'=>$day])->with('user')->first();
                
                if($dayExist)
                {
                    Schedule::where(['id'=>$dayExist->id])->update([
                                                                    'day'=>$day,
                                                                    'from'=>$convert_time_from,
                                                                    'to'=>$convert_time_to,
                                                                    'time_split'=>json_encode($days_split),
                                                                    'time_limit'=>$this->more_time_limit[$key],          
                                                                    ]);
                }
                else
                {
                    Schedule::create(['day'=>$day,
                                    'from'=>$convert_time_from,
                                    'to'=>$convert_time_to,
                                    'user_id'=>$id,
                                    'time_split'=>json_encode($days_split),
                                    'time_limit'=>$this->more_time_limit[$key],
                                    ]);

                }

                $this->remove($key);
            
            }
           
                    
                   
                
            
 
         }
 
         $this->resetSchedule();
         $this->successMsg = session()->flash('success','Schedule Information Saved.');
         $this->emit('alert_remove');
         $this->tab_name = session()->flash('tab_pane','schedule');  
         return redirect('teachers/settings');

 
    }
 
    public function resetSchedule()
    {
     $this->more_day= '';
     $this->more_to = '';
     $this->more_from = '';
     $this->more_time_limit = '';
     
    }

 
}
