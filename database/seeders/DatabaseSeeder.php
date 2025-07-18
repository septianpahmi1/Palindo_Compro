<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ghaleb S Alqrinawi',
            'email' => 'ghaleb@alharamain.com',
            'password' => bcrypt('12345678'),
            'role' => 'super admin'
        ]);

        User::create([
            'name' => 'Ani Nuraeni',
            'email' => 'ani@alharamain.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Septian Pahmi',
            'email' => 'septian@alharamain.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}
