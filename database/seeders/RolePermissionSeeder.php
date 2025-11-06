<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $perms = [
            'view dashboard','manage leads','manage employees','manage inquiries','manage quotations','manage companies','manage projects','manage performa','manage receipts','manage vouchers','manage tickets','manage attendance','manage events','manage roles','manage settings'
        ];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }
        $admin = Role::firstOrCreate(['name' => 'Super_Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo(Permission::all());

        $user = User::where('email', 'admin@hrportal.test')->first();
        if ($user) $user->assignRole($admin);
    }
}


