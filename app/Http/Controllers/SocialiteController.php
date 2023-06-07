<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\PersonalInformation;
use App\Models\Rating;
use App\Models\Wallet;
use DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\Notification;

class SocialiteController extends Controller
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
 
    public function socialite(Request $request)
    {
        if($request->has('google_btn'))
        {
            Session::put('type', $request->type);
            return Socialite::driver('google')->redirect();
        }
        elseif($request->has('facebook_btn'))
        {
            Session::put('type', $request->type);
            return Socialite::driver('facebook')->redirect();
        }
       
    }

    public function facebook_callback()
    {
        if((Session::get('type')) == 'teacher')
        {
            $facebook_user = Socialite::driver('facebook')->stateless()->user();
            $facebook_user_exist = Users::where(['Oauth_id'=> $facebook_user->id, 'Oauth_type'=>'facebook'])->with('role')->first();
            if($facebook_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$facebook_user_exist->id)->with('user')->first();
               session()->put('id',$facebook_user_exist->id);
               session()->put('email',$facebook_user_exist->email);
               session()->put('first_name',$facebook_user_exist->first_name);
               session()->put('privilege',$facebook_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
            }
            else
            {
               DB::beginTransaction();
               try 
               {
                   $data=['email'=>$facebook_user->email,
                           'role_id'=>2,
                           'Oauth_id'=>$facebook_user->id,
                           'Oauth_type'=>'facebook',
                           'email_verify'=>1,
                           'password'=>\Hash::make($facebook_user->id)
                         ];
   
                    $teacher = Users::create($data);
                    session()->put('id',$teacher->id);
                    session()->put('email',$teacher->email);
                    session()->put('privilege',$teacher->role_id);
                    session()->put('authentication',true);
                   
                   PersonalInformation::create(['user_id'=>$teacher->id]);
                   Wallet::create(['user_id'=>$teacher->id]);
                   Rating::create(['user_id'=>$teacher->id]);
                   Notification::create(['user_id'=>$teacher->id]);
   
                   DB::commit();
                   return redirect()->route('teachers-step-wizard');
   
               }
               catch(\Exception $e)
               {
                   DB::rollback();
                   return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
               }
              
            }
        }
        elseif((Session::get('type')) == 'student')
        {
            $facebook_user = Socialite::driver('facebook')->stateless()->user();
            $facebook_user_exist = Users::where(['Oauth_id'=> $facebook_user->id, 'Oauth_type'=>'facebook'])->with('role')->first();
            if($facebook_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$facebook_user_exist->id)->with('user')->first();
               session()->put('id',$facebook_user_exist->id);
               session()->put('email',$facebook_user_exist->email);
               session()->put('first_name',$facebook_user_exist->first_name);
               session()->put('privilege',$facebook_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
   
            }
            else
            {
               DB::beginTransaction();
               try 
               {
                   $data=['email'=>$facebook_user->email,
                           'role_id'=>3,
                           'first_name'=>$facebook_user->name,
                           'Oauth_id'=>$facebook_user->id,
                           'Oauth_type'=>'facebook',
                           'email_verify'=>1,
                           'password'=>\Hash::make($facebook_user->id)
                       ];
   
                   $student = Users::create($data);
                   PersonalInformation::create(['user_id'=>$student->id]);
                   Wallet::create(['user_id'=>$student->id]);
                   Notification::create(['user_id'=>$student->id]);
   
                   session()->put('id',$student->id);
                   session()->put('email',$student->email);
                   session()->put('first_name',$student->first_name);
                   session()->put('privilege',$student->role_id);
                   session()->put('authentication',true);
   
                   DB::commit();
                   return redirect('redirect');
   
               }
               catch(\Exception $e)
               {
                   DB::rollback();
                   return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
               }
              
            }
        }
        elseif((Session::get('type')) == 'sign-in')
        {
            $facebook_user = Socialite::driver('facebook')->stateless()->user();
            $facebook_user_exist = Users::where(['Oauth_id'=> $facebook_user->id, 'Oauth_type'=>'facebook'])->with('role')->first();
            if($facebook_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$facebook_user_exist->id)->with('user')->first();
               session()->put('id',$facebook_user_exist->id);
               session()->put('email',$facebook_user_exist->email);
               session()->put('first_name',$facebook_user_exist->first_name);
               session()->put('privilege',$facebook_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
   
            }
            else
            {
                return redirect('choose-profile')->with('error','Create new account here');
            }
        }
    }
 
    public function google_callback()
    {
        if((Session::get('type')) == 'teacher')
        {
            $google_user = Socialite::driver('google')->stateless()->user();
            $google_user_exist = Users::where(['Oauth_id'=> $google_user->id, 'Oauth_type'=>'google'])->with('role')->first();
            if($google_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$google_user_exist->id)->with('user')->first();
               session()->put('id',$google_user_exist->id);
               session()->put('email',$google_user_exist->email);
               session()->put('first_name',$google_user_exist->first_name);
               session()->put('privilege',$google_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
   
            }
            else
            {
               DB::beginTransaction();
               try 
               {
                   $data=['email'=>$google_user->email,
                           'role_id'=>2,
                           'Oauth_id'=>$google_user->id,
                           'Oauth_type'=>'google',
                           'email_verify'=>1,
                           'password'=>\Hash::make($google_user->id)
                         ];
   
                   $teacher = Users::create($data);
                    session()->put('id',$teacher->id);
                    session()->put('email',$teacher->email);
                    session()->put('privilege',$teacher->role_id);
                    session()->put('authentication',true);
                   
                   PersonalInformation::create(['user_id'=>$teacher->id]);
                   Wallet::create(['user_id'=>$teacher->id]);
                   Rating::create(['user_id'=>$teacher->id]);
                   Notification::create(['user_id'=>$teacher->id]);
   
                   DB::commit();
                   return redirect()->route('teachers-step-wizard');
   
               }
               catch(\Exception $e)
               {
                   DB::rollback();
                   return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
               }
              
            }
        }
        elseif((Session::get('type')) == 'student')
        {
            $google_user = Socialite::driver('google')->stateless()->user();
            $google_user_exist = Users::where(['Oauth_id'=> $google_user->id, 'Oauth_type'=>'google'])->with('role')->first();
            if($google_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$google_user_exist->id)->with('user')->first();
               session()->put('id',$google_user_exist->id);
               session()->put('email',$google_user_exist->email);
               session()->put('first_name',$google_user_exist->first_name);
               session()->put('privilege',$google_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
   
            }
            else
            {
               DB::beginTransaction();
               try 
               {
                   $data=['email'=>$google_user->email,
                           'role_id'=>3,
                           'first_name'=>$google_user->name,
                           'Oauth_id'=>$google_user->id,
                           'Oauth_type'=>'google',
                           'email_verify'=>1,
                           'password'=>\Hash::make($google_user->id)
                       ];
   
                   $student = Users::create($data);
                   PersonalInformation::create(['user_id'=>$student->id]);
                   Wallet::create(['user_id'=>$student->id]);
                   Notification::create(['user_id'=>$student->id]);
   
                   session()->put('id',$student->id);
                   session()->put('email',$student->email);
                   session()->put('first_name',$student->first_name);
                   session()->put('privilege',$student->role_id);
                   session()->put('authentication',true);
   
                   DB::commit();
                   return redirect('redirect');
   
               }
               catch(\Exception $e)
               {
                   DB::rollback();
                   return back()->with('error',"Unable to complete application because : ".$e->getMessage())->withInput();
               }
              
            }
        }
        elseif((Session::get('type')) == 'sign-in')
        {
            $google_user = Socialite::driver('google')->stateless()->user();
            $google_user_exist = Users::where(['Oauth_id'=> $google_user->id, 'Oauth_type'=>'google'])->with('role')->first();
            if($google_user_exist)
            {
               $users_info = PersonalInformation::where('user_id',$google_user_exist->id)->with('user')->first();
               session()->put('id',$google_user_exist->id);
               session()->put('email',$google_user_exist->email);
               session()->put('first_name',$google_user_exist->first_name);
               session()->put('privilege',$google_user_exist->role_id);
               session()->put('photo',$users_info->profile_photo);
               session()->put('authentication',true);
               return redirect('redirect');
   
            }
            else
            {
                return redirect('choose-profile')->with('error','create new account here');
            }
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
