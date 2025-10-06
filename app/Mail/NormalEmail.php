<?php

namespace App\Mail;

use App\Models\Mail as MailModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NormalEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected MailModel $mail;
    // protected array $attachments;

    public function __construct(MailModel $mail, array $attachments = [])
    {
        $this->mail = $mail;
        // $this->attachments = $attachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mail->subject,
            from: 'bouzit@example.com',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.normal',
            with: [
                'body' => $this->mail->body,
                // 'attachments' => $this->attachments,
            ],
        );
    }
}
