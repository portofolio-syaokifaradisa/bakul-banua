<?php

namespace Database\Seeders;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Muhammad Syaoki Faradisa',
            'email' => 'syaokifaradisa09@gmail.com',
            'password' => bcrypt("era-bits-indonesia123"),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Muhammad Janawi',
            'email' => 'muhammad.janawi99@gmail.com',
            'password' => bcrypt("era-bits-indonesia123"),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Muhammad Ihsan Fansyuri',
            'email' => 'ihsanfansyuri15@gmail.com',
            'password' => bcrypt("era-bits-indonesia123"),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Abdi',
            'email' => 'abdiabdullahthalib@gmail.com',
            'password' => bcrypt("bakul-banua-123"),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Muhammad Naseruddin',
            'email' => 'mnaseruddin.ilkom@gmail.com',
            'password' => bcrypt("bakul-banua-123"),
            'role' => 'admin'
        ]);
    }
}
