<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $contactName,
        public string $contactEmail,
        public string $contactMessage,
    ) {}

    public function envelope(): Envelope
    {
        $siteName = Setting::get('site_name', 'Parosis Akademi');

        return new Envelope(
            subject: "Yeni İletişim Formu — {$siteName}",
            replyTo: [$this->contactEmail],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: [
                'siteName' => Setting::get('site_name', 'Parosis Akademi'),
            ],
        );
    }
}
