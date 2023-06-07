<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Rating;
use App\Models\RatedClass;
use App\Models\Recommendation;
use App\Models\ClassFeedback;

class RatingController extends Controller
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
    public function show($id)
    {
       
       $details = Booking::where('id',$id)->with('teacher','category','who_booked')->with('teacher','who_booked')->first();
       $rated = RatedClass::where(['booking_id'=>$details->id])->first();
       return view('students.my_tutors.rating.show',compact('details','rated'))->render();
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
        $rate_data =  $request->current_star_level;
        if($request->has('booking'))
        {
            // dd(1);
            $book_id = $request->booking;
        }
        else
        {
            // dd(2);
            $book_id = $id;
        }
        $details = Booking::where('id',$book_id)->with('teacher','who_booked')->first();

        if($rate_data == '1')
        {
           Rating::where('user_id',$details->teacher_booked)->increment('one_star',1);
        }
        elseif($rate_data == '2')
        {
           Rating::where('user_id',$details->teacher_booked)->increment('two_star',1);
        }
        elseif($rate_data == '3')
        {
           Rating::where('user_id',$details->teacher_booked)->increment('three_star',1);
        }
        elseif($rate_data == '4')
        {
           Rating::where('user_id',$details->teacher_booked)->increment('four_star',1);
        }
        elseif($rate_data == '5')
        {
           Rating::where('user_id',$details->teacher_booked)->increment('five_star',1);
        }
       
        $data = Rating::where('user_id',$details->teacher_booked)->first();

        $score_total =  ($data->one_star * 1 + $data->two_star * 2 + $data->three_star *3 + $data->four_star * 4 + $data->five_star *5);
        $total_response = ($data->one_star + $data->two_star + $data->three_star + $data->four_star + $data->five_star);
          
        $average = $score_total/$total_response;
                    
        //  dd($average);

        Rating::where('user_id',$details->teacher_booked)->update(['average'=>$average]);

        RatedClass::create(['student_id'=>$details->booked_by,
                            'booking_id'=>$details->id,
                           ]);

        Recommendation::create(['title'=>$request->title,
                               'message'=>$request->message,
                               'star'=>$rate_data,
                               'user_id'=>$details->booked_by,
                               'teacher_id'=>$details->teacher_booked,
                            ]);

        if($request->has('zoom'))
        {
            ClassFeedback::where('zoom_id',$request->zoom)->update(['content'=>$request->title]);
        }

        return view('students.my_tutors.rating.success',compact('data'))->render();
        
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
