<?php

namespace Database\Factories;

use App\Enums\BankStatusTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'code' => $this->faker->firstName(),
            'fee' => $this->faker->randomElement([200, 2500, 3000, 4000]),
            'queue' => $this->faker->randomFloat(null, 10, 1000),
            'status' => $this->faker->randomElement(BankStatusTypes::getAll()),
        ];
    }
}
