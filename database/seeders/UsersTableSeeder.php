<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ahmed',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'is_admin' => false,
            'photo' => 'defaultUser.png',
        ]);
        User::create([
            'name' => 'mohammed',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('123'),
            'is_admin' => false,
            'photo' => 'defaultUser.png',
        ]);
        User::create([
            'name' => 'adnan',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('000'),
            'is_admin' => true,
            'photo' => 'defaultUser.png',
        ]);
    }
}
