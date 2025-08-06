<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ruslan Nurdiansyah',
            'email' => 'finance@alharamainservices.id',
            'password' => bcrypt('financeAlharamain#2025'),
            'role' => 'admin'
        ]);
    }
}
