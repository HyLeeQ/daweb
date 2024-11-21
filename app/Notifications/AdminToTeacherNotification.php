<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminToTeacherNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Thông báo từ Admin')
            ->line($this->message);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,  // Đảm bảo message là mảng hoặc chuỗi hợp lệ
            'sender' => 'Admin',          // Người gửi
            'time' => now(),              // Thời gian gửi
        ];
    }
    
    
    

}
