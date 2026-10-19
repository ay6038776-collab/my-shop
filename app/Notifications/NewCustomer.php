<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Customer;

class NewCustomer extends Notification
{
    use Queueable;
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "عميل جديد: {$this->customer->name} — {$this->customer->email}",
            'icon' => 'fa-solid fa-user-plus',
            'icon_color' => '#3b82f6',
            'link' => route('admin.index'),
            'customer_id' => $this->customer->id,
        ];
    }
}
