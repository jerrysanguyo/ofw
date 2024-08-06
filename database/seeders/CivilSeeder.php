<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_civil_status;

class CivilSeeder extends Seeder
{
    public function run(): void
    {
        $civils = [
            'Single',
            'Married',
            'Widowed',
            'Legally Separated',
        ];

        foreach ($civils as $civil) {
            Type_civil_status::create([
                    'name' => $civil,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'remarks' => 'Seeder generated'
            ]);
        }
    }
}
