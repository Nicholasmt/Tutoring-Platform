<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Users;
use App\Models\Schedule;
use App\Models\Subjects;

class SearchController extends Controller
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

    public function search(Request $request)
    {

        $teachersearch = 0;
        $subjectsearch = 0;
        $scheduleSearch = 0;
        $search_results = null;
        $schedule = null;
        
        $user_id = session()->get('id');
        
        $subjects = Subjects::where(['is_verified'=>1])
                             ->where('title','like',"%{$request->search}%")
                             ->Orwhere('levels','like',"%{$request->search}%")
                             ->with('user')->get();
        
        $teachers = Users::where(['role_id'=> 2,'is_verified'=>1])
                           ->where('last_name','like',"%{$request->search}%")
                           ->Orwhere('first_name','like',"%{$request->search}%")
                           ->with('role')->get();

        if($request->search == 'Monday' || $request->search == 'monday' || $request->search == 'Tuesday' || $request->search == 'tuesday'
           || $request->search == 'Wednesday' || $request->search == 'wednesday' || $request->search == 'Thursday' ||$request->search == 'thursday'
           || $request->search == 'Friday' || $request->search == 'friday' || $request->search == 'Saturday' || $request->search == 'saturday'
           || $request->search == 'Sunday' || $request->search == 'sunday')
           {
               if($request->search == 'Monday' || $request->search == 'monday'){ $day = 1;}
               elseif($request->search == 'Tuesday' || $request->search == 'tuesday'){ $day = 2;}
               elseif($request->search == 'Wednesday' || $request->search == 'wednesday'){ $day = 3;}
               elseif($request->search == 'Thursday' ||$request->search == 'thursday'){ $day = 4;}
               elseif($request->search == 'Friday' || $request->search == 'friday'){ $day = 5;}
               elseif($request->search == 'Saturday' || $request->search == 'saturday'){ $day = 6;}
               elseif($request->search == 'Sunday' || $request->search == 'sunday'){ $day = 0;}
               $schedule = Schedule::where(['day'=>$day,'is_verified'=>1])->with('user')->get();
           }

          
        if($subjects->count() > 0)
        {
            $search_results = $subjects;
            $subjectsearch = 1;
             
        }
        elseif($teachers->count() > 0)
        {
           $search_results = $teachers;
           $teachersearch = 1;
       
        }
     
        elseif($schedule !== null)
        {
            if($schedule->count() > 0)
            {
                $search_results = $schedule;
                $scheduleSearch = 1;
            }
        }

        

        // $search_results = Booking::query();
        // if(session()->get('privilege') == 3)
        // {
        //     $teachers = Users::where('last_name','like',"%{$request->search}%")
        //                        ->where('role_id',2)
        //                        ->Orwhere('first_name','like',"%{$request->search}%")->get();
           
        //   // dd($search_results);
        //       $search_results->where('booked_by',$user_id);
        //       $search_results->where('subject','like',"%{$request->search}%")
        //                      ->orWhere('booked_times','like',"%{$request->search}%");
        //         foreach($teachers as $teacher)
        //         {
        //            $search_results->orWhere(['teacher_booked'=>$teacher->id]);
        //         }

        //      $search_results = $search_results->get();

        //   }
        
        return view('front.smart-search.index',compact('scheduleSearch','search_results','subjectsearch','teachersearch'))->render();
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
