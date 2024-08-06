<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_contract;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        $contracts = [
            'Finished',
            'Unfinish'
        ];

        foreach ($contracts as $contract) {
            Type_contract::create([
                'name' => $contract,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
