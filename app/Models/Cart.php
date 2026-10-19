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
            'كريمي' => '#FFFDD0', // Cream
            'فيروزي' => 'turquoise',
            'نيلي' => 'indigo',
            'لافندر' => 'lavender',
            'كهرماني' => '#FFBF00', // Amber


            
           
            // الألوان الإنجليزية
            'black' => 'black',
            'red' => 'red',
            'blue' => 'blue',
            'green' => 'green',
            'yellow' => 'yellow',
            'white' => 'white',
            'pink' => 'pink',
            'purple' => 'purple',
            'orange' => 'orange',
            'gray' => 'gray',
            'brown' => 'brown',
            'navy' => 'navy',
            'teal' => 'teal', 
            'lavender' => 'lavender',
            'olive' => 'olive',
            'silver' => 'silver',
            'gold' => 'gold',
            'beige' => 'beige',
            'maroon' => 'maroon',
            'cream' => '#FFFDD0', // Cream
            'turquoise' => 'turquoise',
            'indigo' => 'indigo',
            'amber' => '#FFBF00', // Amber


        ];

        return $map[$color] ?? 'transparent';
    }
}