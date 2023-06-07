<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ZoomMeeting;
use App\Models\Users;

class ClassEvents extends Mailable
{
    use Queueable, SerializesModels;
    public $teacher_user,$student_user,$class_session,$events;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Users $user,ZoomMeeting $class_session,$events)
    {
        $this->teacher_user  = $user;
        $this->student_user  = $user;
        $this->class_session = $class_session;
        $this->events = $events;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
      
           return new Envelope(
               subject: 'Class Events',
           );
       

    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // start event
        if($this->events == 1)
        {
            if($this->teacher_user->role_id == 2)
            {
                return new Content(
                    view: 'emails.class-events.start.teacher',
                );
            }
    
            if($this->student_user->role_id == 3)
            {
                return new Content(
                    view: 'emails.class-events.start.student',
                );
            }
            
        }
        // end event
        if($this->events == 2)
        {

                if($this->teacher_user->role_id == 2)
                {
                    return new Content(
                        view: 'emails.class-events.end.teacher',
                    );
                }
        
                if($this->student_user->role_id == 3)
                {
                    return new Content(
                        view: 'emails.class-events.end.student',
                    );
                }

        }
        

    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
