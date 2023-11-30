<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->firstName(),
            'name' => $this->faker->firstName(),
            'code' => $this->faker->firstName(),
        ];
    }
}
