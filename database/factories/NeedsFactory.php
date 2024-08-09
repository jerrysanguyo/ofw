<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_Need;

class NeedsFactory extends Factory
{
    protected $model = Type_Need::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'updated_by' => User::factory(),
            'created_by' => Uer::factory(),
            'remarks' => $this->fake->sentence(),
        ];
    }
}
