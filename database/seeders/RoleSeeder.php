<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'SuperAdmin', 'is_visible' => 0],
            ['name' => 'Admin', 'is_visible' => 1],
            ['name' => 'Editor', 'is_visible' => 1],
            ['name' => 'User', 'is_visible' => 1],
        ];

        foreach ($roles as $roleData) {
            \App\Models\Role\Role::firstOrCreate($roleData);
        }
    }
}
