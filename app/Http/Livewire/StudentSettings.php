<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Users;
use App\Models\PersonalInformation;
use App\Models\Notification;
use App\Models\State;
use App\Models\Country;
use App\Jobs\MailNofications;

class StudentSettings extends Component
{
    use WithFileUploads;
    public $user,$notifications,$personal_infos,$successMsg,$tab_name;
    public $no_push,$send_as_email,$everything,$offers,$message,$activities;
    public $first_name,$last_name,$country,$phone,$address,$town,$state,$profile_photo,$email,$gender;
    public $confirm_password,$new_password,$current_password;
    public $countries, $states, $show_selected = 0,$update_state;
     
    protected $rules =
         [
        'first_name'=>'required',
         'last_name'=>'required',
         'country'=>'required',
         'phone'=>'required',
         'address'=>'required',
         'town'=>'required',
         'state'=>'required',
        ];
       
    public function hydrate()
    {
        $this->emit('loadcountry');
        $this->emit('loadState');
    }

    public function mount()
    {
        $id = session()->get('id');
        $this->notifications = Notification::where('user_id',$id)->with('user')->first();
        $this->personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $this->countries = Country::all();

        $this->user = Users::with('role')->find("$id");
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
        $this->gender = $this->personal_infos->gender;
        $this->phone = $this->personal_infos->phone;
        $this->town = $this->personal_infos->town;
        $this->email = $this->user->email;
        $country = State::where('name', 'LIKE', '%'.$this->state.'%')->first();
        // dd($country->country_id);
        $this->update_state = State::where('country_id',$country->country_id)->with('country')->get();

         
    }

    public function render()
    {
        if($this->country)
        {
            $country = Country::where('name','like', "%{$this->country}%")->first();
            $this->states = State::where(['country_id'=> $country->id])->with('country')->get();
            // dd($this->states);
        }

       return view('livewire.student-settings');
    }

    public function show_states()
    {
         $country = Country::where('name','like', "%{$this->country}%")->first();
         $this->states = State::where(['country_id'=> $country->id])->with('country')->get();
        //  dd($this->states);
    }

    public function passwordUpdate($id)
    {

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

    public function updateNotification($id)
    {

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
    public function Personal_info($id)
    {
         $this->validate(['first_name'=>'required',
                            'last_name'=>'required',
                            'country'=>'required',
                            'phone'=>'required',
                            'address'=>'required',
                            'town'=>'required',
                            'state'=>'required',
                            'profile_photo'=>'required|max:5120',
                            'gender'=>'required',
                        ]);
                                        

        $photo =  $this->profile_photo->storeAs('imgs/profile', substr(rand(0,time()),0,5).'.png');
        Users::where('id',$id)->update(['first_name'=> $this->first_name,
                                        'last_name'=>$this->last_name,
                                        'is_verified'=>1,
                                        ]);
        
        PersonalInformation::where('user_id',$id)->update(['address'=>$this->address,
                                                            'town'=>$this->town,
                                                            'state'=>$this->state,
                                                            'country'=>$this->country,
                                                            'phone'=>$this->phone,
                                                            'gender'=>$this->gender,
                                                            'profile_photo'=>'storage/app/'.$photo,
                                                        ]);

         $saved_info = PersonalInformation::where('user_id',$id)->with('user')->first();
         session()->put('photo',$saved_info->profile_photo);

        $this->successMsg = session()->flash('message','Personal Information Saved.');
        $this->tab_name = session()->flash('tab_pane','Mydetails');
        $this->emit('alert_remove');

         //send mail
         $data=['mail'=>'welcome_onboard',
                'user_id'=>$id,
               ];
        //dd($new_user);
         MailNofications::dispatchSync($data);

        return redirect('parents/dashboard')->with('profile_complted','1');

    }

    public function updatePersonal_info($id)
    {

       $this->validate();
 
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
                                           'gender'=>$this->gender,
                                        ]);
  
        $this->successMsg = session()->flash('message','Personal Information Updated.');
        $this->tab_name = session()->flash('tab_pane','Mydetails');
        $this->emit('alert_remove');

    }
    
}
