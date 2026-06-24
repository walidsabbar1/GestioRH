<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@rhmanager.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
