<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_id;

class IdentificationSeeder extends Seeder
{
    public function run(): void
    {
        $identifications = [
            'PSA-issued Certificate of Live Birth',
            'Philippine Passport',
            'Unified Multi-purpose ldentification',
            'Student License Permit or Non- Professional/Professional Driver License',
        ];

        foreach ($identifications as $identification) {
            Type_id::create([
                'name' => $identification,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
