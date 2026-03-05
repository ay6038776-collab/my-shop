<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // تقييمات المستخدم
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // صلاحيات / أدوار الموظف
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // ساعات الشغل
    public function workShifts()
    {
        return $this->hasMany(WorkShift::class);
    }

    // الطلبات اللي تعامل معها الموظف
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}