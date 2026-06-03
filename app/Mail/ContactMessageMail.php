<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
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

    public function __construct($application_details, $viewName = 'emails.contact_message', $emailSubject = 'Contact Messages: New Message')
    {
        $this->application_details = $application_details;
        $this->viewName = $viewName;
        $this->emailSubject = $emailSubject;
    }

    /**
     * Get the message envelope.
     */
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

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('documents/uploads/logo.png'))
                ->as('logo.png')
                ->withMime('image/png'),
        ];
    }
}
