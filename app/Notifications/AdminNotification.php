<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminNotification extends Notification
{
    use Queueable;

    public $message;

    // Nhận thông báo từ controller
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Lấy kênh thông báo mà bạn muốn gửi (mail, database, etc)
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Sử dụng kênh mail và database
        return ['database'];
    }

    /**
     * Gửi mail tới người nhận
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Thông Báo Mới Từ Quản Trị Viên')
            ->line($this->message)
            ->action('Xem Thêm', url('/'))
            ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,  // Đảm bảo message là mảng hoặc chuỗi hợp lệ
            'sender' => 'Admin',          // Người gửi
            'time' => now(),              // Thời gian gửi
        ];
    }
    
    
    
    

    public function toArray($notifiable)
    {
        return [
            'message' => 'Thông báo mới',
            'details' => 'Chi tiết thông báo cho người nhận',
        ];
    }

    /**
     * Lưu thông báo vào cơ sở dữ liệu
     *
     * @param  mixed  $notifiable
     * @return array
     */
}
