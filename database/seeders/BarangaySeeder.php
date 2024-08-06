<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_barangay; 

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = [
            'Bagumbayan',
            'Bagong Tanyag',
            'Bambang',
            'Central Bicutan',
            'Central Signal Village',
            'Fort Bonifacio',
            'Hagonoy',
            'Ibayo-Tipas',
            'Ligid-Tipas',
            'Lower Bicutan',
            'Maharlika Village',
            'Napindan',
            'New Lower Bicutan',
            'North Daang Hari',
            'North Signal Village',
            'Palingon',
            'Pinagsama',
            'San Miguel',
            'Santa Ana',
            'South Daang Hari',
            'South Signal Village',
            'Tuktukan',
            'Ususan',
            'Upper Bicutan',
            'Wawa',
            'Comembo',
            'East Rembo',
            'Pembo',
            'South Cembo',
            'West Rembo',
            'Pitogo',
        ];

        foreach ($barangays as $barangay) {
            Type_barangay::create([
                'name' => $barangay,
                'created_by' => 1, 
                'updated_by' => 1, 
                'remarks' => 'Seeder generated',
            ]);
        }
    }
}
