<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_residence;

class ResidenceFactory extends Factory
{
    protected $model = Type_residence::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
            'remarks' => $this->fake->sentence(),
        ];
    }
}
