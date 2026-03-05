<?php

namespace App\Mail;

use App\Models\Setting;
use App\Models\Shop\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public string $oldStatus,
        public string $newStatus,
    ) {}

    public function envelope(): Envelope
    {
        $siteName = Setting::get('site_name', 'Parosis Akademi');
        $statusLabel = Order::STATUS_LABELS[$this->newStatus] ?? $this->newStatus;

        return new Envelope(
            subject: "Sipariş Durumu Güncellendi: {$statusLabel} — #{$this->order->order_number}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-status',
            with: [
                'siteName'   => Setting::get('site_name', 'Parosis Akademi'),
                'statusLabel' => Order::STATUS_LABELS[$this->newStatus] ?? $this->newStatus,
                'oldStatusLabel' => Order::STATUS_LABELS[$this->oldStatus] ?? $this->oldStatus,
            ],
        );
    }
}
