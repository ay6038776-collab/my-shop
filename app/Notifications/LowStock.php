<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStock extends Notification
{
    use Queueable;
    protected $product;
    protected $stock;

    public function __construct($product, $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "تحذير: المخزون منخفض لـ \"{$this->product->name}\" — باقي {$this->stock} قطعة فقط!",
            'icon' => 'fa-solid fa-triangle-exclamation',
            'icon_color' => '#f59e0b',
            'link' => route('products.edit', $this->product->id),
            'product_id' => $this->product->id,
        ];
    }
}
