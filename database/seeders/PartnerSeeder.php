<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Partner Alharamain',
            'email' => 'partner@alharamainservices.id',
            'password' => bcrypt('partner#Services082025'),
            'role' => 'admin'
        ]);
    }
}
