<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Users;
use App\Models\PersonalInformation;
use App\Models\HourlyPay;
use App\Models\BookedDay;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Wallet;
use App\Models\MyClass;
use App\Mail\Bookings;
use Illuminate\Support\Facades\Mail;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Subjects;
use App\Models\Transaction;
use App\Models\LogCheckout;
use App\Jobs\MailNofications;
use DateTime;
use DB;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
    }

    public function bookings($id)
    {
       
         if(session()->get('authentication') == false)
         {
             return redirect('sign-in')->with('error', 'login to book a teacher');
         }
         elseif(session()->get('authentication') == true)
         {
             $user_id = session()->get('id');
             $user = Users::where('id',$user_id)->with('role')->first();
             if($user->role_id == 2)
             {
                 return back()->with('error','you must be logged in as a parent or student to book a teacher');
             }
             else
             { 
                 $categories = Category::all();
                 $schedules = Schedule::where('user_id',$id)->with('user')->get();
                 $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
                 $subjects = Subjects::where('user_id',$id)->with('user')->first();
                 $personal_info = PersonalInformation::where('user_id',$id)->with('user')->first();
                 $personal_infos = PersonalInformation::where('user_id',$user_id)->with('user')->first();
                 $teacher = Users::where('id',$id)->with('role')->first();
                 return view('front.booking.booking',compact('categories','user_id','personal_info','teacher','personal_infos','subjects','schedules','user','hourly_pay'));
              
             }
            
         }
    }

    public function schedule_date(Request $request)
    {
        $user_id = $request->teacher_id;
        $category = $request->category;
        $subject = $request->subject;
        $meetup = $request->meetup;
       

      if(session()->get('authentication') == false)
        {
            return redirect('sign-in')->with('error', 'login to book a teacher');
        }
        elseif(session()->get('authentication') == true)
        {
            $student_id = session()->get('id');
            $user = Users::find("$student_id");
           
            if($user->role_id == 2)
            {
                return back()->with('error','you must be logged in as a parent or student to book a teacher');
            }
            else
            { 
                if($user->is_verified == 1)
                {
                    $categories = Category::all();
                    $schedules = Schedule::where('user_id',$request->teacher_id)->with('user')->get();
                    $hourly_pay = HourlyPay::where('user_id',$request->teacher_id)->with('user')->first();
                    $personal_info = PersonalInformation::where('user_id',$request->teacher_id)->with('user')->first();
                    $personal_infos = PersonalInformation::where('user_id',$student_id)->with('user')->first();
                    $teacher = Users::where('id',$request->teacher_id)->with('role')->first();
                    return view('front.booking.schedule-date',compact('user_id','personal_info','meetup','category','subject','categories','teacher','personal_infos','schedules','user','hourly_pay'));
                }
                else
                {
                    $mssg = 'Please Complete Your Profile';
                    return back()->with('profile_complete',$mssg);
                }
            }

           
        }
    }

    public function booking_checkout(Request $request)
    {
            $category = $request->category;
            $subject = $request->subject;
            $meetup = $request->meetup;
            $teacher_id = $request->teacher_id;
            $times = $request->booked_times;
            $selected_dates = $request->booked_dates;
            $expectation = $request->expectations;

            $log = LogCheckout::create(['category'=>$request->category,
                                          'subject'=>$request->subject,
                                          'meetup'=>$request->meetup,
                                          'times'=>$request->booked_times,
                                          'selected_dates'=>$request->selected_dates,
                                          'student_id'=>session()->get('id'),
                                          'teacher_id'=>$request->teacher_id,
                                          'expectation'=>$request->expectations,
                                        ]);

            return redirect()->to('parents/logged-checkout/'.$log->id);
            // return view('front.booking.booking-checkout',compact('expectation','wallet','subject','total_amount','times','selected_dates','category','meetup','teacher_id','categories','teacher','user','personal_infos','personal_info','hourly_pay'));
    }


    public function logged_checkout($id)
    {
        $log = LogCheckout::where(['id'=>$id])->first();
        $category = $log->category;
        $subject = $log->subject;
        $meetup = $log->meetup;
        $teacher_id = $log->teacher_id;
        $times = $log->times;
        $selected_dates = $log->selected_dates;
        $expectation = $log->expectation;
        $categories = Category::all();
        $student_id = session()->get('id');
        $user = Users::where('id',$student_id)->with('role')->first();
        // $schedules = Schedule::where('user_id',$request->teacher_id)->get();
        $hourly_pay = HourlyPay::where('user_id',$teacher_id)->with('user')->first();
        $personal_info = PersonalInformation::where('user_id',$teacher_id)->with('user')->first();
        $personal_infos = PersonalInformation::where('user_id',$student_id)->with('user')->first();
        $teacher = Users::where('id',$teacher_id)->with('role')->first();
        $wallet = Wallet::where('user_id',$student_id)->first();
        $array_count = count(json_decode($times));
        $total_amount = $hourly_pay->amount * $array_count;
        return view('front.booking.booking-checkout',compact('expectation','wallet','subject','total_amount','times','selected_dates','category','meetup','teacher_id','categories','teacher','user','personal_infos','personal_info','hourly_pay'));

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
    
    public function confirm_class($id)
    {
          $class = Booking::where('id',$id)->with('teacher','who_booked')->first();
          Wallet::where('user_id',$class->teacher_booked)->increment('balance',$class->amount_paid);
          Booking::where('id',$class->id)->update(['completed'=>1]);
          MyClass::where('booking_id',$class->id)->update(['completed'=>1]);
          return back()->with('success','Class Completed!');
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
    public function checkout(Request $request)
    {
        $student_id = session()->get('id');
        $category = $request->category;
        $subject = $request->subject;
        $meetup = $request->meetup;
        $teacher_id = $request->id;
        $times = $request->selected;
        $selected_dates = $request->selected_dates;
        $wallet = Wallet::where('user_id',$student_id)->first();
        $hourly_pay = HourlyPay::where('user_id',$request->id)->with('user')->first();
        return view('front.booking.checkout',compact('teacher_id','category','subject','meetup','times','selected_dates','wallet','hourly_pay'))->render();
    }

    public function store_booking(Request $request)
    {  
        $teacher = PersonalInformation::where('user_id',$request->teacher_id)->with('user')->first();
        $hourly_pay = HourlyPay::where('user_id',$request->teacher_id)->with('user')->first();

       if(Session::get('token') == 'token')
       {
          // dd('data',Session::get('token'));
          Session::forget('token');
          $id = session()->get('id');
            // dd(json_decode($request->dates));
            foreach(json_decode($request->booked_dates) as $date)
            {
                $newDate = new DateTime($date);
                // $convert_date = $newDate->format('l');
                // dd($convert_date);
                // dd($request->expectations);
                if(empty($request->expectations)){ 
                    $expected = null; 
                }
                else{
                   $expected = $request->expectations;
                }
                
                
                $booking = Booking::create(['meetup'=>$request->meetup,
                                            'subject'=>$request->subject,
                                            'level'=>$request->category,
                                            'date'=>$date,
                                            'booked_by'=>$id,
                                            // 'amount_paid'=>$request->amount,
                                            'teacher_booked'=>$request->teacher_id,
                                            'expectations'=>$expected,
                                        ]);
  
                BookedDay::create(['teacher_id'=>$request->teacher_id,
                                    'day'=>$newDate->format('l'),
                                    'date'=>$date,
                                    'booking_id'=>$booking->id,
                                 ]);

                Activity::create(['type'=>'bookings',
                                   'type_id'=>$booking->id,
                                   'user_id'=>$request->teacher_id,
                                ]);
  
                foreach(json_decode($request->booked_times) as $times)
                {
                    $list = explode(',', $times);
                    
                    if($date == $list[1])
                    {
                        // dd($list[0]);
                        $update = Booking::where(['id'=>$booking->id,'date'=>$booking->date])->with('teacher','who_booked')->first();
                        if($update->booked_times !== null)
                        {
                            $remove_characters = str_replace(array('\'','"','[',']'), '', $update->booked_times);
                            // dd($remove_characters);
                             $join_string = $list[0] .','. $remove_characters;
                             $array = explode(',',$join_string);
                             $counter = count($array);
                             $amount = $hourly_pay->amount * $counter;
                             Booking::where(['id'=>$booking->id,'date'=>$booking->date])->update(['booked_times'=> json_encode($array),'amount_paid'=>$amount]);
                             BookedDay::where(['id'=>$booking->id,'date'=>$booking->date])->update(['booked_times'=> json_encode($array)]);
                        
                         }
                        else
                        {
                            Booking::where(['id'=>$booking->id,'date'=>$booking->date])->update(['booked_times'=> $list[0],'amount_paid'=>$hourly_pay->amount]);
                            BookedDay::where(['id'=>$booking->id,'date'=>$booking->date])->update(['booked_times'=>$list[0]]);
                        }
                         
  
                    }
                  
                }

                    
  
              }
 
                // send mail notifications to both users
                $data=['mail'=>'booking',
                       'booking_id'=>$booking->id,
                       'teacher_id'=>$request->teacher_id,
                       'student_id'=>session()->get('id'),
                     ];

                MailNofications::dispatchSync($data);

                // delete empty booking times
                $delete_data = Booking::whereNull('booked_times')->with('teacher','who_booked')->get();
                Booking::whereNull('booked_times')->delete();
                BookedDay::whereNull('booked_times')->delete();

                // charge user from wallet
                $booked = Booking::where('id',$booking->id)->with('teacher','who_booked')->first();
                $wallet = Wallet::where('user_id',$id)->with('user')->first();
                $new_balance = $wallet->balance - $booked->amount_paid;
                Wallet::where('user_id',$id)->update(['balance'=>$new_balance]);

                // delete logs
                LogCheckout::where('student_id',$id)->delete();
                return view('front.booking.success-modal',compact('teacher'));
       }
       else
       {
           return view('front.booking.success-modal',compact('teacher'));

       }

     }

     public function booking_requests($id)
    {
        $user_id = session()->get('id');
        if(session()->get('privilege') == 3)
        {
           Booking::where(['id'=>$id,'booked_by'=>$user_id,'accepted'=>0])->update(['seen'=>1]);
        }
        $request = Booking::where('id',$id)->with('teacher','who_booked')->first();
        $personal_info = PersonalInformation::where('user_id',$request->booked_by)->with('user')->first();
        return view('teachers.notification_modal.booking-requests',compact('request','personal_info'))->render();
    }

    public function handle_orders(Request $request)
    {
        $booking = Booking::where('id',$request->id)->with('teacher','who_booked')->first();
        // dd($booking);
        if($request->has('accept'))
        {
            // update booking status
            Booking::where('id',$request->id)->update(['accepted'=>1]);
            //log to class
            MyClass::create(['booking_id'=>$request->id,
                             'teacher_id'=>$booking->teacher_booked,
                             'date'=>$booking->date,
                            ]);
             // log activities
             Activity::create(['type'=>'bookings',
                              'type_id'=>$booking->id,
                              'user_id'=>$booking->booked_by,
                            ]);

         

            //log transaction info
            Transaction::create(['teacher'=>$request->teacher_booked,
                                'student'=>$booking->booked_by,
                                'amount'=> $booking->amount_paid,
                                'type'=>'bookings',
                                'billing_date'=>date('Y-m-d'),
                                'status'=>1,
                                'subject'=>$booking->subject,
                                'invoice'=>'#'.substr(rand(0,time()),0,3),
                            
                              ]);

            //students pay for booking from wallet
            // $wallet = Wallet::where('user_id',$booking->booked_by)->first();
            // $new_balance = $wallet->balance - $booking->amount_paid;
            // Wallet::where('user_id',$booking->booked_by)->update(['balance'=>$new_balance]);

            //send response mail with job queues
            $data = ['response'=>1,
                     'booking_id'=>$booking->id,
                     'mail'=>'response',
                    ];

            MailNofications::dispatchSync($data);

            return back()->with('success','Booking has been accpeted, enjoy the class.');

        }
        if($request->has('decline'))
        {
           // refund student
           $wallet = Wallet::where('user_id',$booking->booked_by)->with('user')->first();
           $new_balance = $wallet->balance + $booking->amount_paid;
           Wallet::where('user_id',$booking->booked_by)->update(['balance'=>$new_balance]);

           Booking::where('id',$request->id)->update(['accepted'=>2]);
           BookedDay::where('booking_id',$request->id)->delete();

           $data = ['response'=>2,
                    'booking_id'=>$booking->id,
                    'mail'=>'response',
                   ];

           MailNofications::dispatchSync($data);

           return back()->with('error','Booking has been declined!');
           
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

    public function load_calendar($id)
    {
       $schedule = Schedule::where('id',$id)->with('user')->first();
       $ids = session()->get('id');
        
       if($schedule->day == "Sunday")
       {
          $day = 0;
       }
       elseif($schedule->day == "Monday")
       {
          $day = 1;
       }
       elseif($schedule->day == "Tuseday")
       {
          $day = 2;
       }
       elseif($schedule->day == "Wednesday")
       {
          $day = 3;
       }
       elseif($schedule->day == "Thursday")
       {
          $day = 4;
       }
       elseif($schedule->day == "Friday")
       {
          $day = 5;
       }
       elseif($schedule->day == "Saturday")
       {
          $day = 6;
       }
       
       return view('front.booking.load-calendar',compact('day','schedule',))->render();

    }
    
    public function available_times(Request $request, $id)
    {
        $date = $request->date; 
        $teacher_id = $id;
        // dd($teacher_id);
        $dates = explode(',',$date[0]); 
        // dd($dates);
        $schedules = Schedule::where('user_id',$id)->with('user')->get();
        return view('front.booking.available-time',compact('schedules','dates','teacher_id'))->render();
        
    }

    public function selected_time(Request $request, $id)
    {
        
        $user_id = session()->get('id');
        $schedule = Schedule::where('id',$id)->with('user')->first();
        $times = $request->selected;
        $selected_dates = $request->selected_dates;
        $hourly_pay = HourlyPay::where('user_id',$id)->with('user')->first();
        return view('front.booking.selected-time',compact('schedule','times','hourly_pay','selected_dates'))->render();

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
