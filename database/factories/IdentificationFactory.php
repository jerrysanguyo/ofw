<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_id;

class IdentificationFactory extends Factory
{
    protected $model = Type_id::class;
    
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
