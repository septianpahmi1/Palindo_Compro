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
            'name' => 'Ghaleb S.S Alqrinawi',
            'email' => 'info@alharamainservices.id',
            'password' => bcrypt('infoAlharamain#2025'),
            'role' => 'super admin'
        ]);

        User::create([
            'name' => 'Ani Nuraeni',
            'email' => 'admin@alharamainservices.id',
            'password' => bcrypt('adminAlharamain#2025'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Septian Pahmi',
            'email' => 'it@alharamainservices.id',
            'password' => bcrypt('itAlharamain#2025'),
            'role' => 'admin'
        ]);
    }
}
