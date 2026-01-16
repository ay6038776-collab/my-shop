<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'color'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor: ترجمة اللون العربي/إنجليزي إلى CSS color صالح
     */
    public function getColorClassAttribute()
    {
        $color = trim(strtolower($this->color ?? ''));

        // خريطة الألوان العربي → إنجليزي
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
            'تركواز' => 'teal',
            'لافندر' => 'lavender',
            'زيتي' => 'olive',
            'فضي' => 'silver',
            'ذهبي' => 'gold',
            'بيج' => 'beige',
            'عنابي' => 'maroon',
            'كريمي' => 'cream',
            'فيروزي' => 'turquoise',
            'نيلي' => 'indigo',
            'لافندر' => 'lavender',
            'كهرماني' => 'amber',
            
           
            // الألوان الإنجليزية
            'black' => 'black',
            'red' => 'red',
            'blue' => 'blue',
            'green' => 'green',
            'yellow' => 'yellow',
            'white' => 'white',
        ];

        return $map[$color] ?? 'transparent';
    }
}