<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\HR\HiringLead;
use App\Models\HR\Employee;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@hrportal.test'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );

        HiringLead::query()->upsert([
            ['code' => 'LEAD-001','name' => 'John Doe','mobile' => '9999999999','position' => 'Developer'],
            ['code' => 'LEAD-002','name' => 'Jane Smith','mobile' => '8888888888','position' => 'Designer'],
        ], ['code']);

        Employee::query()->updateOrCreate(
            ['code' => 'EMP-001'],
            [
                'first_name' => 'Dipesh',
                'last_name' => 'Vasoya',
                'email' => 'dipesh@example.com',
                'designation' => 'UI/UX Designer',
                'salary' => 55000,
                'user_id' => $admin->id,
            ]
        );

        $this->call(RolePermissionSeeder::class);
        $this->call(DemoDataSeeder::class);
    }
}
