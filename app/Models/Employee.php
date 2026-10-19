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
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    // Roles relationship
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role');
    }

    // Get first role name
    public function getRoleNameAttribute()
    {
        return $this->roles->first()?->name ?? 'No Role';
    }

    // Check if has role
    public function hasRole($roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // Check if has any of roles
    public function hasAnyRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    // Check if employee is Owner
    public function isOwner(): bool
    {
        return $this->hasRole('owner');
    }

    // Check if employee is Supervisor
    public function isSupervisor(): bool
    {
        return $this->hasRole('supervisor');
    }

    // Check if employee can manage products
    public function canManageProducts(): bool
    {
        return $this->isOwner() || $this->hasRole('supervisor') || $this->hasPermission('manage-products');
    }

    // Check if employee can view orders
    public function canViewOrders(): bool
    {
        return $this->hasAnyRole('owner', 'supervisor', 'employee');
    }

    // Check if employee can manage employees
    public function canManageEmployees(): bool
    {
        return $this->isOwner();
    }
}
