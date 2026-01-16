<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderExpired extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // أو ['mail', 'database'] لو عايز بريد + Notification
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "الأوردر رقم {$this->order->order_number} انتهت مدته",
            'order_id' => $this->order->id,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('الأوردر انتهت مدته')
                    ->line("الأوردر رقم {$this->order->order_number} انتهت مدته.")
                    ->action('عرض الأوردر', url("/admin/orders/{$this->order->id}"));
    }
}
