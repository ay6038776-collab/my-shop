<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    // Predefined roles
    const OWNER = 'owner';
    const SUPERVISOR = 'supervisor';
    const EMPLOYEE = 'employee';

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_role');
    }

    // Check if role has permission
    public function hasPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions) || in_array('*', $permissions);
    }

    // Get all permissions for this role
    public function getAllPermissionsAttribute()
    {
        return $this->permissions ?? [];
    }
    
}
