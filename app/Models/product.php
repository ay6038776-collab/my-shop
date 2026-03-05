<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Order;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price', // السعر الأصلي
        'stock',
        'sku',
        'discount_percentage',
        'img',
        'category_id',
        'is_new',
    ];

    protected $casts = [
        'is_new' => 'boolean',
    ];

    protected $attributes = [
        'is_new' => 1,
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // السعر بعد الخصم (للعرض فقط)
    public function getDiscountedPriceAttribute()
    {
        if ($this->isOnDiscount()) {
            return round($this->price * (1 - $this->discount_percentage / 100), 2);
        }
        return $this->price;
    }

    // هل المنتج عليه خصم الآن؟
    public function isOnDiscount()
    {
        if (!$this->discount_percentage) return false;

        $start = $this->created_at;
        $end = $this->created_at->copy()->addDays(8);
        return Carbon::now()->between($start, $end);
    }
    public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating') ?? 0;
}

}