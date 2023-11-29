<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->firstName(),
			'json_request' => $this->faker->text(),
			'account_number' => $this->faker->firstName(),
			'bank_code' => $this->faker->firstName(),
			'amount' => $this->faker->randomFloat(),
			'remark' => $this->faker->text(),
			'idempotency' => $this->faker->firstName(),
        ];
    }
}
