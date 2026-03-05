<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'daily_hours',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // العلاقة مع Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role');
    }

    // تحقق من صلاحية الموظف
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
}