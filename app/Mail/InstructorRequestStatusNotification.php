<?php

namespace App\Mail;

use App\Models\InstructorRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstructorRequestStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public InstructorRequest $instructorRequest)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Response to your Instructor Request - LMS',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.instructor-request-status',
        );
    }
}
