<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Users;
use App\Models\Cerification;
use App\Models\Education;
use App\Models\ProfessionalInformation;
use App\Models\PersonalInformation;
use App\Models\Schedule;
use App\Models\HourlyPay;
use App\Models\Subjects;
use App\Models\Recommendation;
use App\Models\Rating;
use App\Models\ProfileView;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Cookie;
 

class frontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $id =session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
    //    if(!empty(session()->get('id')))
    //    {
    //        $id =session()->get('id');
    //        $personal_infos = PersonalInformation::where('user_id',$id)->first();
    //    }
        $check = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();

        if($check->count() <= 4)
        { 
            $teachers = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();
        }
        elseif($check->count() > 4)
        {
            $teachers = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get()->random(5);
        }
         
        return view('front.index',compact('categories','teachers','personal_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function wizard()
    {
        $id = session()->get('id');
        $user = Users::where('id',$id)->with('role')->first();
        return view('forms.wizard',compact('user'));
    }

    
    public function details($id)
    {
        $categories = Category::all();
        $schedules = Schedule::where('user_id',$id)->with('user')->get();
        $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
        $subjects = Subjects::where('user_id',$id)->with('user')->first();
        $certifications = Cerification::where('user_id',$id)->with('user')->get();
        $personal_info = PersonalInformation::where('user_id',$id)->with('user')->first();
        $pro_infos = ProfessionalInformation::where('user_id',$id)->with('user')->first();
        $educations = Education::where('user_id',$id)->with('user')->get();
        $teacher = Users::where('id',$id)->with('role')->first();
        $recommendations = Recommendation::where('teacher_id',$id)->with('user')->take(3)->get();
        $rating = Rating::where(['user_id'=>$id])->first();

        if(!Cookie::has('uniqueId'))
        {
            $uniqueId  = Str::uuid(); // generate unique id for current user
            $lifetime = time() + 60 * 60 * 24 * 365; // one years
            // Cookie::queue('uniqueId', $uniqueId, $lifetime);
            Cookie::queue(Cookie::make('uniqueId', $uniqueId, $lifetime));
            ProfileView::create(['teacher_id'=>$id,
                                 'uniqueId'=>Cookie::get('uniqueId')
                                ]);
            Users::where('id',$id)->increment('view_count',1);
             
        }

        $user = ProfileView::where(['teacher_id'=>$id,'uniqueId'=>Cookie::get('uniqueId')])->first();

         if(!$user)
         {
            ProfileView::create(['teacher_id'=>$id,
                                 'uniqueId'=>Cookie::get('uniqueId')
                               ]);
           Users::where('id',$id)->increment('view_count',1);
         }
          
        
        Session::put('book_url',request()->fullUrl());

        $check = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();
        if($check->count() <= 4)
        {
            $similar_teachers = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get();
        }
        elseif($check->count() > 4)
        {
            $similar_teachers = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->get()->random(5);
        }
       
        $user_id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$user_id)->with('user')->first();
        
        return view('front.teachers-details',compact('similar_teachers','categories','personal_info','rating','recommendations','teacher','educations','pro_infos','personal_infos','certifications','subjects','schedules','hourly_pay'));
    }

    public function book($id)
    {

         $user_id = session()->get('id');
         $profile_completed = Users::where(['id'=>$user_id])->with('role')->first();
        //   dd($profile_completed);
        if(session()->get('authentication') == false)
        {
            return redirect('sign-in')->with('error', 'login to book a teacher');
        }
        elseif(session()->get('authentication') == true)
        {
            $u_id = session()->get('id');
            $user = Users::where('id',$u_id)->with('user')->fisrt();
            if($user->role_id == 2)
            {
               return back()->with('error','you must be logged in as a parent or student to book a teacher');
            }
            else
            { 
                if($profile_completed->is_verified == 1)
                {
                    $categories = Category::all();
                    $schedules = Schedule::where('user_id',$id)->with('user')->get();
                    $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
                    $subjects = Subjects::where('user_id',$id)->with('user')->first();
                    $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
                    $teacher = Users::where('id',$id)->with('role')->first();
                    return view('front.booking.book',compact('categories','teacher','personal_infos','subjects','schedules','user','hourly_pay'));
                }
                else
                {
                    return back()->with('error','Please Complete Your Profile To Continue Thank You.');

                }
                

            }

           
        }

       
        
    }

    public function explore()
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $categories = Category::all();
        $teachers = Users::where(['role_id'=>2,'is_verified'=>1])->with('role')->paginate(5);
        return view('front.find-a-tutor',compact('categories','teachers','personal_infos'));
    }

    
    public function tutor_request()
    {
        $id = session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $categories = Category::all();
        return view('front.tutor-request',compact('categories','personal_infos'));
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
