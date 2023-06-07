<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Users;
use App\Models\Booking;

class BookResponse extends Mailable
{
    use Queueable, SerializesModels;
    public $teacher_user,$student_user,$booking,$response;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Users $user,Booking $booking,$response)
    {
        $this->student_user = $user;
        $this->teacher_user = $user;
        $this->booking = $booking;
        $this->response = $response;
      
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Booking Response',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

      // booking accepted
      if($this->response == 1)
      {
          if($this->student_user->role_id == 3)
          {
              return new Content(
                  view: 'emails.book-response.accepted.student',
              );
          }
          if($this->teacher_user->role_id == 2)
          {
              return new Content(
                  view: 'emails.book-response.accepted.teacher',
              );
          }

      }
      //booking delined
      if($this->response == 2)
      {
          if($this->student_user->role_id == 3)
          {
              return new Content(
                  view: 'emails.book-response.decline.student',
              );
          }
          if($this->teacher_user->role_id == 2)
          {
              return new Content(
                  view: 'emails.book-response.decline.teacher',
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
