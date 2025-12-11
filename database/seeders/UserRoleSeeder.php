<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing users - assign first user as admin, others as users
        $users = User::all();

        foreach ($users as $index => $user) {
            if ($index === 0) {
                // Make the first user an admin
                $user->update(['role' => 'admin']);
            } else {
                // Assign other users as regular users by default
                $user->update(['role' => 'user']);
            }
        }

        // Optionally create a manager account
        User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => bcrypt('password'),
                'role' => 'manager'
            ]
        );
    }
}
