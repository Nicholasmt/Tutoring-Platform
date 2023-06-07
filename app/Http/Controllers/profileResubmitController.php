<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Cerification;
use App\Models\Education;
use App\Models\ProfessionalInformation;
use App\Models\PersonalInformation;


class profileResubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        $certifications = Cerification::where('user_id',$id)->with('user')->get();
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $educations = Education::where('user_id',$id)->with('user')->get();
        // $categories = Category::all();
        return view('teachers.settings.index',compact('user','certifications','pro_infos','personal_infos','educations'));
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
        Users::where('id',$request->id)->update(['verify_ready'=>1,'is_verified'=>0]);
        return redirect('redirect')->with('success','Account has been Resubmitted for verification!');
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
