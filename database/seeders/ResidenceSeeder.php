<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_residence;

class ResidenceSeeder extends Seeder
{
    public function run(): void
    {
        $residences = [
            'Sariling bahay',
            'Nangungupanahan',
            'Nakikipisan'
        ];

        foreach ($residences as $residence) {
            Type_residence::create([
                'name' => $residence,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
