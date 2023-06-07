<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\ProfessionalInformation;
use App\Models\PersonalInformation;
use App\Models\Schedule;
use App\Models\HourlyPay;
use App\Models\Subjects;
use App\Models\Category;
 

class PageFlitersController extends Controller
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
    public function show($model,$search)
    {
       $categories = Category::all();
        $user_id =session()->get('id');
        $personal_infos = PersonalInformation::where('user_id',$user_id)->with('user')->first();
        if($model == 'hp')
        {
            $teachers = HourlyPay::where('amount', $search)->with('user')->paginate(5);
        } 
         elseif($model == 'cat')
         {
            $teachers = Subjects::where('category_id',$search)->with('user')->paginate(5);
         }
         elseif($model == 'town')
         {
            $teachers = PersonalInformation::where('town','like', "%{$search}%")->whereNotNull('means_of_ID')->with('user')->paginate(5);
         }
         elseif($model == 'state')
         {
            $teachers = PersonalInformation::where('state','like', "%{$search}%")->WhereNotNull('means_of_ID')->with('user')->paginate(5);
         }
         elseif($model == 'subject')
         {
            $teachers = Subjects::where('title','like', "%{$search}%")->with('user')->paginate(5);
                
         }
         elseif($model == 'availabile')
         {
            $teachers = Schedule::where('day',$search)->with('user')->paginate(5);
         }
         $keyword = $search;
         return view('front.fliters.show',compact('categories','teachers','personal_infos','keyword'));
    }

    public function search_subject(Request $request)
    {
        $id =session()->get('id');
        $categories = Category::all();
        $teachers = Subjects::where('title','like', '%'.$request->customword.'%')->with('user')->paginate(5);
        $personal_infos = PersonalInformation::where('user_id',$id)->with('user')->first();
        $keyword = $request->customword;
        return view('front.fliters.show',compact('categories','teachers','personal_infos','keyword'));
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

    public function advanced_fliter(Request $request)
    {
        
        if($request->has('subject'))
        {
            $keyword = $request->subject;
           if($request->subject)
           {
             $teachers = Subjects::where('title','like', "%{$request->subject}%")->with('user')->paginate(5);
           }
             elseif($request->subject == null)
            {
                $teachers = Subjects::where('is_verified',1)->with('user')->paginate(5);
            }
        }

        if($request->has('level'))
        {
            if($request->level)
            {
            //    $data = Subjects::where('category_id',$request->level)->first();
               $keyword = $request->level;
               $teachers = Subjects::where('levels','like', "%{$request->level}%")->with('user')->paginate(5);
           }
             elseif($request->level == null)
            {
              $keyword = $request->level;
              $teachers = Subjects::where('is_verified',1)->with('user')->paginate(5);
            }
        }

        if($request->has('price'))
        {
            if($request->price)
            {
                $keyword = '';
                $teachers = HourlyPay::where('amount', $request->price)->with('user')->paginate(5);
           }
             elseif($request->price == null)
            {
                $keyword = $request->price;
                $teachers = Subjects::where('is_verified',1)->with('user')->paginate(5);
            }
        }

        if($request->has('gender'))
        {
            if($request->gender)
            {
                $keyword = '';
                $teachers = PersonalInformation::where(['gender'=>$request->gender,'is_verified' => 1])->with('user')->paginate(5);
           }
             elseif($request->gender == null)
            {
                $keyword = $request->gender;
                $teachers = Subjects::where('is_verified',1)->with('user')->paginate(5);
            }
        }

        if($request->has('day'))
        {
            if($request->day)
            {
                $keyword = '';
                $teachers = Schedule::where(['day'=>$request->day,'is_verified'=>1])->with('user')->paginate(5);
           }
             elseif($request->day == null)
            {
                $keyword = $request->day;
                $teachers = Subjects::where('is_verified',1)->with('user')->paginate(5);
            }
        }

         return view('front.fliters.advanced_fliter',compact('teachers','keyword'))->render();
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
