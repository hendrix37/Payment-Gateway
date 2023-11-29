<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->firstName(),
			'json_request' => $this->faker->text(),
			'json_response_payment_gateway' => $this->faker->firstName(),
			'payement_gateway' => $this->faker->firstName(),
			'amount' => $this->faker->randomFloat(),
			'bank_id' => createOrRandomFactory(\App\Models\Bank::class),
			'expired_date' => $this->faker->dateTime(),
			'link_payment' => $this->faker->firstName(),
			'identity_owner' => $this->faker->firstName(),
			'identity_driver' => $this->faker->firstName(),
			'status' => $this->faker->firstName(),
			'code_payment_gateway_relation' => $this->faker->firstName(),
			'json_callback' => $this->faker->text(),
        ];
    }
}
