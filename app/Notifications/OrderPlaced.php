<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlaced extends Notification
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
            'message' => "طلب جديد رقم #{$this->order->order_number} — {$this->order->getTotalPrice()} EGP",
            'icon' => 'fa-solid fa-cart-shopping',
            'icon_color' => '#4f46e5',
            'link' => route('admin.orders.index'),
            'order_id' => $this->order->id,
        ];
    }
}
