<?php

namespace App\Mail;

use App\Models\CareerApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application_details;
    protected $viewName;
    protected $emailSubject;

    /**
     * Create a new message instance.
     *
     * @param  $application_details
     * @param string $viewName
     * @param string $emailSubject
     */
    public function __construct($application_details, $viewName = 'emails.job_application', $emailSubject = 'Job Applications: New Job Application')
    {
        $this->application_details = $application_details;
        $this->viewName = $viewName;
        $this->emailSubject = $emailSubject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject
        );
    }

    public function content(): Content
    {
        return new Content(
            view: $this->viewName,
        );
    }
}
