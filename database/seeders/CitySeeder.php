<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_city;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        Type_city::create([
            'name' => 'Taguig',
            'created_by' => 1,
            'updated_by' => 1,
            'remarks' => 'Seeder generated',
        ]);
    }
}
