<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Jobs\MailNofications;


class AuthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    public function choose_profile()
    {
        return view('auths.choose-profile');
    }

    public function parent_signup()
    {
        return view('auths.parents.sign-up');
    }

    public function policy(){
      return view('auths.privacy-policy');
    }

    public function terms()
    {
        return view('auths.terms-of-service');
    }

    public function forgot_password()
    {
        return view('auths.password-reset.forgot-password');
    }

    public function reset_password($email)
    {
        $user = Users::where('email',$email)->first();
        return view('auths.password-reset.reset',compact('user'));
    }

    public function password_changed()
    {
        return view('auths.password-reset.success');
    }

    public function teachers_signup()
    {
        $check_users = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();
        if($check_users->count() <= 5)
        {
            $users = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();
        }
        elseif($check_users->count() > 5)
        {
            $users = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get()->random(5);
        }
       
        return view('auths.teachers.sign-up',compact('users'));
    }

    public function signin()
    { 
        return view('auths.sign-in');
    }

    public function teachers_form()
    {
        return view('auths.teachers.form-preview');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->chosen_profile == 2)
        {
            return redirect('sign-up-teacher');
        }
        elseif($request->chosen_profile == 3)
        {
            return redirect('sign-up-student');
        }
    }

    public function logout(Request $request)
    {
      if(session()->get('privilege') == 2 || session()->get('privilege') == 3)
      {
        $request->session()->invalidate();
        return redirect('/sign-in');
      }
      elseif(session()->get('privilege') == 1)
      {
        $request->session()->invalidate();
        return redirect('/super');
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

    public function reset(Request $request)
    {

        if($request->has('reset'))
        {
            $rules=['new_password'=>'required',
                     'confirm_password'=>'required|same:new_password',
                   ];
            $validate = \Validator::make($request->all(),$rules);
            if($validate->fails())
            {
                return back()->withErrors($validate->errors());
            }
            else
            {
                Users::where('id',$request->user_id)->update(['password'=>\Hash::make($request->confirm_password)]);
                return redirect('password/changed');
            }
            
        }

        if($request->has('request_reset'))
        {
            $user = Users::where('email',$request->email)->with('role')->first();
            if($user)
            {
                $data = ['mail'=>'password_reset',
                         'user_id'=>$user->id,
                       ];

                MailNofications::dispatchSync($data);
                return back()->with('success','Mail sent, check your inbox');

            }
            else
            {
               return back()->with('error','Users does not exist');

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
