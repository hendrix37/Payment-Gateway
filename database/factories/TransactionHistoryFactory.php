<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->firstName(),
			'json_before_value' => $this->faker->text(),
			'json_after_value' => $this->faker->firstName(),
			'action' => $this->faker->randomElement(['cerated', 'updated', 'deleted']),
			'transaction_id' => createOrRandomFactory(\App\Models\Transaction::class),
			'status_transaction' => $this->faker->firstName(),
        ];
    }
}
