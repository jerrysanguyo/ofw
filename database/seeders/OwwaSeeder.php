<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_owwa;

class OwwaSeeder extends Seeder
{
    public function run(): void
    {
        $owwas = [
            'Member - Active',
            'Member - Expired',
            'Non-member'
        ];

        foreach ($owwas as $owwa) {
            Type_owwa::create([
                'name' => $owwa,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
