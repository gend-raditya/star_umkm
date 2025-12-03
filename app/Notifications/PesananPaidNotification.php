<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PesananPaidNotification extends Notification
{
    use Queueable;

    public $pesanan;

    /**
     * Create a new notification instance.
     */
    public function __construct($pesanan)
    {
        $this->pesanan = $pesanan;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Pesanan #{$this->pesanan->id} telah dibayar!",
            'pesanan_id' => $this->pesanan->id,
            'total'       => $this->pesanan->total,
        ];
    }
}
