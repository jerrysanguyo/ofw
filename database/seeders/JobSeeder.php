<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_job;


class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            'Education',
            'Law & Government',
            'Health Care',
            'Service Industry',
            'Transport',
            'Arts',
            'Communications',
            'Construction',
            'Manufacturing',
            'Finance',
            'Business Administrtion',
            'Technology',
            'Sea Based'
        ];

        foreach ($jobs as $job) {
            Type_job::create([
                'name' => $job,
                'created_by' => 1,
                'updated_by' => 1,
                'remarks' => 'Seeder generated'
            ]);
        }
    }
}
