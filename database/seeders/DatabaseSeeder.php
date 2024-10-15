<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Engineering',
            'email' => 'engineering@gmail.com',
            'password' => bcrypt('engineering'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Purchasing',
            'email' => 'purchasing@gmail.com',
            'password' => bcrypt('purchasing'),
        ]);
    }
}
