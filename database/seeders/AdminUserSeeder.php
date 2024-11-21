<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Lê Quang Huy',
            'email' => 'lehuy3646@gmail.com',
            'password' => Hash::make('huy12345'),
            'phone' => '12345',
            'role' => 'admin'
        ]);
    }
}
