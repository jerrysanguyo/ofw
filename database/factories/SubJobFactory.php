<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_sub_job;

class SubJobFactory extends Factory
{
    protected $model = Type_sub_job::class;

    public function definition(): array
    {
        return [
            'job_id' => Type_job::factory(),
            'name' => $this->faker->name(),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
            'remarks' => $this->fake->sentence(),
        ];
    }
}
