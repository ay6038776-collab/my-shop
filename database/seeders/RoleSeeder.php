<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Employee;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles with permissions
        $owner = Role::create([
            'name' => 'Owner',
            'slug' => 'owner',
            'description' => 'مالك المتجر - صلاحيات كاملة',
            'permissions' => ['*'], // All permissions
        ]);

        $supervisor = Role::create([
            'name' => 'Supervisor',
            'slug' => 'supervisor',
            'description' => 'مشرف - صلاحيات إدارة معتدلة',
            'permissions' => [
                'manage-products',
                'manage-orders',
                'view-reports',
                'manage-customers',
                'view-videos',
            ],
        ]);

        $employee = Role::create([
            'name' => 'Employee',
            'slug' => 'employee',
            'description' => 'موظف - صلاحيات محدودة',
            'permissions' => [
                'view-orders',
                'update-order-status',
                'view-customers',
            ],
        ]);

        // Create default owner (if not exists)
        if (!Employee::where('email', 'owner@myshop.com')->first()) {
            $ownerEmployee = Employee::create([
                'name' => 'Store Owner',
                'email' => 'owner@myshop.com',
                'password' => 'owner123',
                'is_active' => true,
            ]);
            $ownerEmployee->roles()->attach($owner);
        }
    }
}
