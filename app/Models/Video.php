<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // الأعمدة المسموح تدخلها مرة واحدة
    protected $fillable = ['title', 'youtube_url'];
}