<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_relation;

class RelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $relations = [
            'Son', 
            'Daughter', 
            'Wife',
            'Husband',
            'Father',
            'Mother',
            'Sister',
            'Brother'
        ];

        foreach ($relations as $relation) {
            Type_relation::create([
                'name' => $relation,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
