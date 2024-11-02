<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'meherabhassan42@gmail.com',
        ], [
            'name' => 'Meherab Hasan',
            'password' => Hash::make('j6n2k4++'),
            'is_admin' => true,
        ]);
    }
}