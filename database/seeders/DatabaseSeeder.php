<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $adminRole = Role::where('name', 'Admin')->first();
        $teamRole = Role::where('name', 'Team')->first();
        $clientRole = Role::where('name', 'Client')->first();

        // Create default users for each role (manual)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@y.in',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Team User',
            'email' => 'team@y.in',
            'password' => Hash::make('password123'),
            'role_id' => $teamRole->id,
        ]);

        User::create([
            'name' => 'Client User',
            'email' => 'client@y.in',
            'password' => Hash::make('password123'),
            'role_id' => $clientRole->id,
        ]);
    }
}
