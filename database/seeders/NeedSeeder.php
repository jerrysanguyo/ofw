<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_Need;

class NeedSeeder extends Seeder
{
    public function run(): void
    {
        $needs = [
            'Medicine',
            'Financial',
            'Food'
        ];

        foreach ($needs as $need) {
            Type_Need::create([
                'name' => $need,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
