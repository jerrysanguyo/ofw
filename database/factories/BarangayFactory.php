<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_barangay;

class BarangayFactory extends Factory
{
    protected $model = Type_barangay::class;

    public function definition(): array
    {
        return [
            'name' => $this->fake->name(),
            'updated_by' => User::factory(),
            'created_by' => Uer::factory(),
            'remarks' => $this->fake->sentence(),
        ];
    }
}
