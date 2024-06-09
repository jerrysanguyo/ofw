<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type_continents>
 */
class TypeContinentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Africa', 'Antarctica', 'Asia', 'Europe', 'North America', 'Australia', 'South America'
            ]),
            'created_by' => 1,
            'updated_by' => null,
        ];
    }
}
