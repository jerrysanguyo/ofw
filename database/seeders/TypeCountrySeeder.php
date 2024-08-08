<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_continent;
use App\Models\Type_country;

class TypeCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            'Africa' => ['Nigeria', 'Kenya', 'South Africa', 'Egypt', 'Ethiopia', 'Ghana', 'Morocco', 'Uganda', 'Algeria', 'Sudan'],
            'Antarctica' => ['N/A'],
            'Asia' => ['Japan', 'China', 'India', 'South Korea', 'Indonesia', 'Pakistan', 'Bangladesh', 'Vietnam', 'Philippines', 'Thailand'],
            'Europe' => ['Germany', 'France', 'Italy', 'Spain', 'Poland', 'Romania', 'Netherlands', 'Belgium', 'Greece', 'Portugal'],
            'North America' => ['United States', 'Canada', 'Mexico', 'Guatemala', 'Honduras', 'El Salvador', 'Nicaragua', 'Costa Rica', 'Panama', 'Belize'],
            'Australia' => ['Australia', 'New Zealand', 'Papua New Guinea', 'Fiji', 'Solomon Islands', 'Vanuatu', 'Samoa', 'Tonga', 'Tuvalu', 'Nauru'],
            'South America' => ['Brazil', 'Argentina', 'Chile', 'Colombia', 'Peru', 'Venezuela', 'Ecuador', 'Bolivia', 'Paraguay', 'Uruguay'],
            'Sea based' => ['Sea based'],
        ];

        foreach ($countries as $continent => $countryList) {
            $continentModel = Type_continent::where('name', $continent)->first();

            foreach ($countryList as $country) {
                Type_country::create([
                    'continent_id' => $continentModel->id,
                    'name' => $country,
                    'created_by' => 1,
                    'updated_by' => null,
                ]);
            }
        }
    }
}
