<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TypeContinentSeeder::class,
            TypeCountrySeeder::class,
            BarangaySeeder::class,
            CitySeeder::class,
            CivilSeeder::class,
            ContractSeeder::class,
            EducationSeeder::class,
            GenderSeeder::class,
            IdentificationSeeder::class,
            JobSeeder::class,
            SubJobSeeder::class,
            OwwaSeeder::class,
            RelationshipSeeder::class,
            ReligionSeeder::class,
            ResidenceSeeder::class,
            NeedSeeder::class,
        ]);
    }
}
