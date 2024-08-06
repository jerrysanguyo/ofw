<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_educational_attainment;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            'Primary',
            'Secondary',
            'Upper secondary',
            'Vocational',
            'Undergraduate',
            'Graduate',
            'Doctoral'
        ];

        foreach ($educations as $education) {
            Type_educational_attainment::create([
                'name' => $education,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
