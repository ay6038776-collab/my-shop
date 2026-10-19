<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderApproved extends Notification
{
    use Queueable;
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "تم اعتماد الطلب رقم #{$this->order->order_number}",
            'icon' => 'fa-solid fa-circle-check',
            'icon_color' => '#10b981',
            'link' => route('admin.orders.index'),
            'order_id' => $this->order->id,
        ];
    }
}
