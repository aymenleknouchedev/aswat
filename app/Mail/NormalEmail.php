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
    protected array $files;

    public function __construct(MailModel $mail, array $files = [])
    {
        $this->mail = $mail;
        $this->files = $files;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mail->subject,
            from: 'contact@asswatdjazairia.com',
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
                'files' => $this->files,
            ],
        );
    }
}
