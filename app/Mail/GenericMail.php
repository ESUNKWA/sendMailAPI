<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;


class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectText;
    public string $bodyText;
    public ?UploadedFile $attachment;

    public function __construct(string $subject, string $body, ?UploadedFile $attachment = null)
    {
        $this->subjectText = $subject;
        $this->bodyText = $body;
        $this->attachment = $attachment;
    }

    public function build()
    {
        $email = $this->subject($this->subjectText)
                      ->view('emails.generic')
                      ->with([
                         'title' => 'Notification Ekwatech',
                        'body' => $this->bodyText,
                        'companyName' => 'Ekwatech',
                        'logo' => 'https://www.ekwatech.com/assets/img/logo-transparent.png',
                        'buttonText' => 'Voir en ligne',
                        'buttonUrl' => 'https://smartdoc.ekwatech.com/login'
                    ]);

        if ($this->attachment) {
            $email->attach($this->attachment->getRealPath(), [
                'as' => $this->attachment->getClientOriginalName(),
                'mime' => $this->attachment->getMimeType(),
            ]);
        }

        return $email;
    }
}
