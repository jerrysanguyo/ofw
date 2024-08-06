<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_gender;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $genders = [
            'Male',
            'Female'
        ];

        foreach ($genders as $gender) {
            Type_gender::create([
                'name' => $gender,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
