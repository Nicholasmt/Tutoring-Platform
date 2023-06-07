<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Models\Users;
use App\Models\ZoomMeeting;
use App\Mail\Bookings;
use App\Mail\WelcomeNote;
use App\Mail\BookResponse;
use App\Mail\ClassEvents;
use App\Mail\PasswordReset;
 
use Illuminate\Support\Facades\Mail;

class MailNofications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $data;
    
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct($data=[])
    {

       $this->data = $data;
     
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      
      if(!empty($this->data))
      {
            // bookings mail
            if($this->data['mail'] == 'booking')
            {
                // dd('booking');
                $booked = Booking::where('id',$this->data['booking_id'])->first();
                $teacher_user  = Users::where(['id'=>$this->data['teacher_id']])->first();
                $student_user  = Users::where(['id'=>$this->data['student_id']])->first();
                Mail::to($teacher_user->email)->send(new Bookings($teacher_user,$booked));
                Mail::to($student_user->email)->send(new Bookings($student_user,$booked));
            }

            //welcome onboard mail
            if(($this->data['mail'] == 'welcome_onboard'))
            {
                // dd('welcome onboard');
                $id = $this->data['user_id'];
                $user = Users::find($id);
                Mail::to($user->email)->send(new WelcomeNote($user));
            }

            // responses mail
            if($this->data['mail'] == 'response')
            {
                // dd('response');
                //accepted booking
               if($this->data['response'] == 1)
                {       
                    $response = 1;
                    $booking = Booking::where('id',$this->data['response'])->first();
                    $teacher_user  = Users::where(['id'=>$booking->teacher_booked])->first();
                    $student_user  = Users::where(['id'=>$booking->booked_by])->first();
                    Mail::to($teacher_user->email)->send(new BookResponse($teacher_user,$booking,$response));
                    Mail::to($student_user->email)->send(new BookResponse($student_user,$booking,$response));
                }
            
                //declined booking
                if($this->data['response'] == 2)
                {    
                    $response = 2;
                    $booking = Booking::where('id',$this->data['response'])->first();
                    $teacher_user  = Users::where(['id'=>$booking->teacher_booked])->first();
                    $student_user  = Users::where(['id'=>$booking->booked_by])->first();
                    Mail::to($teacher_user->email)->send(new BookResponse($teacher_user,$booking,$response));
                    Mail::to($student_user->email)->send(new BookResponse($student_user,$booking,$response));
                }
            }

            //class events mails
            if($this->data['mail'] == 'events')
            {    
                // dd('started');
                if($this->data['events'] == 'started')
                {
                    $events = 1;
                    $class_session = ZoomMeeting::where('id',$this->data['meeting_id'])->first();
                    $teacher_user  = Users::where(['id'=>$class_session->booking->teacher_booked])->first();
                    $student_user  = Users::where(['id'=>$class_session->booking->booked_by])->first();
                    Mail::to($student_user->email)->send(new ClassEvents($student_user,$class_session,$events));
                    Mail::to($teacher_user->email)->send(new ClassEvents($teacher_user,$class_session,$events));
                }
                //ended
                if($this->data['events'] == 'ended')
                {
                    $events = 2;
                    $class_session = ZoomMeeting::where('id',$this->data['meeting_id'])->first();
                    $teacher_user  = Users::where(['id'=>$class_session->booking->teacher_booked])->first();
                    $student_user  = Users::where(['id'=>$class_session->booking->booked_by])->first();
                    Mail::to($student_user->email)->send(new ClassEvents($student_user,$class_session,$events));
                    Mail::to($teacher_user->email)->send(new ClassEvents($teacher_user,$class_session,$events));

                }


            }

            if($this->data['mail'] == 'password_reset')
            {
                $user = Users::where('id',$this->data['user_id'])->with('role')->first();
                Mail::to($user->email)->send(new PasswordReset($user));
            }

      }

    }

    
}
