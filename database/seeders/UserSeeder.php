<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Abdullah Afnan',
            'email' => 'abdullah@example.com',
            'mobile' => '08473589556',
            'password' => Hash::make('password123'), // pastikan menggunakan hash
        ]);
    }
}

