<?php
  
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\PersonalInformation; 
use App\Models\ProfessionalInformation; 
use App\Models\Users; 
use App\Models\Schedule;
use App\Models\HourlyPay;
use App\Models\Subjects;
use App\Models\Cerification;
use App\Models\Education;
use App\Models\State;
use App\Models\Country;
use App\Models\University;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
  
class Wizard extends Component
{
    use WithFileUploads;
   
    public $currentStep;
    public $profile_photo, $gender,$d_o_b, $country,$town,$last_name,$phone,$state,$first_name,$means_of_ID,$address;
    public $onboading_video,$experience,$about;
    public $qualification = [], $certification = [], $schedule = [];
    public $amount,$subjects,$levels,$break_times = [],$days;
    public $successMsg = '',$update_state;
    public $i = 1,$back = 0,$dynamic_button = 0,$dynamic_cert = 0,$dynamic_qualify= 0,$dynamic_schedule = 0;
    public $title,$description,$issued,$certification_upload,$cert_visibility;
    public $university,$qualification_upload,$passing_year,$result,$degree,$edu_visibility;
    public $from,$to,$time_limit,$day,$time_split,$categories;
    public $personal_infos,$pro_infos,$education_infos,$cert_infos,$schedules_infos,$hourly_pay,$subjects_infos,$users_infos;
    public $countries, $states, $display_country = 0;
    public $qualification_id,$certification_id, $schedule_id;

    public $more_title,$more_description,$more_issued,$more_certification_upload,$more_cert_visibility;
    public $more_university,$more_qualification_upload,$more_passing_year,$more_result,$more_degree,$more_edu_visibility;
    public $more_from,$more_to,$more_time_limit,$more_day,$more_time_split;
    public $universtities, $array_key;

    protected $listeners = [
        'selectedlevels',
        'updateSchedule',
    ];

    protected $rules=[
            'profile_photo'=>'required|max:5120',
            'd_o_b'=>'required',
            'country'=>'required',
            'town'=>'required',
            'gender'=>'required', 
            'state'=>'required',
            'means_of_ID'=>'required',
            'address'=>'required', 
    
            'about' => 'required',
            'experience' => 'required',
            'onboading_video' => 'required',
            
            'university.0'=>'required',
            'passing_year.0'=>'required',
            'result.0'=>'required',
            'degree.0'=>'required',
            'qualification_upload.0'=>'required',
            'title.0'=>'required',
            'description.0'=>'required',
            'issued.0'=>'required',
            'certification_upload.0'=>'required',
    
            'university.*'=>'required',
            'passing_year.*'=>'required',
            'result.*'=>'required',
            'degree.*'=>'required',
            'qualification_upload.*'=>'required',
            'title.*'=>'required',
            'description.*'=>'required',
            'issued.*'=>'required',
            'certification_upload.*'=>'required',
    
             
            'subjects' => 'required',
            'levels'=> 'required',
            'day'=> 'required',
            'time_limit'=> 'required',
            'from'=> 'required',
            'to'=> 'required',
    
            // 'day.*'=> 'required',
            // 'time_limit.*'=> 'required',
            // 'from.*'=> 'required',
            // 'to.*'=> 'required',
             ];
    
           
    protected $messages=[
        'd_o_b.required' => 'D.O.B is required',
        'university.0.required' => 'university field is required',
        'passing_year.0.required' => 'passing year field is required',
        'result.0.required' => 'result field is required',
        'qualification_upload.0.required' => 'qualification file field is required',
        'title.0.required' => 'title field is required',
        'description.0.required' => 'description field is required',
        'issued.0.required' => 'issued date field is required',
        'certification_upload.0.required' => 'certification field is required',
        'degree.0.required' => 'degree field is required',

        'university.*.required' => 'university field is required',
        'passing_year.*.required' => 'dpassing year field is required',
        'result.*.required' => 'result field is required',
        'qualification_upload.*.required' => 'qualification file field is required',
        'title.*.required' => 'title field is required',
        'description.*.required' => 'description field is required',
        'issued.*.required' => 'issued date field is required',
        'certification_upload.*.required' => 'certification field is required',
        'degree.*.required' => 'degree field is required',

        // 'day.0.required' => 'day field is required',
        // 'time_limit.0.required' => 'booking time limit field is required',
        // 'from.0.required' => 'time From field is required',
        // 'to.0.required' => 'time To field is required',
        // 'day.*.required' => 'day field is required',
        // 'time_limit.*.required' => 'booking time limit field is required',
        // 'from.*.required' => 'time from field is required',
        // 'to.*.required' => 'time to field is required',
    ];

     
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($i)
    {
        $this->dynamic_button = 1;
        $this->dynamic_schedule = 1;
        $i = $i + 1;
        $this->i = $i;
        array_push($this->schedule ,$i);
    }
    public function addCertification($i)
    {
        $this->dynamic_button = 1;
        $this->dynamic_cert = 1;
        $i = $i + 1;
        $this->i = $i;
        array_push($this->certification ,$i);
    }

    public function addQualification($i)
    {
        $this->dynamic_button = 1;
        $this->dynamic_qualify = 1;
        $i = $i + 1;
        $this->i = $i;
        array_push($this->qualification ,$i);
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        if($i == null){ $this->dynamic_button = 0; $this->dynamic_schedule = 0;}
        unset($this->schedule[$i]);
    }
    public function remove_qualification($i)
    {
        if($i == null){ $this->dynamic_qualify = 0; $this->dynamic_button = 0; }
        unset($this->qualification[$i]);
    } 
    public function remove_certification($i)
    {
        if($i == null){ $this->dynamic_cert = 0; $this->dynamic_button = 0; }
        unset($this->certification[$i]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    
   
    public function hydrate(){
        $this->emit('loadSubject');
        $this->emit('MoreDays');
        $this->emit('loadLevel');
        $this->emit('loadDay');
        $this->emit('loadUniversity');
        $this->emit('loadcountry');
        $this->emit('loadMoreUniversity');
        $this->emit('loadFrontUniversity');
        $this->emit('loadFrontCountry');
    }
  
    /**
     * Write code on Method
     */

     public function render()
     {
        
         $user_id = session()->get('id');
         $this->users_infos = Users::with('role')->find($user_id);
         $this->schedules_infos = Schedule::where('user_id',$user_id)->with('user')->get();
         $this->subjects_infos = Subjects::where('user_id',$user_id)->with('user')->first();
         $this->currentStep = $this->users_infos->current_step;  
         $this->back = $this->users_infos->back_step; 
         $this->categories = Category::all();
         $this->personal_infos = PersonalInformation::where('user_id',$user_id)->with('user')->first();
         $this->pro_infos = ProfessionalInformation::where('user_id',$user_id)->with('user')->first();
         $this->education_infos = Education::where('user_id',$user_id)->with('user')->get();
         $this->cert_infos = Cerification::where('user_id',$user_id)->with('user')->get();
         $this->hourly_pay = HourlyPay::where('user_id',$user_id)->with('user')->first();
         $this->countries = Country::all();
         $this->universities = University::all();
       
          
         return view('livewire.wizard');
 
     }
 

     public function mount()
     {
        
        $user_id = session()->get('id');
        $this->personal_infos = PersonalInformation::where('user_id',$user_id)->with('user')->first();
        $this->pro_infos = ProfessionalInformation::where('user_id',$user_id)->with('user')->first();
        $this->education_infos = Education::where('user_id',$user_id)->with('user')->get();
         
       $this->cert_infos = Cerification::where('user_id',$user_id)->with('user')->get();
        $this->schedules_infos = Schedule::where('user_id',$user_id)->with('user')->get();
        $this->hourly_pay = HourlyPay::where('user_id',$user_id)->with('user')->first();
        $this->subjects_infos = Subjects::where('user_id',$user_id)->with('user')->first();
        $this->countries = Country::all();

        $this->users_infos = Users::with('role')->find($user_id);
        $this->currentStep = $this->users_infos->current_step; 
        $this->back = $this->users_infos->back_step; 

        if($this->currentStep == 1 && !empty($this->personal_infos->profile_photo))
        {  
            $this->gender = $this->personal_infos->gender;
            $this->country = $this->personal_infos->country;
            $this->state = $this->personal_infos->state;
            $this->address = $this->personal_infos->address;
            $this->town = $this->personal_infos->town;
            $this->d_o_b = $this->personal_infos->d_o_b;
            $this->profile_photo = $this->personal_infos->profile_photo;
            $this->means_of_ID = $this->personal_infos->means_of_ID;
            $the_state = State::where('name','like', "%{$this->state}%")->with('country')->first();
            $this->update_state = State::where('country_id', $the_state->country_id)->with('country')->get();
            $this->firstStep_update = 1; 
        }
             

        if($this->currentStep == 2 && !empty($this->pro_infos->about))
        {
             
            $this->about = $this->pro_infos->about;
            $this->experience = $this->pro_infos->experience;
            $this->onboading_video = $this->pro_infos->onboading_video;
            
        }

      if($this->currentStep ==  3 && $this->cert_infos->count() > 0 && $this->education_infos->count() > 0)
        {
             
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
            foreach($this->cert_infos as $certification)
            {
                $this->cert_visibility[] = $certification->visible;
                $this->issued[] = $certification->issued;
                $this->description[] = $certification->decription;
                $this->title[] = $certification->title;
                $this->certification_upload[] = $certification->upload_file;
                $this->certification_id[] = $certification->id;
                
            }
            
        }

        if($this->currentStep ==  4 && !empty($this->subjects_infos->title) && $this->schedules_infos->count() > 0)
        {
            
                $this->levels = json_decode($this->subjects_infos->levels);
                $this->subjects = json_decode($this->subjects_infos->title);
               
                foreach($this->schedules_infos as $schedule)
                {
                    $this->day[] = $schedule->day;
                    $this->from[] = $schedule->from;
                    $this->to[] = $schedule->to;
                    $this->time_limit[] = $schedule->time_limit;
                    $this->schedule_id[] = $schedule->id;
                     
                }

        }
        

         
     }

 
  
  
    /**
     * Write code on Method
     */
    public function display_state()
    {
         $country = Country::where('name','like', "%{$this->country}%")->first();
         $this->states = State::where('country_id',$country->id)->with('country')->get();
         $this->display_country = 1;
        
    }
     
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'profile_photo'=>'required|max:5120',
            'd_o_b'=>'required',
            'country'=>'required',
            'town'=>'required',
            'gender'=>'required',
            'state'=>'required',
            'means_of_ID'=>'required',
            'address'=>'required',
        ],
        ['d_o_b.required'=>'D.O.B is reqired']
      );

        $id = session()->get('id');
        $updated = PersonalInformation::where('user_id',$id)->with('user')->first();
        
        if(!is_string($this->profile_photo) || !is_string($this->means_of_ID)) 
        {   
            if(!is_string($this->profile_photo))
            {

                //remove old file
                if(file_exists($updated->profile_photo))
                {
                    unlink($updated->profile_photo);
                }
 
                $photo =  $this->profile_photo->storeAs('imgs/profile', substr(rand(0,time()),0,5).'.png');
                PersonalInformation::where('user_id',$id)
                                    ->update([  
                                            'profile_photo'=>'storage/app/'.$photo,
                                            ]);
           }
            
            if(!is_string($this->means_of_ID))
            {
                //remove old file
                if(file_exists($updated->means_of_ID))
                {
                    unlink($updated->means_of_ID);
                }

                $identification =  $this->means_of_ID->storeAs('imgs/indentity', substr(rand(0,time()),0,5).'.png');
                PersonalInformation::where('user_id',$id)
                                    ->update([ 
                                              'means_of_ID'=>'storage/app/'.$identification,
                                            ]);
                
            }

                PersonalInformation::where('user_id',$id)
                                    ->update([ 
                                            'address'=>$this->address,
                                            'town'=>$this->town,
                                            'state'=>$this->state,
                                            'country'=>$this->country,
                                            'gender'=>$this->gender,
                                            'd_o_b'=>$this->d_o_b,
                                            ]);

        }


       else 
        {
             PersonalInformation::where('user_id',$id)
                                ->update([ 
                                        'address'=>$this->address,
                                        'town'=>$this->town,
                                        'state'=>$this->state,
                                        'country'=>$this->country,
                                        'gender'=>$this->gender,
                                        'd_o_b'=>$this->d_o_b,
                                        'means_of_ID'=>$updated->means_of_ID,
                                        'profile_photo'=>$updated->profile_photo,
                                       ]);

            
        }

        
        $users = Users::with('role')->find("$id");
        //store session
        session()->put('first_name',$users->first_name);
        session()->put('last_name',$users->last_name);
        $user_info = PersonalInformation::where('user_id',$id)->with('user')->first();
        session()->put('photo',$user_info->profile_photo);
        $this->successMsg = session()->flash('message','Personal Information Saved.');
        $this->emit('alert_remove');
        Users::where('id',$id)->update(['current_step'=>2]);
        $step = Users::with('role')->find("$id");
        $this->currentStep = $step->current_step;
       
         
         if($this->currentStep == 2 && !empty($this->pro_infos->about))
         {
             $this->about = $this->pro_infos->about;
             $this->experience = $this->pro_infos->experience;
             $this->onboading_video = $this->pro_infos->onboading_video;
             
         }
         
    }
  
    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
         
        $validatedData = $this->validate([
            'about' => 'required',
            'experience' => 'required',
            'onboading_video' => 'required',
        ]);

        $id = session()->get('id');
          
        if(is_string($this->onboading_video))
        {
                ProfessionalInformation::where('user_id',$id)->update(['about'=>$this->about,
                                                'experience'=>$this->experience,
                                                'onboading_video'=>$this->pro_infos->onboading_video,
                                            ]);
        }
        else
        {
            $pro_info_exist = ProfessionalInformation::where('user_id',$id)->with('user')->first();
            
            
           if($pro_info_exist)
           {
                //remove old file
                if(file_exists($pro_info_exist->onboading_video))
                {
                    unlink($pro_info_exist->onboading_video);
                }  
                
                $video_path =  $this->onboading_video->storeAs('videos', substr(rand(0,time()),0,5).'.mp4');
                ProfessionalInformation::where('user_id',$id)->update(['about'=>$this->about,
                                                                        'experience'=>$this->experience,
                                                                        'onboading_video'=>'storage/app/'.$video_path,
                                                                      ]);
           } 
           else
           {
              $video_path =  $this->onboading_video->storeAs('videos', substr(rand(0,time()),0,5).'.mp4');
               ProfessionalInformation::create(['about'=>$this->about,
                                               'user_id'=>$id,
                                               'experience'=>$this->experience,
                                               'onboading_video'=>'storage/app/'.$video_path,
                                               ]);
    
           }
        }
      
        $this->successMsg = session()->flash('message','Professional Information Saved.');
        $this->emit('alert_remove');
        Users::where('id',$id)->update(['current_step'=>3]);
        $step = Users::with('role')->find("$id");
        $this->currentStep = $step->current_step;


        if($this->currentStep ==  3 && $this->cert_infos->count() > 0 && $this->education_infos->count() > 0)
        {
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
            foreach($this->cert_infos as $certification)
            {
                $this->cert_visibility[] = $certification->visible;
                $this->issued[] = $certification->issued;
                $this->description[] = $certification->decription;
                $this->title[] = $certification->title;
                $this->certification_upload[] = $certification->upload_file;
                $this->certification_id[] = $certification->id;
                
            }
            
        }



    }

    public function thirdStepSubmit()
    { 

        $id = session()->get('id');
        
         //    $this->validate();
           $validatedData = $this->validate([
            'university.0'=>'required',
            'passing_year.0'=>'required',
            'result.0'=>'required',
            'degree.0'=>'required',
            'qualification_upload.0'=>'required',
            'title.0'=>'required',
            'description.0'=>'required',
            'issued.0'=>'required',
            'certification_upload.0'=>'required',

            'university.*'=>'required',
            'passing_year.*'=>'required',
            'result.*'=>'required',
            'degree.*'=>'required',
            'qualification_upload.*'=>'required',
            'title.*'=>'required',
            'description.*'=>'required',
            'issued.*'=>'required',
            'certification_upload.*'=>'required',
            
            ], 
            [
                'university.0.required' => 'university field is required',
                'passing_year.0.required' => 'passing year field is required',
                'result.0.required' => 'result field is required',
                'qualification_upload.0.required' => 'qualification file field is required',
                'title.0.required' => 'title field is required',
                'description.0.required' => 'description field is required',
                'issued.0.required' => 'issued date field is required',
                'certification_upload.0.required' => 'certification field is required',
                'degree.0.required' => 'degree field is required',

                'university.*.required' => 'university field is required',
                'passing_year.*.required' => 'dpassing year field is required',
                'result.*.required' => 'result field is required',
                'qualification_upload.*.required' => 'qualification file field is required',
                'title.*.required' => 'title field is required',
                'description.*.required' => 'description field is required',
                'issued.*.required' => 'issued date field is required',
                'certification_upload.*.required' => 'certification field is required',
                'degree.*.required' => 'degree field is required',
        
            ]

           );
       
        foreach ($this->university as $key_1 => $edu) 
        {
          if(!empty($this->qualification_upload[$key_1]) && !empty($this->university[$key_1]) && !empty($this->result[$key_1]) && !empty($this->passing_year[$key_1]) && !empty($this->degree[$key_1]))
          {

                if(empty(($this->edu_visibility[$key_1]))){ $visible = 0; } elseif($this->edu_visibility[$key_1] == true) {$visible = 1;}
                $qualification_file = $this->qualification_upload[$key_1]->storeAs('files/results', substr(rand(0,time()),0,5).'.png');
                Education::updateOrCreate(['university'=>$this->university[$key_1],
                                    'degree'=>$this->degree[$key_1],
                                    'passing_year'=>$this->passing_year[$key_1],
                                    'result'=>$this->result[$key_1],
                                    'upload_file'=>'storage/app/'.$qualification_file,
                                    'user_id'=>$id,
                                    'visible'=>$visible,
                                    ]);
                if($this->dynamic_cert == 1)
                {
                    $this->remove_certification($key_1);
                }  

          }


        }
        foreach ($this->title as $key_2 => $cert) 
        {
           if(!empty($this->certification_upload[$key_2]) && !empty($this->description[$key_2] && !empty($this->issued[$key_2])))
          {

            if(empty($this->cert_visibility[$key_2])){ $visible = 0; } elseif($this->cert_visibility[$key_2] == true) {$visible = 1;}
            $certification_file = $this->certification_upload[$key_2]->storeAs('files/certificates', substr(rand(0,time()),0,5).'.png');
            Cerification::create(['title'=>$this->title[$key_2],
                                    'decription'=>$this->description[$key_2],
                                    'issued'=>$this->issued[$key_2],
                                    'upload_file'=>'storage/app/'.$certification_file,
                                    'user_id'=>$id,
                                    'visible'=>$visible,
                                ]);

               if($this->dynamic_qualify == 1)
               {
                   $this->remove_certification($key_2);
               }

           }

          }

        if($this->dynamic_qualify == 1 || $this->dynamic_cert  == 1)
        {
            $this->clearEducations();
        }

        $this->successMsg = session()->flash('message','Education Information Saved.');
        $this->emit('alert_remove');
        Users::where('id',$id)->update(['current_step'=>4]);
        $step = Users::with('role')->find("$id");
        $this->currentStep = $step->current_step;
        
        // load schedule data
       if(!empty($this->subjects_infos->title) && $this->schedules_infos->count() > 0)
       {
           return redirect('teachers/step-wizard');
       }
                
          
      
    }

    public function clearEducations()
    {
        $this->issued = '';
        $this->description = '';
        $this->title = '';
        $this->cert_visibility = '';
        $this->certification_upload = '';
        
        $this->result = '';
        $this->passing_year = '';
        $this->degree = '';
        $this->university = '';
        $this->qualification_upload ='';
        $this->edu_visibility = '';

    }

    
    public function fouthStepSubmit(Request $request)
    { 
          
          $rules=[
            'subjects' => 'required',
            'levels'=> 'required',
            'day'=> 'required',
            'time_limit.0'=> 'required',
            'from.0'=> 'required',
            'to.0'=> 'required',
             'time_limit.*'=> 'required',
            'from.*'=> 'required',
            'to.*'=> 'required',
        ];
        $message=[
            'time_limit.0.required' => 'booking time limit field is required',
            'from.0.required' => 'time From field is required',
            'to.0.required' => 'time To field is required',
            'time_limit.*.required' => 'booking time limit field is required',
            'from.*.required' => 'time from field is required',
            'to.*.required' => 'time to field is required',
        ];
      
        $this->validate($rules,$message);
          
        $id = session()->get('id');
        $starter_amount = 10000;
        foreach ($this->day as $key => $days) 
        {
            if(!empty($this->from[$key]) && !empty($this->to[$key]) && !empty($this->time_limit[$key]))
            {
                $time_from = date('H:', strtotime($this->from[$key]));
                $time_to = date('H:',strtotime($this->to[$key]));
                $convert_time_from = strval($time_from).'00';
                $convert_time_to = strval($time_to).'00';
               
                $days_split = array();
                $time_from = strtotime($convert_time_from); 
                $time_to = strtotime($convert_time_to);
                $addMins = 60 * 60;
                while($time_from <= $time_to)
                {
                    $days_split[] = date("H:i",$time_from);
                    $time_from += $addMins;
                }
               
                // $this->time_split = $days_split;
                         Schedule::create(['day'=>$days,
                                            'from'=>$convert_time_from,
                                            'to'=>$convert_time_to,
                                            'user_id'=>$id,
                                            'time_split'=>json_encode($days_split),
                                            'time_limit'=>$this->time_limit[$key],
                                         ]);
                

            }

        }       
                    Subjects::create(['levels'=>json_encode($this->levels),
                          'title'=>json_encode($this->subjects),
                          'user_id'=>$id,
                         ]);
        
                    HourlyPay::create(['user_id'=>$id,
                                        'amount'=>$starter_amount,
                                    ]);

                $this->successMsg = session()->flash('message','Schedule Information Saved.');
                $this->emit('alert_remove');
                Users::where('id',$id)->update(['current_step'=>5]);
                $step = Users::with('role')->find("$id");
                $this->currentStep = $step->current_step;

         

    }


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
             //    dd($this->levels);
             Subjects::where('user_id',$id)->update(['levels'=>json_encode($this->levels),
                                                     'title'=>json_encode($this->subjects),
                                                    ]);
            
                                               
            foreach ($this->schedules_infos as $key => $schedule) 
            {

                $time_from = date('H:', strtotime($this->from[$key]));
                $time_to = date('H:',strtotime($this->to[$key]));
                $convert_time_from = strval($time_from).'00';
                $convert_time_to = strval($time_to).'00';

                $check_time[] = abs(strtotime($convert_time_from) - strtotime($convert_time_to))/3600;

              if($check_time[$key] == 0)
              {
                 \Session::forget('message');
                 $this->successMsg = session()->flash('error','Schedule time "From" and "To" cannot be same!');
                 $this->emit('alert_remove');
                 Users::where('id',$id)->update(['current_step'=>4]);
                 $step = Users::with('role')->find("$id");
                 $this->currentStep = $step->current_step;
                 break;
              }
              else
              {

                    $schedule_id =  $this->schedule_id[$key];
                    $days_split = array();
                    $time_from =strtotime($convert_time_from); 
                    $time_to =strtotime($convert_time_to);
                    $addMins = 60 * 60;
                    while($time_from <= $time_to)
                    {
                        $days_split[] = date("G:i",$time_from);
                        $time_from += $addMins;
                    }
                    $this->time_split = $days_split;

                    
                        Schedule::where('id',$schedule_id)->update(['day'=>$this->day[$key],
                                                                    'from'=>$convert_time_from,
                                                                    'to'=>$convert_time_to,
                                                                    'time_split'=>json_encode($days_split),
                                                                    'time_limit'=>$this->time_limit[$key],
                                                                ]);

                $this->successMsg = session()->flash('message','Schedule Information Saved.');
                $this->emit('alert_remove');
                Users::where('id',$id)->update(['current_step'=>5]);
                $step = Users::with('role')->find("$id");
                $this->currentStep = $step->current_step; 
                

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

        foreach ($this->more_day as $key => $day) 
        {
            if(!empty($this->more_from[$key]) && !empty($this->more_to[$key]) && !empty($this->more_time_limit[$key]))
            {

                $time_from = date('H:', strtotime($this->more_from[$key]));
                $time_to = date('H:',strtotime($this->more_to[$key]));
                $convert_time_from = strval($time_from).'00';
                $convert_time_to = strval($time_to).'00';
                
                $days_split = array();
                $time_from =strtotime($this->more_from[$key]); 
                $time_to =strtotime($this->more_to[$key]);
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
                    Schedule::where(['id'=>$dayExist->id])->update(['day'=>$day,
                                                                    'from'=>$convert_time_from,
                                                                    'to'=>$convert_time_to,
                                                                    'user_id'=>$id,
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
        $this->successMsg = session()->flash('message','Schedule Information Saved.');
        $this->emit('alert_remove');
        Users::where('id',$id)->update(['current_step'=>5]);
        $step = Users::with('role')->find("$id");
        $this->currentStep = $step->current_step;

   }

   public function resetSchedule()
   {
    $this->more_day= '';
    $this->more_to = '';
    $this->more_from = '';
    $this->more_time_limit = '';
    
   }
  
    /**
     * Write code on Method
     */
  
  
    /**
     * Write code on Method
     */
    public function back($step)
    {
        $id = session()->get('id');
        Users::where('id',$id)->update(['current_step'=>$step,'back_step'=>$step]);
        $this->personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $this->pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $back_step = Users::with('role')->find("$id");
        $this->back = $back_step->back_step; 
        $this->currentStep = $back_step->current_step; 
        $this->education_infos = Education::where('user_id',$id)->with('user')->get();
        $this->cert_infos = Cerification::where('user_id',$id)->with('user')->get();
        $this->schedules_infos = Schedule::where('user_id',$id)->with('user')->get();
        $this->hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
        $this->subjects_infos = Subjects::where('user_id',$id)->with('user')->first();


        if($this->back == 1)
        {
            
            $this->gender = $this->personal_infos->gender;
            $this->country = $this->personal_infos->country;
            $this->state = $this->personal_infos->state;
            $this->address = $this->personal_infos->address;
            $this->town = $this->personal_infos->town;
            $this->d_o_b = $this->personal_infos->d_o_b;
            $this->profile_photo = $this->personal_infos->profile_photo;
            $this->means_of_ID = $this->personal_infos->means_of_ID;
            
            $the_state = State::where('name','like', "%{$this->state}%")->with('country')->first();
            $this->update_state = State::where('country_id', $the_state->country_id)->get();
            
        }

        if($this->back == 2)
        {
            
            $this->about = $this->pro_infos->about;
            $this->experience = $this->pro_infos->experience;
            $this->onboading_video = $this->pro_infos->onboading_video;
            
       }

       if($this->back == 3)
       {

        if(is_string($this->title) || is_string($this->more_university))
        {
            return redirect('teachers/step-wizard');
        }
        if($this->more_title !== null || $this->more_university !== null)
        {
            return redirect('teachers/step-wizard');
        }
         
        //qualification informations
           foreach($this->education_infos as $education)
           {
               $this->edu_visibility[] = $education->visible;
               $this->result[] = $education->result;
               $this->passing_year[] = $education->passing_year;
               $this->degree[] = $education->degree;
               $this->university[] = $education->university;
               $this->qualification_id[] = $education->id;
               $this->qualification_upload[] = $education->upload_file;
             
           }
           //  certification informations
           foreach($this->cert_infos as $certification)
           {
               $this->cert_visibility[] = $certification->visible;
               $this->issued[] = $certification->issued;
               $this->description[] = $certification->decription;
               $this->title[] = $certification->title;
               $this->certification_id[] = $certification->id;
               $this->certification_upload[] = $certification->upload_file;
       
           }

         
           
       }

       if($this->back == 4)
        {
                $schedules = Schedule::where('user_id',$id)->with('user')->get();
                $counter = $schedules->count();
                $seperator = ',';

                $this->levels = json_decode($this->subjects_infos->levels);
                $this->subjects = json_decode($this->subjects_infos->title);
                 foreach($this->schedules_infos as $schedule)
                    {
                        if(is_array($schedule->from))
                        {
                            $this->day[] = $schedule->day;
                            $this->from[] = $schedule->from;
                            $this->to[] = $schedule->to;
                            $this->time_limit[] = $schedule->time_limit;
                            $this->schedule_id[] = $schedule->id;
                        }
                        elseif(is_string($this->from))
                        {
                            $this->day[] = $schedule->day;
                            
                            $from_repeater = implode($seperator, array_fill(0, $counter, $schedule->from));
                            $this->from = explode(',', $from_repeater);

                            $to_repeater = implode($seperator, array_fill(0, $counter, $schedule->to));
                            $this->to = explode(',', $to_repeater);

                            $time_limit_repeater = implode($seperator, array_fill(0, $counter, $schedule->time_limit));
                            $this->time_limit = explode(',', $time_limit_repeater);

                            $schedule_id_repeater = implode($seperator, array_fill(0, $counter, $schedule->id));
                            $this->schedule_id = explode(',', $schedule_id_repeater);
                        }
                        
                   }
               
                   return redirect('teachers/step-wizard');
        }

        

    }

    
  
    /**
     * Write code on Method
     */

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

        
         foreach ($this->cert_infos as $key2 => $certification) 
         {
               $cert_id = $this->certification_id[$key2];
               $certification_info = Cerification::where('id',$cert_id)->with('user')->first();
               
             
               if(is_string($this->certification_upload[$key2]))
                {
                    // dd('er');
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
                    // dd($certification_file);
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
         $this->emit('alert_remove');
         $user_id = session()->get('id');
         Users::where('id',$user_id)->update(['current_step'=>4]);
         $step = Users::with('role')->find("$user_id");
         $this->currentStep = $step->current_step;
         $certification_info = Cerification::where('user_id',$user_id)->with('user')->get()->toArray();
         
         if($this->currentStep ==  4 && !empty($this->subjects_infos->title) && $this->schedules_infos->count() > 0)
         {
                $this->levels = json_decode($this->subjects_infos->levels);
                 $this->subjects = json_decode($this->subjects_infos->title);
                 foreach($this->schedules_infos as $schedule)
                 {
                     $this->day[] = $schedule->day;
                     $this->from[] = $schedule->from;
                     $this->to[] = $schedule->to;
                     $this->time_limit[] = $schedule->time_limit;
                     $this->schedule_id[] = $schedule->id;
                      
                 }
 
         }

         
         
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
          $this->successMsg = session()->flash('message','Education Information Saved.');
          $this->emit('alert_remove');
          Users::where('id',$id)->update(['current_step'=>4]);
          $step = Users::with('role')->find("$id");
          $this->currentStep = $step->current_step;

          if($this->currentStep ==  4 && $this->subjects_infos->title !== null && $this->schedules_infos->count() > 0)
          {
                $this->levels = json_decode($this->subjects_infos->levels);
                  $this->subjects = json_decode($this->subjects_infos->title);
                  foreach($this->schedules_infos as $schedule)
                  {
                      $this->day[] = $schedule->day;
                      $this->from[] = $schedule->from;
                      $this->to[] = $schedule->to;
                      $this->time_limit[] = $schedule->time_limit;
                      $this->schedule_id[] = $schedule->id;
                       
                  }
  

          }
        
          
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

      
}