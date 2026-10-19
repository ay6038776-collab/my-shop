<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'total_price',
        'status',
        'notes',
        'expires_at',
        'is_expired',
        'payment_method',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_expired' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {

            // توليد رقم الطلب تلقائيًا
            if (empty($order->order_number)) {
                $order->order_number = uniqid('ORD-');
            }

            // السعر الافتراضي
            if (is_null($order->total_price)) {
                $order->total_price = 0;
            }

            // الحالة الافتراضية
            if (empty($order->status)) {
                $order->status = 'pending';
            }

            // تاريخ الانتهاء (7 أيام افتراضيًا)
            if (is_null($order->expires_at)) {
                $order->expires_at = Carbon::now()->addDays(7);
            }

            // لسه مش منتهي
            $order->is_expired = false;
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalPrice()
    {
        return number_format($this->total_price, 0);
    }
}