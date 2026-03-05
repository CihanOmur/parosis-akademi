<?php

namespace App\Mail;

use App\Models\Setting;
use App\Models\Shop\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
    ) {}

    public function envelope(): Envelope
    {
        $siteName = Setting::get('site_name', 'Parosis Akademi');

        return new Envelope(
            subject: "Sipariş Onayı #{$this->order->order_number} — {$siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: [
                'siteName' => Setting::get('site_name', 'Parosis Akademi'),
            ],
        );
    }
}
