<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'developer@admin.com',
                'password' => bcrypt('developeradmin98620.21!'),
                'role' => 'SuperAdmin',
                'phone' => '05393518739',
                'is_visible' => 0,
                'username' => 'superadmin',
            ]
        ];

        foreach ($users as $userData) {
            $check = \App\Models\User\User::where('email', $userData['email'])->first();
            if (!$check) {
                $user = new \App\Models\User\User();
                $user->name = $userData['name'];
                $user->email = $userData['email'];
                $user->password = $userData['password'];
                $user->phone = $userData['phone'];
                $user->is_visible = $userData['is_visible'];
                $user->username = $userData['username'];
                $user->save();

                // Assign role
                $user->assignRole($userData['role']);
            }
        }
    }
}
