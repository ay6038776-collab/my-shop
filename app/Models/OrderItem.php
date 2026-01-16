<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'color'];

    // 🔹 العلاقة مع جدول الطلبات
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 🔹 العلاقة مع جدول المنتجات
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Accessor: ترجمة اللون العربي/إنجليزي إلى CSS color صالح
     */
    public function getColorClassAttribute()
    {
        $color = trim(strtolower($this->color ?? ''));

        $map = [
            'أسود' => 'black',
            'أحمر' => 'red',
            'أزرق' => 'blue',
            'أخضر' => 'green',
            'أصفر' => 'yellow',
            'أبيض' => 'white',
            'وردي' => 'pink',
            'زهري' => 'pink',
            'بنفسجي' => 'purple',
            'برتقالي' => 'orange',
            'رمادي' => 'gray',
            'بني' => 'brown',
            'كحلي' => 'navy',
            'تركواز' => 'turquoise',
            'لافندر' => 'lavender',
            'زيتي' => 'olive',
            'فضي' => 'silver',
            'ذهبي' => 'gold',
            'بيج' => 'beige',
            'عنابي' => 'maroon',
            'كريمي' => 'cream',
            'فيروزي' => 'turquoise',
            'نيلي' => 'indigo',
            'كهرماني' => 'amber',

            // الألوان الإنجليزية
            'black' => 'black',
            'red' => 'red',
            'blue' => 'blue',
            'green' => 'green',
            'yellow' => 'yellow',
            'white' => 'white',
        ];

        return $map[$color] ?? 'null';
    }
}