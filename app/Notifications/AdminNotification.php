<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // Đảm bảo sử dụng kênh 'database'
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'sender' => 'Admin',
            'time' => now(),
        ];
    }
}
