<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_relation;

class RelationshipFactory extends Factory
{
    protected $model = Type_relation::class;
    
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
