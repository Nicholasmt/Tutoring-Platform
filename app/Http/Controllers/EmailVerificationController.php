<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailVerificationController extends Controller
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

    
    public function send_mail()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        // $role =  Session::get('role');
        Mail::to($user->email)->send(new EmailVerification($user));
        return redirect('email-verification')->with('success','Email Sent!');
    }
    public function email_verify()
    { 
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        if(empty($id))
        {
            return redirect('sign-in');
        }
        else
        {
           if($user->email_verify == 1)
            {
               return redirect('sign-in')->with('success','Email verified, Sign-in to your account'); 
            }
            else
            {
                return view('auths.email-verify');
            }
        }

     }

    public function confirm_email($id)
    {
        Users::where('id',$id)->update(['email_verify'=>1]);
        $user = Users::where('id',$id)->with('user')->first();
        if($user->role_id == 2)
        {
            session()->put('id',$user->id);
            session()->put('email',$user->email);
            session()->put('privilege',$user->role_id);
            session()->put('authentication',true);
            // if($user->verify_ready == 1 || $user->verify_ready == 2)
            // {
            //     return redirect('redirect')->with('success','Email verified!');
            // }
            // else
            // {
                return redirect()->route('teachers-step-wizard')->with('success','Email verified, Continue with onboarding process.');
            // }
        }
        elseif($user->role_id == 3)
        {
             session()->put('id',$user->id);
             session()->put('email',$user->email);
             session()->put('privilege',$user->role_id);
             session()->put('authentication',true);
            return redirect('sign-in')->with('success','Email verified, Sign-in to your account'); 
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
