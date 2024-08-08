<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_continent;

class TypeContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $continents = [
            'Africa', 'Antarctica', 'Asia', 'Europe', 'North America', 'Australia', 'South America', 'Sea based'
        ];

        foreach ($continents as $continent) {
            Type_continent::create([
                'name' => $continent,
                'created_by' => 1,
                'updated_by' => null,
            ]);
        }
    }
}
