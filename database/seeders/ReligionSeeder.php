<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_religion;

class ReligionSeeder extends Seeder
{
    public function run(): void
    {
        $religions = [
            'Catholic',
            'Christian',
            'Islam',
            'Protestantism',
            'Seventh-day Adventist',
            'Church of jesus christ of latter day saints',
            'The Most Holy Church of God in Christ Jesus',
            'Convention of Philippine Baptist Churches',
            'Iglesia Filipina Independiente',
            'Iglesia Ni Cristo',
            'Non-denominational',
            'Baptist',
            'Jehovahs Witnesses',
        ];

        foreach ($religions as $religion) {
            Type_religion::create([
                'name' => $religion,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
