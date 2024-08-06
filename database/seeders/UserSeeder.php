<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Jerry',
            'middle_name' => 'Gonzaga',
            'last_name' => 'Sanguyo',
            'email' =>  'jsanguyo1624@gmail.com',
            'password' => bcrypt('admin'),
            'contact_number' => '09271852710',
            'role' => 'admin',
        ]);
    }
}
